<script>
import Layout from "./Layouts/Layout.vue";
import { onMounted } from 'vue'
import { initDropdowns } from 'flowbite'

export default {
    name: "Edit",
    props: {
        property: Object,
        media_property: Array,
        errors: Object,
    },

    layout: Layout,
    data() {
        return {
            apiUrl: "https://api.tomtom.com/search/2/",

            propertyEdit: {
                name: this.property.name,
                description: this.property.description,
                cover_image: this.property.cover_image,
                beds: this.property.beds,
                bathrooms: this.property.bathrooms,
                rooms: this.property.rooms,
                size: this.property.size,
                price: this.property.price,
                address: this.property.address,
                latitude: this.property.latitude,
                longitude: this.property.longitude,
                editGallery: this.media_property,
            },
        };
    },
    methods: {
        submit() {
            axios
                .get(
                    this.apiUrl +
                        "geocode/" +
                        encodeURIComponent(this.propertyEdit.address) +
                        ".json",
                    {
                        params: {
                            key: "ryfFS68OaO3jRhbpAPo3U6smYXGydYjO",
                        },
                    }
                )
                .then((res) => {
                    const results = res.data.results[0];
                    this.propertyEdit.latitude = results.position.lat;
                    this.propertyEdit.longitude = results.position.lon;
                    this.propertyEdit.address = results.address.freeformAddress;
                    //console.log(this.propertyEdit);
                    this.$inertia.post(
                        route("properties.update", {
                            forceFormatData: true,
                            property: this.property,
                            _method: "put",
                        }),
                        this.propertyEdit
                    );
                });
        },
    },

    mounted() {
        // console.log(this.my_properties);
        initDropdowns();
    },
};
</script>
<template>
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
                    <input
                        type="text"
                        id="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
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
                        class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        id="cover_image"
                        type="file"
                    />
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

                <div class="flex flex-col mb-4">
                    <button id="dropdownCheckboxButton" data-dropdown-toggle="dropdownDefaultCheckbox" class="font-medium rounded-lg inline-flex items-center px-5 py-2.5 uppercase text-white bg-[#4d1635] text-sm text-center mx-auto transition delay-150 hover:bg-[#89275e] duration-200" type="button">Servizi<svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg></button>

                    <!-- Dropdown menu -->
                    <div id="dropdownDefaultCheckbox" class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCheckboxButton">
                        <li>
                            <div class="flex items-center">
                            <input id="checkbox-item-1" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Default checkbox</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <input checked id="checkbox-item-2" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="checkbox-item-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Checked state</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                            <input id="checkbox-item-3" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="checkbox-item-3" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Default checkbox</label>
                            </div>
                        </li>
                        </ul>
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
                        min="0"
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
                        type="text"
                        id="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="propertyEdit.address"
                    />
                </div>

                <button
                    type="submit"
                    class="my-3 px-5 py-2.5 uppercase text-white bg-[#4d1635] text-sm text-center mx-auto transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-lg"
                    :disabled="propertyEdit.editGallery.length > 5"
                >
                    Modifica
                </button>
            </form>
        </div>
    </div>
</template>

<style></style>
