<script>
import Layout from "./Layouts/Layout.vue";

export default {
    name: "Index",
    props: {
        my_properties: Object,
        username: String,
        links: Array,
    },

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
    <Head title="LE MIE PROPRIETÀ"></Head>
    <div class="flex justify-between container w-5/6 font-poppins py-6">
        <div class="md:inline-block align-middle hidden">
            <div class="overflow-hidden">
                <h1 class="text-center font-bold text-2xl italic ml-5">
                    Ciao <span class="uppercase">{{ username }}</span
                    >, benvenuto nella tua Dashboard di BoolBnB.
                </h1>
            </div>
        </div>
        <div
            class="py-2 px-4 text-[#4d1635] text-base font-bold rounded-lg border-2 border-[#4d1635] mx-4"
        >
            <span
                v-if="$page.props.flash.infoMessage"
                class="inline-block align-middle"
                >{{ $page.props.flash.infoMessage }}</span
            >
            <span v-else>Non hai notifiche</span>
        </div>
    </div>

    <div class="relative container mx-auto overflow-x-auto">
        <div
            class="relative container mx-auto w-5/6 mb-6"
            v-if="!my_properties.data.length"
        >
            <Link
                href="/admin/properties/create"
                class="hover:text-[#4d1635] text-lg font-bold uppercase text-green-700 ml-5 transition delay-150"
            >
                <i class="fa-solid fa-plus mr-1"></i
                ><span class="">Aggiungi la tua prima proprietà</span>
            </Link>
        </div>

        <div v-else>
            <div class="container w-5/6 mb-6">
                <Link
                    href="/admin/properties/create"
                    class="hover:text-[#4d1635] text-lg font-bold uppercase text-green-700 ml-5 transition delay-150 ease-in-out duration-200"
                >
                    <i class="fa-solid fa-plus mr-1"></i
                    ><span class="">Aggiungi una proprietà</span></Link
                >
            </div>
            <table
                class="w-5/6 table-auto text-base mx-auto text-left text-gray-500 border"
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
                            class="font-bold text-gray-900 hidden md:table-cell px-2"
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
                <tbody>
                    <tr
                        v-for="property in my_properties.data"
                        :key="property.id"
                        class="bg-white border-b hover:bg-gray-100 h-16 w-[50px]"
                    >
                        <td
                            class="font-medium text-gray-900 break-words truncate px-2"
                        >
                            <div class="truncate w-60 lg:w-64">
                                {{ property.name }}
                            </div>
                        </td>
                        <td
                            class="font-normal text-gray-900 truncate hidden md:table-cell w-1/6 px-2"
                        >
                            <div class="truncate w-40 lg:w-80">
                                {{ property.address }}
                            </div>
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
        <div
            class="mt-8 flex justify-center text-[#4d1635] text-lg font-bold space-x-6"
        >
            <Component
                :is="link.url ? 'Link' : 'span'"
                v-for="link in my_properties.links"
                :key="link.id"
                :href="link.url"
                v-html="link.label"
                :class="{
                    'text-gray-400': !link.url,
                    'border border-1 rounded-xl px-3 border-[#4d1635]':
                        link.active,
                }"
            >
            </Component>
        </div>
    </div>
</template>

<style></style>
