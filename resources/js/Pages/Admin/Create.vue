<script>
import Layout from "./Layouts/Layout.vue";

export default {
    layout: Layout,

    data() {
        return {
            newProperty: {
                name: "",
                description: "",
                cover_image: "",
                beds: "",
                price: "",
                address: "",
            },
        };
    },

    methods: {
        submit() {
            this.$inertia.post(route("properties.store", this.newProperty));
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
                    v-model="newProperty.name"
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
                    v-model="newProperty.description"
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
                    v-model="newProperty.cover_image"
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
                    v-model="newProperty.beds"
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
                    v-model="newProperty.price"
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
                    v-model="newProperty.address"
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
