<script>
import Layout from "./Layouts/Layout.vue";
import { Link } from '@inertiajs/vue3';
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
        <div class="py-6 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h1 class="text-center font-bold text-2xl py-6 uppercase">
                    Le mie proprietà
                </h1>
                <Link href="/admin/properties/create" class="align-middle hover:text-[#4d1635] text-lg font-bold "> <i class="fa-solid fa-plus mr-1"></i><span class="">Aggiungi una proprietà</span></Link>
            </div>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg px-4">
        <table class="w-full text-basetext-left text-gray-500 dark:text-gray-400">
            <thead class="border-b text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400 uppercase h-10">
                <tr>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 text-center"
                    >
                        nome
                    </th>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 text-center hidden md:table-cell"
                    >
                        indirizzo
                    </th>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 text-center hidden md:table-cell"
                    >
                        prezzo
                    </th>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 text-center hidden md:table-cell"
                    >
                        visibilità
                    </th>
                    <th
                        scope="col"
                        class="font-bold text-gray-900 text-center"
                    >
                        azioni
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="property in my_properties"
                    :key="property.id"
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 h-16"
                >
                    <td
                        class="font-medium text-gray-900 whitespace-nowrap dark:text-white break-words"
                    >
                        {{ property.name }}
                    </td>
                    <td
                        class="font-normal text-gray-900 whitespace-nowrap dark:text-white hidden md:table-cell"
                    >
                        {{ property.address }}
                    </td>
                    <td
                        class="font-normal text-gray-900 whitespace-nowrap dark:text-white hidden md:table-cell"
                    >
                        {{ property.price }} €
                    </td>
                    <td
                        class="font-normal  text-gray-900 whitespace-nowrap dark:text-white uppercase hidden md:table-cell"
                    >
                        {{
                            property.is_visible
                                ? "annuncio pubblico"
                                : "annuncio privato"
                        }}
                    </td>
                    <td
                        class="font-normal text-gray-900 whitespace-nowrap dark:text-white"
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
