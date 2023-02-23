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

    <div class="flex justify-center">
        <div class="flex flex-col mb-4">
                    <input
                     @keyup="debounced"
                        type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5 w-56"
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
                </div>

        <button
            id="dropdownMenuIconButton"
            data-dropdown-toggle="dropdownDots"
            class="inline-flex items-center ml-2 p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
            type="button"
        >
            <svg
                class="w-6 h-6"
                aria-hidden="true"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"
                ></path>
            </svg>
        </button>

        <!-- Dropdown menu -->
        <div
            id="dropdownDots"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-5/6 dark:bg-gray-700 dark:divide-gray-600"
        >
            <form action="">
                <ul
                    class="py-2 text-sm text-gray-700 dark:text-gray-200"
                    aria-labelledby="dropdownMenuIconButton"
                >
                    <li>
                        <input
                            v-model="beds"
                            min="0"
                            type="number"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            placeholder="numero letti"
                        />
                    </li>
                    <li>
                        <input
                            v-model="rooms"
                            min="0"
                            type="number"
                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            placeholder="numero stanze"
                        />
                    </li>
                </ul>
                <button
                    @click.prevent="submit"
                    :disabled="!search.length"
                    type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                >
                    Submit
                </button>
            </form>

            <h3 class="mb-4 font-semibold text-gray-900 dark:text-white">
                Servizi
            </h3>
            <ul
                class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
            >
                <li
                    v-for="service in services"
                    :key="service.id"
                    class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                >
                    <div class="flex items-center pl-3">
                        <input
                            v-model="filterServices"
                            :id="service.id"
                            type="checkbox"
                            :value="service.id"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                        />
                        <label
                            :for="service.id"
                            class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                            >{{ service.name }}</label
                        >
                    </div>
                </li>
            </ul>
            <label for="radius" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Raggio</label>
            <select v-model="radius" id="radius" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:text-white">
                <option selected>Scegli un raggio</option>
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="30">30</option>
                <option value="40">40</option>
            </select>
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
