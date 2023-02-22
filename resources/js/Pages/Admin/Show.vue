<script>
import Layout from "./Layouts/Layout.vue";

export default {
    name: "Show",
    props: {
                property: Object,
                services: Object,
                media_property: Object
            },
    layout: Layout,

    methods: {
        deleteItem(property) {
            if (confirm("Confermi eliminazione?"))
                this.$inertia.delete(route("properties.destroy", property));
        },
    },

    mounted(){
        console.log(this.media_property);
    }
};
</script>

<template>
    <Head :title="property.name"></Head>
    <section>
        <main class="container mx-auto w-5/6">
            <div class="flex justify-center">
                <div
                    class="text-center w-2/4 mx-8 border-[#4d1635] border-2 rounded-md"
                >
                    <h1 class="text-2xl">{{ property.name }}</h1>
                    <p>Indirizzo: {{ property.address }}</p>
                </div>
            </div>

            <div class="relative border-[#4d1635] border-2 rounded-md m-5">
                <h2 class="text-center py-2">Immagine di copertina</h2>

                <img class="mx-auto mb-3" width="300" height="300" :src="'http://[::1]:5173/storage/app/public/' + property.cover_image" >
            </div>

            <div v-if="media_property.image" class="relative border-[#4d1635] border-2 rounded-md m-5  ">
                <h2 class="text-center py-2">Galleria</h2>

                <div class="flex justify-center gap-x-4 flex-wrap">
                    <img v-for="image in media_property" :key="image.id" class="mb-3"  width="200" height="200"  :src="'http://[::1]:5173/storage/app/public/' + image.file_name" >
                </div>
            </div>



            <div class="flex">
                <div class="border-[#4d1635] border-2 rounded-md m-5 w-2/3 p-3">
                    <h4>Misure: {{ property.size }}</h4>
                    <p>Numero stanze: {{ property.rooms }}</p>
                    <p>Numero letti : {{ property.beds }}</p>
                    <p>Numero bagni: {{ property.bathrooms }}</p>
                    <p>Prezzo: {{ property.price }} €</p>
                </div>

                <div class="flex flex-col   rounded-md m-5 w-1/3 p-1">
                    <div class="grid grid-flow-col auto-cols-auto  mb-1">
                        <div class="hidden lg:inline-block place-self-start">
                            Controlla le Statistiche
                        </div>
                        <Link
                            href="/admin/stats"
                            class="text-white hover:text-black transition delay-150 bg-green-400 hover:bg-yellow-200 rounded-lg px-3 py-2 mx-2 w-10 h-12 place-self-end">
                            <i class="fa-solid fa-ranking-star"></i>
                        </Link>
                    </div>

                    <div class="grid grid-flow-col auto-cols-auto mb-1">
                        <div class="hidden lg:inline-block place-self-start">
                            Modifica qui il tuo appartamento
                        </div>
                        <Link
                            :href="route('properties.edit', property)"
                            class="text-white hover:text-black transition delay-150 bg-yellow-400 hover:bg-yellow-200 px-3 py-2 rounded-lg mx-2 w-10 h-12 place-self-end">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </Link>
                    </div>

                    <div class="grid grid-flow-col auto-cols-auto mb-1">
                        <div class="hidden lg:inline-block place-self-start">
                            Cancella il tuo appartamento
                        </div>
                        <button
                            href="http://127.0.0.1:8000/admin/properties"
                            class="text-white hover:text-black transition delay-150 bg-red-600 hover:bg-red-400 px-3 py-2 rounded-lg w-10 h-12 mx-2 place-self-end"
                            @click="deleteItem(property)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>

                </div>
            </div>

            <div class="border-[#4d1635] border-2 rounded-md m-5 w-2/3 p-3">
                <h2 class="font-bold mb-3">Descrizione dell'appartamento:</h2>
                <p>{{ property.description }}</p>
            </div>

            <div class="border-[#4d1635] border-2 rounded-md m-5 w-2/3 p-3 ">
                <h2 class="font-bold mb-3">Servizi dell'appartamento:</h2>
                <p v-for="service in services" :key="service.id" class="uppercase">

                    {{ service.name }}</p>
            </div>


        </main>
    </section>
</template>

<style></style>
