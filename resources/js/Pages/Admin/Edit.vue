<script>
import Layout from "./Layouts/Layout.vue";
import { initDropdowns } from 'flowbite'

import debounce from 'lodash/debounce';
export default {
    name: "Edit",
    props: {
        property: Object,
        errors: Object,
        propertyServices: Array,
        services: Array
    },

    layout: Layout,
    data() {
        return {
            apiUrl: "https://api.tomtom.com/search/2/",

            listAddress: {},
            debounced : _.debounce(this.searchAddress, 500),

            propertyEdit: {
                name: this.property.name,
                description: this.property.description,
                cover_image: null,
                beds: this.property.beds,
                bathrooms: this.property.bathrooms,
                rooms: this.property.rooms,
                services: [],
                size: this.property.size,
                price: this.property.price,
                address: this.property.address,
                latitude: this.property.latitude,
                longitude: this.property.longitude,
                editGallery: {},
                is_visible: this.property.is_visible,
            },
        };
    },
    methods: {
        selectAddress(selectedAddress){
            this.listAddress = selectedAddress;
            this.propertyEdit.latitude =this.listAddress.position.lat;
            this.propertyEdit.longitude = this.listAddress.position.lon;
            this.propertyEdit.address = this.listAddress.address.freeformAddress;
        },

        searchAddress(){
            axios.get(
                this.apiUrl+"geocode/"+encodeURIComponent(this.propertyEdit.address)+".json", {
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
                route("properties.update", {
                    forceFormatData: true,
                    property: this.property,
                    _method: "put",
                }),
                this.propertyEdit
            );
        },
        showImage(event) {
            const tagImage = document.getElementById('output-image');
            tagImage.src = URL.createObjectURL(event.target.files[0]);
        }
    },

    mounted() {
        //console.log(this.propertyServices);
        initDropdowns();
    },
};
</script>
<template>
    <Head title="MODIFICA PROPRIETÀ"></Head>
    <div class="flex justify-center w-full">
        <div class="pt-20 inline-block content-center w-full">
            <h1 class="text-center font-bold text-2xl py-6 uppercase">
                Modifica la tua proprietà
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
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="propertyEdit.name"
                    />
                </div>
                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="text"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Descrizione *</label
                    >
                    <textarea
                        type="text"
                        id="description"
                        rows="5"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5 resize-none "
                        required
                        v-model="propertyEdit.description"
                    />
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        for="default_size"
                        >Immagine di copertina *</label
                    >
                    <input
                        @input="
                            propertyEdit.cover_image = $event.target.files[0]
                        "
                        @change="showImage"
                        class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        id="cover_image"
                        type="file"
                    />
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
                        @input="propertyEdit.editGallery = $event.target.files"
                        class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        id="gallery"
                        type="file"
                        multiple
                    />
                    <p
                        v-if="errors.media"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errors.media }}
                    </p>
                </div>
                <div class="flex justify-between w-full">
                    <div class="flex flex-col mb-4">
                        <button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox" class="font-bold rounded-lg inline-flex items-center px-5 py-2.5 uppercase text-white bg-[#4d1635] text-sm text-center mx-auto transition delay-150 hover:bg-[#89275e] duration-200" type="button">Servizi<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

                        <!-- Dropdown menu -->
                        <div id="dropdownDefaultCheckbox" class="z-10 uppercase hidden w-60 bg-white divide-y divide-gray-100 rounded-lg shadow ">
                            <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton">
                                <li v-for="service in services" :key="service.id">
                                    <div class="flex items-center mb-1">
                                        <input v-model="propertyEdit.services" :id="service.name" type="checkbox" :value="service.id" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded"
                                        >
                                        <label :for="service.name" class="ml-2 text-sm font-medium text-gray-900">{{service.name}}</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" @click="propertyEdit.is_visible = !property.is_visible" :checked="propertyEdit.is_visible">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-[#89275e] peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#4d1635]"></div>
                            <span v-if="propertyEdit.is_visible" class="ml-3 text-sm font-bold text-green-600">Annuncio pubblico</span>
                            <span v-else class="ml-3 text-sm font-bold text-yellow-400">Annuncio privato</span>
                        </label>
                    </div>

                </div>


                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="beds"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Numero letti *</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="beds"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="propertyEdit.beds"
                    />
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="bathrooms"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Numero bagni</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="bathrooms"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        v-model="propertyEdit.bathrooms"
                    />
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="rooms"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Numero Stanze da Letto</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="rooms"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        v-model="propertyEdit.rooms"
                    />
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
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        v-model="propertyEdit.size"
                    />
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="price"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Prezzo /per notte *</label
                    >
                    <input
                        type="number"
                        min="1"
                        id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="propertyEdit.price"
                    />
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
                        id="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="propertyEdit.address"
                    />
                    <div v-if="!listAddress.length" >

                    </div>
                    <div v-if="listAddress.length" class="listAddress">

                        <p v-for="item in listAddress" :key="item">
                            <ul>
                            <li class="selectAddress"
                            @click="selectAddress(item)"

                            >{{item.address.freeformAddress}}</li>
                            </ul>
                        </p>
                    </div>
                </div>

                <button
                    type="submit"
                    class="my-3 px-5 py-2.5 uppercase text-white bg-[#4d1635] text-sm text-center mx-auto transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-lg disabled:hover:scale-100 disabled:hover:bg-[#4d1635] disabled:opacity-75"
                    :disabled="propertyEdit.editGallery.length > 5"
                >
                    Modifica
                </button>
            </form>
        </div>
    </div>
</template>

<style></style>
