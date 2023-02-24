<script>
import { initDropdowns } from "flowbite";
import PropertyCard from "../Partials/PropertyCard.vue";

export default {
    name: "Home",

    components: { PropertyCard },

    data() {
        return {
            apiUrl: "https://api.tomtom.com/search/2/",
            search: "",
            beds: 0,
            rooms: 0,
            latitude: 0,
            longitude: 0,
            radius: 20,
            filterServices: [],
            listAddress: {},
            debounced : _.debounce(this.searchAddress, 500),
        };
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        properties: Object,
        services: Object,
    },

    watch: {
         search: function (value) {
            if(!this.search.length)
            this.$inertia.get("/", { search: value }, { preserveState: true });
        },
     },

    methods: {
        submit() {
            // console.log(this.filterServices)
            this.$inertia.get(
                "/",
                {
                    search: this.search,
                    beds: this.beds,
                    rooms: this.rooms,
                    lat: this.latitude,
                    lon: this.longitude,
                    radius: this.radius,
                    filterServices: this.filterServices,
                },
                { preserveState: true }
            );
            this.beds = 0;
            this.rooms = 0;
            this.radius = 20;
            this.filterServices = [];
        },

        selectAddress(selectedAddress){
            this.listAddress = {};
            this.listAddress = selectedAddress;
            this.latitude =this.listAddress.position.lat;
            this.longitude = this.listAddress.position.lon;
            this.search = this.listAddress.address.freeformAddress;
            this.submit();
        },

        searchAddress(){
            if(this.search.length){
                axios.get(
                this.apiUrl+"geocode/"+encodeURIComponent(this.search)+".json", {
                    params:{
                        key:"ryfFS68OaO3jRhbpAPo3U6smYXGydYjO",
                    }
                }
            )
            .then((res)=>{
                const results = res.data.results;
                this.listAddress = results;
            })
            }
        },
    },

    mounted() {
        // console.log(this.properties);
        // console.log(this.services);
        initDropdowns();
    },
};
</script>

<template>
    <div v-if="canLogin" class="px-6 py-4 sm:block text-right">
        <Link
            v-if="$page.props.auth.user"
            :href="route('properties.index')"
            class="text-sm text-gray-700 dark:text-gray-500 underline uppercase"
            >Il mio profilo</Link
        >

        <template v-else>
            <Link
                :href="route('login')"
                class="text-sm text-gray-700 dark:text-gray-500 underline"
                >Log in</Link
            >

            <Link
                v-if="canRegister"
                :href="route('register')"
                class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                >Register</Link
            >
        </template>
    </div>

    <h1 class="text-center pt-6 uppercase">Sito pubblico</h1>

    <div class="flex justify-center mt-6">
        <div class="flex flex-col mb-4">
            <input
                @keyup="debounced"
                type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5 w-full"
                v-model="search"
                placeholder="Cerca un indirizzo . . . "
            />
            <div v-if="listAddress.length" class="listAddress">
                <p class="p-3" v-for="item in listAddress" :key="item">
                    <ul>
                        <li class="selectAddress cursor-pointer"
                        @click="selectAddress(item)"

                        >{{item.address.freeformAddress}}</li>
                    </ul>
                </p>
            </div>
            <form action="">
                <div
                    class="py-2 text-sm text-gray-700 dark:text-gray-200 flex justify-between gap-4 my-4"
                    aria-labelledby="dropdownMenuIconButton"
                >
                <div class="w-1/2">
                    <label for="services" class="block mb-2 text-sm font-medium text-gray-900">N° posti letti</label>
                        <input
                            v-model="beds"
                            min="0"
                            type="number"
                            class="block px-4 py-2 hover:bg-gray-100 border border-gray-200 rounded-lg w-full"
                            placeholder="numero letti"
                        />

                </div>

                <div class="w-1/2">
                    <label for="services" class="block mb-2 text-sm font-medium text-gray-900">N° bagni</label>

                    <input
                        v-model="rooms"
                        min="0"
                        type="number"
                        class="block px-4 py-2 hover:bg-gray-100 border border-gray-200 rounded-lg w-full"
                        placeholder="numero stanze"
                    />
                </div>

                </div>
            </form>

            <label for="services" class="block mb-2 text-sm font-medium text-gray-900">Servizi richiesti</label>
            <ul
                class="lg:grid lg:grid-cols-5 place-items-center auto-cols-max align-middle w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg flex flex-wrap p-2 uppercase mx-1"
            >
                <li
                    v-for="service in services"
                    :key="service.id"
                    class="w-full mb-2 px-2 place-self-center"
                >
                    <div class="flex items-center">
                        <input
                            v-model="filterServices"
                            :id="service.id"
                            type="checkbox"
                            :value="service.id"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"
                        />
                        <label
                            :for="service.id"
                            class="ml-2 text-sm font-medium text-gray-900"
                            >{{ service.name }}</label
                        >
                    </div>
                </li>
            </ul>
            <div class="mt-2">
                <label for="radius" class="block my-2 text-sm font-medium text-gray-900 dark:text-white">Raggio</label>
                <select v-model="radius" id="radius" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:text-white">
                    <option selected>Scegli un raggio</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                </select>

            </div>
            <button
                @click.prevent="submit"
                :disabled="!search.length"
                type="button"
                class="text-white sm:w-auto px-5 py-2.5 mt-4 bg-[#4d1635] text-sm text-center mx-auto transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-lg disabled:hover:scale-100 disabled:hover:bg-[#4d1635] disabled:opacity-75"
            >
                Submit
            </button>
        </div>
    </div>

    <div class="flex flex-wrap justify-center mt-8">
        <PropertyCard
            v-for="property in properties"
            :key="property.id"
            :property="property"
        />
    </div>
</template>

<style></style>
