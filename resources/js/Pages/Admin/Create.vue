<script>
import Layout from "./Layouts/Layout.vue";

export default {
    layout: Layout,

    data() {
        return {
            apiUrl: "https://api.tomtom.com/search/2/",

            newProperty: {
                name: "",
                description: "",
                cover_image: "",
                beds: "",
                price: "",
                address: "",
                latitude: "",
                longitude: "",
            },
        };
    },

    methods: {
        getAddressInfo() {
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
                .then(function (res) {
                    console.log(res.data.results[0]);
                });
        },

        submit() {
            this.getAddressInfo();
            this.$inertia.post(route("properties.store", this.newProperty));
        },
    },
};
</script>
<template>
    <div class="flex items-center w-full">
        <div class="pt-20 inline-block content-center w-full">
            <h1 class="text-center font-bold text-2xl py-6 uppercase">
                Aggiungi una proprietà
            </h1>

            <form class="md:flex md:flex-wrap md:justify-between mx-6 md:mx-64" @submit.prevent="submit">
                <div class="flex flex-col mb-4 md:w-full">
                <label class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5" required v-model="newProperty.name">
                </div>
                <div class="flex flex-col mb-4 md:w-full">
                <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <input type="text" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block  p-2.5" required v-model="newProperty.description">
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="default_size">Cover image</label>
                <input class="block  text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="file_input" type="file">
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                <label for="beds" class="block mb-2  text-sm font-medium text-gray-900 dark:text-white">N° beds</label>
                <input type="text" id="beds" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block p-2.5" required v-model="newProperty.beds">
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price/Night</label>
                <input type="text" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block  p-2.5 " required v-model="newProperty.price">
                </div>

                <div class="flex flex-col mb-4 md:w-full">
                <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <input type="text" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block  p-2.5" required v-model="newProperty.address">
                </div>

                <button type="submit" class="text-white bg-[#4d1635] hover:bg-[#89275e] font-medium rounded-lg text-sm  sm:w-24 px-5 py-2.5 text-center">Submit</button>
            </form>
        </div>
    </div>
</template>

<style></style>
