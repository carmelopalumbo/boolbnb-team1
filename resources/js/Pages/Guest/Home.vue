<script>
import { initDropdowns } from "flowbite";
import PropertyCard from "../Partials/PropertyCard.vue";
import Header from "./Partials/Header.vue";
import Footer from "./Partials/Footer.vue";


export default {
    name: "Home",

    components: { PropertyCard, Header, Footer },

    data() {
        return {
            apiUrl: "https://api.tomtom.com/search/2/",
            search: "",
            beds: 1,
            rooms: 1,
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
            this.beds = 1;
            this.rooms = 1;
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

    <Header :canLogin="canLogin" :canRegister="canRegister"/>

    <div class="flex justify-center mt-6">
        <div class="flex flex-col mb-4">
            <input
                @keyup="debounced"
                type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5 w-full"
                v-model="search"
                placeholder="Cerca un indirizzo . . . "
            />
            <div v-if="listAddress.length && search.length" class="listAddress">
                <p class="p-3" v-for="item in listAddress" :key="item">
                    <ul>
                        <li class="selectAddress cursor-pointer"
                        @click="selectAddress(item)"

                        >{{item.address.freeformAddress}}</li>
                    </ul>
                </p>
            </div>
            <div class="">
                <label for="radius" class="block my-2 text-sm font-medium text-gray-900">Raggio</label>
                <select v-model="radius" id="radius" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                    <option selected>Scegli un raggio</option>
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                </select>
            </div>

            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <form action="">
                    <div
                        class="py-2 text-sm text-gray-700 dark:text-gray-200 flex justify-between gap-4 my-4"
                        aria-labelledby="dropdownMenuIconButton"
                    >
                    <div class="w-1/2">
                        <label for="services" class="block mb-2 text-sm font-medium text-gray-900">N° posti letti</label>
                            <input
                                v-model="beds"
                                min="1"
                                type="number"
                                class="block px-4 py-2 hover:bg-gray-100 border border-gray-200 rounded-lg w-full"
                                placeholder="numero letti"
                            />
                    </div>

                    <div class="w-1/2">
                        <label for="services" class="block mb-2 text-sm font-medium text-gray-900">N° stanze</label>

                        <input
                            v-model="rooms"
                            min="1"
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


            </div>
            <button
                @click.prevent="submit"
                :disabled="!search.length"
                type="button"
                class="text-white sm:w-auto px-5 py-2.5 mt-4 bg-[#4d1635] text-sm text-center mx-auto transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-lg disabled:hover:scale-100 disabled:hover:bg-[#4d1635] disabled:opacity-75"
            >
                Ricerca
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

    <Footer/>
</template>

<style>
</style>
