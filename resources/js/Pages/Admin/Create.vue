<script>
import Layout from "./Layouts/Layout.vue";
import { useForm } from "@inertiajs/vue3";

export default {
    layout: Layout,

    props: {
        errors: Object,
    },

    data() {
        return {
            apiUrl: "https://api.tomtom.com/search/2/",

            errorMessage: "",

            newProperty: {
                name: "",
                description: "",
                cover_image: "",
                beds: "",
                bathrooms: "",
                rooms: "",
                size: "",
                price: "",
                address: "",
                latitude: null,
                longitude: null,
            },
        };
    },

    methods: {
        submit() {
            axios
                .get(
                    this.apiUrl +
                        "geocode/" +
                        encodeURIComponent(this.newProperty.address) +
                        ".json",
                    {
                        params: {
                            key: "ryfFS68OaO3jRhbpAPo3U6smYXGydYjO",
                        },
                    }
                )
                .then((res) => {
                    const results = res.data.results[0];
                    this.newProperty.latitude = results.position.lat;
                    this.errorMessage = "";
                    this.newProperty.longitude = results.position.lon;
                    this.newProperty.address = results.address.freeformAddress;
                    console.log(this.newProperty);
                    this.$inertia.post(
                        route("properties.store", this.newProperty)
                    );
                })
                .catch((err) => {
                    this.errorMessage = "INDIRIZZO NON VALIDO.";
                });
        },
    },
};
</script>
<template>
    <div class="flex items-center w-full">
        <div class="pt-20 inline-block content-center w-full">
            <h1 class="text-center font-bold text-2xl py-6 uppercase">
                AGGIUNGI NUOVA PROPRIETA'
            </h1>

            <form
                class="md:flex md:flex-wrap md:justify-between mx-6 md:mx-64"
                @submit.prevent="submit"
            >
                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        class="mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Name*</label
                    >
                    <input
                        type="text"
                        id="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
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
                        >Description*</label
                    >
                    <input
                        type="text"
                        id="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
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
                        >Cover image*</label
                    >
                    <input
                        class="block text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        id="cover_image"
                        type="text"
                        v-model="newProperty.cover_image"
                    />
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                    <label
                        for="beds"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >N° beds*</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="beds"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
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
                        >N° Bathrooms</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="bathrooms"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
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
                        >N° Bedrooms</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="rooms"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
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
                        >Size (mq)</label
                    >
                    <input
                        type="number"
                        min="0"
                        id="size"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
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
                        >Price/Night*</label
                    >
                    <input
                        type="text"
                        id="price"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
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
                        >Address*</label
                    >
                    <input
                        type="text"
                        id="address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5"
                        required
                        v-model="newProperty.address"
                    />
                    <p
                        v-if="errorMessage"
                        class="text-xs italic text-red-600 py-1 pl-1"
                    >
                        {{ errorMessage }}
                    </p>
                </div>

                <button
                    type="submit"
                    class="text-white bg-[#4d1635] hover:bg-[#89275e] font-medium rounded-lg text-sm sm:w-24 px-5 py-2.5 text-center"
                >
                    Submit
                </button>
            </form>
        </div>
    </div>
</template>

<style></style>
