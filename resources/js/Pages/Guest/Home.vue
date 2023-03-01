<script>
import { initModals } from 'flowbite';
import PropertyCard from "./Partials/PropertyCard.vue";
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
            showResults: false,
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
            if(!this.search.length){
                this.$inertia.get("/", { search: value }, { preserveState: true });
                this.showResults = false;
            }
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
            this.showResults = true;
            this.beds = 1;
            this.rooms = 1;
            this.radius = 20;
            this.filterServices = [];
        },

        selectAddress(selectedAddress){
            this.listAddress = {};
            this.listAddress = selectedAddress;
            this.latitude = this.listAddress.position.lat;
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
        //console.log(this.properties);
        // console.log(this.services);
        initModals();
    },
};
</script>

<template>
    <Head title="HOME"/>
    <Header :canLogin="canLogin" :canRegister="canRegister"/>

    <div class="h-full main dark:bg-[#111827]">
        <div class="flex justify-center mt-6">
            <div class="flex flex-col mb-4 w-4/5">
                <div class="inline-flex align-middle w-full">
                    <div class="w-full">
                        <input
                            @keyup="debounced"
                            type="text"
                            class="bg-gray-50 py-6 border border-gray-300 text-gray-900 text-lg rounded-full block px-5 w-full focus:ring-[#4d1635] focus:border-[#4d1635] dark:bg-[#111827] dark:text-white"
                            v-model="search"
                            placeholder="Cerca un indirizzo . . . "
                        />
                        <div v-if="listAddress.length && search.length" class="listAddress flex flex-col position-absolute transition delay-150 duration-600 border rounded-lg pt-2 h-32 overflow-y-scroll">
                            <p class="pl-2 py-2 border-b" v-for="item in listAddress" :key="item">
                                <ul>

                                    <li class="selectAddress cursor-pointer dark:text-white"
                                    @click="selectAddress(item)"
                                    ><i class="fa-solid fa-location-dot mr-2"></i>{{item.address.freeformAddress}}</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                    <!-- Modal toggle -->
                    <button data-modal-target="filter-modal" data-modal-toggle="filter-modal"
                    @click.prevent="submit"
                    :disabled="!search.length"
                    class="text-white sm:w-auto px-5 py-4 ml-4 h-20 bg-[#4d1635] text-xl text-center transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-full disabled:hover:scale-100 disabled:hover:bg-[#4d1635] disabled:opacity-75 dark:bg-[#89275e] dark:hover:bg-[#4d1635] " type="button">
                    <i class="fa-solid fa-filter"></i>
                    </button>
                </div>


                <!-- Main modal -->
                <div id="filter-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full transition duration-400 ease-in-out" >
                    <div class="relative w-4/5 h-2/3">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-[#111827] dark:text-white">
                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="filter-modal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="px-6 py-6 lg:px-8">
                                <div>
                                    <label for="radius" class="block my-2 text-base text-[#4d1635] dark:text-[#89275e] font-bold">Raggio di</label>
                                    <select v-model="radius" id="radius" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg dark:focus:border-[#89275e] focus:ring-[#4d1635] focus:border-[#4d1635] block w-full p-2.5 dark:bg-[#111827] dark:text-white">
                                        <option value="5">5km</option>
                                        <option value="10">10km</option>
                                        <option value="20" selected>20km</option>
                                        <option value="30">30km</option>
                                        <option value="40">40km</option>
                                    </select>
                                </div>

                                <div class="block w-auto">
                                    <form action="">
                                        <div
                                            class="py-2 text-sm text-gray-700 flex justify-between gap-4 my-4"
                                            aria-labelledby="dropdownMenuIconButton"
                                        >
                                            <div class="w-1/2">
                                                <label for="services" class="block mb-2 text-base text-[#4d1635] dark:text-[#89275e] font-bold">N° posti letto</label>
                                                    <input
                                                        v-model="beds"
                                                        min="1"
                                                        type="number"
                                                        class="block px-4 py-2 hover:bg-gray-100 border dark:focus:border-[#89275e] focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-200 rounded-lg w-full dark:bg-[#111827] dark:text-white"
                                                        placeholder="numero letti"
                                                    />
                                            </div>

                                            <div class="w-1/2">
                                                <label for="services" class="block mb-2 font-bold text-base dark:text-[#89275e] text-[#4d1635]">N° stanze</label>

                                                <input
                                                    v-model="rooms"
                                                    min="1"
                                                    type="number"
                                                    class="block px-4 py-2 hover:bg-gray-100 border dark:focus:border-[#89275e] focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-200 rounded-lg w-full dark:bg-[#111827] dark:text-white"
                                                    placeholder="numero stanze"
                                                />
                                            </div>
                                        </div>
                                    </form>

                                    <label for="services" class="block mb-2 font-bold text-base dark:text-[#89275e]  text-[#4d1635]">Servizi richiesti</label>
                                    <ul
                                        class="lg:grid lg:grid-cols-5 place-items-center auto-cols-max align-middle w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg flex flex-wrap p-2 uppercase dark:bg-[#111827]"
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
                                                    class="w-4 h-4 text-[#4d1635] bg-gray-100 border-gray-300 rounded dark:focus:border-[#89275e] focus:ring-[#4d1635] focus:border-[#4d1635]"
                                                />
                                                <label
                                                    :for="service.id"
                                                    class="ml-2 text-sm font-medium text-gray-900 dark:text-white"
                                                    >{{ service.name }}</label
                                                >
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <button
                            @click.prevent="submit"
                            :disabled="!search.length"
                            data-modal-hide="filter-modal"
                            type="button"
                            class="text-white sm:w-auto px-5 py-2.5 mt-4 bg-[#4d1635] text-sm text-center mx-auto transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-lg disabled:hover:scale-100 disabled:hover:bg-[#4d1635] disabled:opacity-75 dark:bg-[#89275e] dark:hover:bg-[#4d1635] "
                        >
                            Mostra risultati
                        </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <div v-if="!showResults">
            <h2 class="flex flex-wrap justify-center my-10 p-2 text-[#4d1635] dark:text-[#89275e] text-4xl font-bold rounded-lg uppercase">
                <i class="fa-solid fa-house mx-3"></i>
                Appartamenti in evidenza
                <i class="fa-solid fa-house mx-3"></i>
                </h2>
        </div>

        <div v-else>
            <p class="flex flex-wrap justify-start m-10 w-1/2 p-3 text-[#4d1635] dark:text-[#89275e] text-base font-bold rounded-lg border-2 border-[#4d1635] dark:border-[#89275e]">Ho trovato {{properties.data.length}} risultati vicino a {{ listAddress.address.freeformAddress}} con i parametri richiesti.</p>
        </div>


        <div class="flex flex-wrap justify-center mt-8 position-relative z-40">
            <PropertyCard
                v-for="property in properties.data"
                :key="property.id"
                :property="property"
            />
        </div>

        <div
        v-if="properties.links.length > 3"
        class="my-8 flex justify-center text-white text-lg font-bold space-x-6"
            >
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in properties.links"
                :key="link.id"
                :href="link.url"
                v-html="link.label"
                :class="{
                    'text-gray-400': !link.url,
                    'border border-1 rounded-xl px-3 border-[#4d1635] bg-[#4d1635] ':
                        link.active,
                }"
            >
            </Component>
        </div>

    </div>

    <Footer class="fixed w-full bottom-0"/>
</template>

<style>
.main{
    height: calc(100vh - 160px);
    overflow-y: scroll;
}
</style>
