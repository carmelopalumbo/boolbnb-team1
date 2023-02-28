<script>
import Layout from "./Layouts/Layout.vue";
import { useForm } from "@inertiajs/vue3";
import { initDropdowns } from 'flowbite'
import debounce from 'lodash/debounce';

export default {
    name: "Create",

    layout: Layout,

    props: {
        errors: Object,
        services: Array
    },

    data() {
        return {
            apiUrl: "https://api.tomtom.com/search/2/",

            errorMessage: "",
            listAddress: {},
            debounced : _.debounce(this.searchAddress, 500),


            newProperty: {
                name: "",
                description: "",
                cover_image: null,
                beds: "",
                bathrooms: "",
                rooms: "",
                size: "",
                price: "",
                address: "",
                services: [],
                latitude: null,
                longitude: null,
                gallery: [],
                is_visible: true,
            },
        };
    },

    methods: {
        selectAddress(selectedAddress){
            this.listAddress = {};
            this.listAddress = selectedAddress;
            this.newProperty.latitude =this.listAddress.position.lat;
            this.newProperty.longitude = this.listAddress.position.lon;
            this.newProperty.address = this.listAddress.address.freeformAddress;
        },

        searchAddress(){
            axios.get(
                this.apiUrl+"geocode/"+encodeURIComponent(this.newProperty.address)+".json", {
                    params:{
                        key:"ryfFS68OaO3jRhbpAPo3U6smYXGydYjO",
                    }
                }
            )
            .then((res)=>{
                const results = res.data.results;
                this.listAddress = results;
            })
        },



        submit() {
            this.$inertia.post(
                route("properties.store", this.newProperty),
                {
                    forceFormatData: true,
                    cover_image: this.newProperty.cover_image,
                    gallery: this.newProperty.gallery,
                }
            );

        },
        showImage(event) {
            const tagImage = document.getElementById('output-image');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }
    },

    mounted() {
        // console.log(this.my_properties);
        initDropdowns();
    }
};
</script>
<template>
    <Head title="INSERISCI NUOVA PROPRIETÀ"></Head>
    <div class="flex items-center w-full">
        <div class="pt-20 inline-block content-center w-full">
            <h1 class="text-center font-black text-4xl pb-8 uppercase text-[#4d1635]">
                aggiungi nuova proprietà
            </h1>

            <form
                class="md:flex md:flex-wrap md:justify-between mx-6 md:mx-64"
                @submit.prevent="submit"
            >
                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        class="mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Nome *</label
                    >
                    <input
                        type="text"
                        id="name"
                        class="bg-gray-50 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="newProperty.name"
                    />
                    <p
                        v-if="errors.name"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.name }}
                    </p>
                </div>
                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="text"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Descrizione *</label
                    >
                    <textarea
                        id="description"
                        rows="5"
                        class="bg-gray-50 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5 resize-none "
                        required
                        v-model="newProperty.description"
                    />
                    <p
                        v-if="errors.description"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.description }}
                    </p>
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="cover_image"
                        >Immagine di copertina *</label
                    >
                    <input
                        @input="
                            newProperty.cover_image = $event.target.files[0]
                        "
                        @change="showImage"
                        class="block text-sm text-gray-900 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        id="cover_image"
                        type="file"
                    />
                    <p
                        v-if="errors.cover_image"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.cover_image }}
                    </p>
                    <div class="my-3">
                         <img width="150" id="output-image" alt="">
                    </div>
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="gallery"
                        >Galleria (MAX 5 IMMAGINI)</label
                    >
                    <input
                        @input="newProperty.gallery = $event.target.files"
                        class="block text-sm text-gray-900 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        id="gallery"
                        type="file"
                        multiple
                    />
                    <p
                        v-if="errors.gallery"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.gallery }}
                    </p>

                </div>
                <div class="flex flex-col mb-4 w-full">
                    <label for="services" class="block mb-2 text-sm font-medium text-gray-900">Servizi presenti</label>
                    <ul class="lg:grid lg:grid-cols-6 place-items-center auto-cols-max align-middle w-full text-sm font-medium text-gray-900 bg-white border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-200 rounded-lg flex flex-wrap p-2">
                        <li v-for="service in services" :key="service.id" class="w-full mb-2 place-self-center uppercase">
                            <div class="flex items-center">
                                <input v-model="newProperty.services" :id="service.name" type="checkbox" :value="service.id" class="w-4 h-4 text-[#4d1635] bg-gray-100 border-gray-300 rounded focus:ring-[#4d1635] focus:border-[#4d1635]"
                                >
                                <label :for="service.name" class="ml-2 text-sm font-medium text-gray-900">{{service.name}}</label>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="beds"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >N° Letti *</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="beds"
                        class="bg-gray-50 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="newProperty.beds"
                    />
                    <p
                        v-if="errors.beds"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.beds }}
                    </p>
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="bathrooms"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >N° Bagni</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="bathrooms"
                        class="bg-gray-50 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        v-model="newProperty.bathrooms"
                    />
                    <p
                        v-if="errors.bathrooms"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.bathrooms }}
                    </p>
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="rooms"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >N° stanze*</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="rooms"
                        class="bg-gray-50 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="newProperty.rooms"
                    />
                    <p
                        v-if="errors.rooms"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.rooms }}
                    </p>
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="size"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Dimensione (mq)</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="size"
                        class="bg-gray-50 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        v-model="newProperty.size"
                    />
                    <p
                        v-if="errors.size"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.size }}
                    </p>
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="price"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Prezzo/notte *</label
                    >
                    <input
                        type="number"
                        min="1"
                        id="price"
                        class="bg-gray-50 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="newProperty.price"
                    />
                    <p
                        v-if="errors.price"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.price }}
                    </p>
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Indirizzo *</label
                    >
                    <input
                     @keyup="debounced"
                        type="text"
                        class="bg-gray-50 border focus:ring-[#4d1635] focus:border-[#4d1635] border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="newProperty.address"
                    />
                    <div v-if="!listAddress.length" >

                    </div>
                    <div v-if="listAddress.length && newProperty.address.length" class="listAddress">

                        <p v-for="item in listAddress" :key="item">
                            <ul>
                            <li class="selectAddress"
                            @click="selectAddress(item)"

                            >{{item.address.freeformAddress}}</li>
                            </ul>
                        </p>
                    </div>


                    <p
                        v-if="errorMessage"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errorMessage }}
                    </p>
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" @click="newProperty.is_visible = !newProperty.is_visible" checked>
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-[#89275e] peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#4d1635]"></div>
                            <span v-if="newProperty.is_visible" class="ml-3 text-sm font-bold text-green-600">Annuncio pubblico</span>
                            <span v-else class="ml-3 text-sm font-bold text-yellow-400">Annuncio privato</span>
                        </label>
                </div>

                <button
                    type="submit"
                    class="my-3 px-5 py-2.5 uppercase text-white bg-[#4d1635] text-sm text-center mx-auto transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-lg disabled:hover:scale-100 disabled:hover:bg-[#4d1635] disabled:opacity-75"
                    :disabled="newProperty.gallery.length > 5 || (!Object.keys(listAddress).length)"
                >
                    Aggiungi
                </button>
            </form>
        </div>
    </div>
</template>

<style scoped>
.listAddress{
        border: 1px solid lightgray;
    }
    .selectAddress{
        cursor: pointer;
        padding: 8px;
    }
    .selectAddress:hover{
        background-color: lightgray;
    }
</style>
