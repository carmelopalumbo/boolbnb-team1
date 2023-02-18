<script>
import Layout from "./Layouts/Layout.vue";
import { Link } from "@inertiajs/vue3";
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
    <div class="flex justify-center mx-auto font-poppins">
        <div class="py-6 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h1 class="text-center font-bold text-2xl py-6 uppercase">
                    Le mie proprietà
                </h1>
            </div>
        </div>
    </div>

    <div class="relative container mx-auto overflow-x-auto">
        <div
            class="relative container mx-auto w-5/6"
            v-if="!my_properties.length"
        >
            <Link
                href="/admin/properties/create"
                class="hover:text-[#4d1635] text-lg font-bold uppercase text-green-700 mx-auto inline-block"
            >
                <i class="fa-solid fa-plus mr-1"></i
                ><span class="">Aggiungi la tua prima proprietà</span>
            </Link>
        </div>

        <div v-else>
            <div class="relative container mx-auto w-5/6 mb-4">
                <Link
                    href="/admin/properties/create"
                    class="hover:text-[#4d1635] text-lg font-bold uppercase text-green-700 mx-auto inline-block"
                >
                    <i class="fa-solid fa-plus mr-1"></i
                    ><span class="">Aggiungi una proprietà</span></Link
                >
            </div>
            <table
                class="w-5/6 table-auto text-base mx-auto text-left text-gray-500 border "
            >
                <thead
                    class="border-b text-base text-gray-700 bg-gray-200 uppercase h-10 text-center"
                >
                    <tr>
                        <th scope="col" class="font-bold text-gray-900 px-2">
                            nome
                        </th>
                        <th
                            scope="col"
                            class="font-bold text-gray-900 hidden lg:table-cell px-2"
                        >
                            indirizzo
                        </th>
                        <th
                            scope="col"
                            class="font-bold text-gray-900 hidden lg:table-cell px-2"
                        >
                            prezzo
                        </th>
                        <th
                            scope="col"
                            class="font-bold text-gray-900 hidden md:table-cell px-2"
                        >
                            visibilità
                        </th>
                        <th
                            scope="col"
                            class="font-bold text-gray-900 hidden md:table-cell px-2"
                        >
                            boost
                        </th>
                        <th scope="col" class="font-bold text-gray-900">
                            azioni
                        </th>
                    </tr>
                </thead>
                <tbody class="">
                    <tr
                        v-for="property in my_properties"
                        :key="property.id"
                        class="bg-white border-b hover:bg-gray-100 h-16"
                    >
                        <td
                            class="font-medium text-gray-900 break-words truncate px-2"
                        >
                            {{ property.name }}
                        </td>
                        <td
                            class="font-normal text-gray-900 truncate hidden lg:table-cell w-1/6 px-2"
                        >
                            {{ property.address }}
                        </td>
                        <td
                            class="font-normal text-gray-900 whitespace-nowrap hidden lg:table-cell text-center px-2"
                        >
                            {{ property.price }} €
                        </td>
                        <td
                            class="font-normal text-gray-900 whitespace-nowrap uppercase hidden md:table-cell text-center px-2"
                        >
                            <i
                                :class="{
                                    'fa-solid fa-check text-green-600':
                                        property.is_visible,
                                    'fa-solid fa-xmark text-red-600':
                                        !property.is_visible,
                                }"
                            ></i>
                        </td>
                        <td
                            class="font-normal text-gray-900 whitespace-nowrap uppercase hidden md:table-cell text-center px-2"
                        >
                            <i
                                :class="{
                                    'fa-solid fa-check text-green-600':
                                        property.is_sponsored,
                                    'fa-solid fa-xmark text-red-600':
                                        !property.is_sponsored,
                                }"
                            ></i>
                        </td>

                        <td
                            class="font-normal text-gray-900 whitespace-nowrap text-center px-2"
                        >
                            <Link
                                :href="route('properties.show', property)"
                                class="text-white hover:text-black transition delay-150 bg-blue-800 hover:bg-blue-600 px-3 py-2 rounded-lg"
                            >
                                <i class="fa-regular fa-eye"></i>
                            </Link>

                            <Link
                                :href="route('properties.edit', property)"
                                class="text-white hover:text-black transition delay-150 bg-yellow-400 hover:bg-yellow-200 px-3 py-2 rounded-lg mx-2"
                            >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </Link>

                            <button
                                class="text-white hover:text-black transition delay-150 bg-red-600 hover:bg-red-400 px-3 py-2 rounded-lg"
                                @click="deleteItem(property)"
                            >
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<style></style>
