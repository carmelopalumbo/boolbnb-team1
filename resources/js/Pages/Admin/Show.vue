<script>
import Layout from "./Layouts/Layout.vue";

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
                        <Link
                            href="/admin/stats"
                            class="text-white font-medium rounded-lg text-sm px-3 py-2.5 mb-2 w-10 h-10 transition delay-150 bg-green-400 hover:bg-green-200 hover:text-black"
                        >
                            <i class="fa-solid fa-ranking-star"></i>
                        </Link>
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

    <div class="flex">
        <div class="w-1/2">
            <apexchart
                :width="chart_visit.width"
                :height="chart_visit.height"
                :type="chart_visit.type"
                :options="chart_visit.options"
                :series="chart_visit.series"
            ></apexchart>
        </div>

        <div class="w-1/2">
            <apexchart
                :width="chart_message.width"
                :height="chart_message.height"
                :type="chart_message.type"
                :options="chart_message.options"
                :series="chart_message.series"
            ></apexchart>
        </div>
    </div>
    <p class="text-center">
        Vuoi aumentare le visite e messaggi ricevuti per il tuo appartamento?
        Dai un'occhiata al nostro servizio
        <Link :href="route('sponsors')"
            ><i class="fa-solid fa-rocket"></i>BOOST<i
                class="fa-solid fa-rocket"
            ></i
        ></Link>
    </p>
</template>

<style></style>
