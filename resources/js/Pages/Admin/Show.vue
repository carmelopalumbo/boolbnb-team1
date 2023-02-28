<script>
import Layout from "./Layouts/Layout.vue";
import { initModals } from 'flowbite';

export default {
    name: "Show",
    props: {
        property: Object,
        services: Object,
        media_property: Object,
        chart_visit: Object,
        chart_message: Object,
    },
    layout: Layout,

    methods: {
        deleteItem(property) {
            if (confirm("Confermi eliminazione?"))
                this.$inertia.delete(route("properties.destroy", property));
        },
    },

    mounted() {
        console.log(this.media_property);
        initModals();
    },
};
</script>

<template>
    <Head :title="property.name"></Head>
    <section>
        <main class="container mx-auto w-5/6">
            <div class="flex justify-center">
                <div class="text-center w-2/4">
                    <h1 class="text-2xl font-bold uppercase text-[#4d1635] mb-4">{{ property.name }}</h1>
                    <p class="text-lg font-medium mb-4">{{ property.address }}</p>
                </div>
            </div>

            <div class="relative rounded-md m-5">
                <img
                    class="mx-auto mb-3 object-scale-down"
                    :src="
                        'http://[::1]:5173/storage/app/public/' +
                        property.cover_image
                    "
                />
            </div>

            <div
                v-if="media_property.image"
                class="relative border-[#4d1635] border-2 rounded-md m-5"
            >
                <h2 class="text-center py-2">Galleria</h2>

                <div class="flex justify-center gap-x-4 flex-wrap">
                    <img
                        v-for="image in media_property"
                        :key="image.id"
                        class="mb-3"
                        width="200"
                        height="200"
                        :src="
                            'http://[::1]:5173/storage/app/public/' +
                            image.file_name
                        "
                    />
                </div>
            </div>

            <div class="flex">
                <div class="m-5 w-2/3 p-3">
                    <h2 class="uppercase text-[#4d1635] font-bold mb-3">
                        Dettaglio appartamento:
                    </h2>
                    <h4>Misure: {{ property.size }}</h4>
                    <p>Numero stanze: {{ property.rooms }}</p>
                    <p>Numero letti : {{ property.beds }}</p>
                    <p>Numero bagni: {{ property.bathrooms }}</p>
                    <p>Prezzo: {{ property.price }} €</p>
                </div>

                <div class="flex flex-col rounded-md m-5 w-1/3 p-1">
                    <div class="inline-flex justify-between align-middle mb-2">
                        <div class="hidden lg:inline-block py-2.5">
                            Controlla le Statistiche
                        </div>
                        <!-- Modal toggle -->
                        <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="text-white font-medium rounded-lg text-sm px-3 py-2.5 mb-2 w-10 h-10 transition delay-150 bg-green-400 hover:bg-green-200 text-center" type="button">
                            <i class="fa-solid fa-ranking-star"></i>
                        </button>
                    </div>

                    <div class="inline-flex justify-between align-middle mb-2">
                        <div class="hidden lg:inline-block py-2.5">
                            Modifica qui il tuo appartamento
                        </div>
                        <Link
                            :href="route('properties.edit', property)"
                            class="text-white hover:text-black transition delay-150 bg-yellow-400 hover:bg-yellow-200 font-medium rounded-lg text-sm w-10 h-10 px-3 py-2.5 mb-2"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </Link>
                    </div>

                    <div class="inline-flex justify-between align-middle mb-2">
                        <div class="hidden lg:inline-block py-2.5">
                            Cancella il tuo appartamento
                        </div>
                        <button
                            href="http://127.0.0.1:8000/admin/properties"
                            class="text-white hover:text-black transition delay-150 bg-red-600 hover:bg-red-400 text-sm w-10 h-10 px-3 py-2.5 mb-2 rounded-lg"
                            @click="deleteItem(property)"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="m-5 w-2/3 p-3">
                <h2 class="uppercase text-[#4d1635] font-bold mb-3">
                    Descrizione dell'appartamento:
                </h2>
                <p>{{ property.description }}</p>
            </div>

            <div class="m-5 w-2/3 p-3">
                <h2 class="uppercase text-[#4d1635] font-bold mb-3">
                    Servizi dell'appartamento:
                </h2>
                <p
                    v-for="service in services"
                    :key="service.id"
                    class="uppercase"
                >
                    {{ service.name }}
                </p>
            </div>
        </main>
    </section>

    <!-- Main modal -->
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full px-0 py-20 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full max-w-4xl h-4/6">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 h-full overflow-y-auto">
                <!-- Modal header -->
                <div class="flex items-start justify-around p-4 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white ml-auto">
                        Le statistiche di <span class="text-[#4d1635] font-bold">{{ property.name }}</span>
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                        <svg aria-hidden="true" class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6">
                    <div class="flex flex-col space-y-10">
                        <div class="w-full h-1/2">
                            <apexchart
                                :width="chart_visit.width"
                                :height="chart_visit.height"
                                :type="chart_visit.type"
                                :options="chart_visit.options"
                                :series="chart_visit.series"
                            ></apexchart>
                        </div>

                        <div class="w-full h-1/2">
                            <apexchart
                                :width="chart_message.width"
                                :height="chart_message.height"
                                :type="chart_message.type"
                                :options="chart_message.options"
                                :series="chart_message.series"
                            ></apexchart>
                        </div>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="items-center p-6 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <p class="text-center">
                        Vuoi aumentare le visite e messaggi ricevuti per il tuo appartamento?<br>
                        Dai un'occhiata al nostro servizio
                        <Link :href="route('sponsors')" class="transition delay-150 text-[#4d1635] hover:text-[#89275e]"
                            ><i class="fa-solid fa-rocket"></i><span class="uppercase mx-1 font-bold">boost</span><i
                                class="fa-solid fa-rocket"
                            ></i
                        ></Link>
                    </p>
                </div>
            </div>
        </div>
    </div>



</template>

<style></style>
