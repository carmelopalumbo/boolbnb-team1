<script>
import Layout from "./Layouts/Layout.vue";

export default {
    props: {
        property: Object,
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
                price: this.property.price,
                address: this.property.address,
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
                    this.$inertia.put(
                        route("properties.update", this.property),
                        this.propertyEdit
                    );
                });
        },
    },
};
</script>
<template>
    <div class="container mx-auto h-screen flex">
        <h1>Create</h1>

        <form
            class="bg-white shadow-md rounded m-auto"
            @submit.prevent="submit"
        >
            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="name"
                    >Name:</label
                >

                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text"
                    id="name"
                    v-model="propertyEdit.name"
                />
            </div>

            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="description"
                    >description:</label
                >
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text"
                    id="description"
                    v-model="propertyEdit.description"
                />
            </div>

            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="cover_image"
                    >cover_image:</label
                >
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text"
                    id="cover_image"
                    v-model="propertyEdit.cover_image"
                />
            </div>

            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="beds"
                    >beds:</label
                >
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="number"
                    id="beds"
                    v-model="propertyEdit.beds"
                />
            </div>

            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="price"
                    >price:</label
                >
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="number"
                    id="price"
                    v-model="propertyEdit.price"
                />
            </div>

            <div class="mb-4">
                <label
                    class="block text-gray-700 text-sm font-bold mb-2"
                    for="address"
                    >address:</label
                >
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    type="text"
                    id="address"
                    v-model="propertyEdit.address"
                />
            </div>

            <button
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                type="submit"
            >
                Submit
            </button>
        </form>
    </div>
</template>

<style></style>
