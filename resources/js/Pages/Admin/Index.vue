<script>
import Layout from "./Layouts/Layout.vue";
export default {
    props: { my_properties: Object },

    layout: Layout,

    methods: {
        deleteItem(property) {
            if (confirm("Confermi eliminazione?"))
                this.$inertia.delete(route("properties.destroy", property));
        },
    },

    mounted() {
        console.log(this.my_properties);
    },
};
</script>

<template>
    <div class="flex flex-col justify-center mx-auto">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <h1 class="text-center font-bold text-2xl py-6 uppercase">
                        Le mie proprietà
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-basetext-left text-gray-500 dark:text-gray-400">
            <thead class="border-b text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 uppercase">
                <tr>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 px-6 py-4 text-center"
                    >
                        nome
                    </th>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 px-6 py-4 text-center hidden md:table-cell"
                    >
                        indirizzo
                    </th>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 px-6 py-4 text-center hidden md:table-cell"
                    >
                        prezzo
                    </th>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 px-6 py-4 text-center hidden md:table-cell"
                    >
                        visibilità
                    </th>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 px-6 py-4 text-center"
                    >
                        azioni
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="property in my_properties"
                    :key="property.id"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                >
                    <td
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        {{ property.name }}
                    </td>
                    <td
                        class="px-6 py-4 font-normal text-gray-900 whitespace-nowrap dark:text-white hidden md:table-cell"
                    >
                        {{ property.address }}
                    </td>
                    <td
                        class="px-6 py-4 font-normal text-gray-900 whitespace-nowrap dark:text-white hidden md:table-cell"
                    >
                        {{ property.price }} €
                    </td>
                    <td
                        class="px-6 py-4 font-normal  text-gray-900 whitespace-nowrap dark:text-white uppercase hidden md:table-cell"
                    >
                        {{
                            property.is_visible
                                ? "annuncio pubblico"
                                : "annuncio privato"
                        }}
                    </td>
                    <td
                        class="px-6 py-4 font-normal text-gray-900 whitespace-nowrap dark:text-white"
                    >
                        <Link
                            :href="
                                route('properties.show', property)
                            "
                            class="text-white bg-blue-500 px-3 py-2 rounded-lg"
                        >
                            <i class="fa-regular fa-eye"></i>
                        </Link>

                        <Link
                            :href="
                                route('properties.edit', property)
                            "
                            class="text-white bg-yellow-500 px-3 py-2 rounded-lg mx-2"
                        >
                            <i
                                class="fa-solid fa-pen-to-square"
                            ></i>
                        </Link>

                        <button
                            class="text-white bg-red-500 px-3 py-2 rounded-lg"
                            @click="deleteItem(property)"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>



</template>

<style></style>
