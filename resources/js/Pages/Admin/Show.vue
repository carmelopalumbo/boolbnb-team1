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

                <img width="500" src="{{$property.cover_image}}" alt="{{$property.cover_image}}">

            </div>

            <div class="flex">
                <div class="border-[#4d1635] border-2 rounded-md m-5 w-2/3 p-3">
                    <h4>Misure: {{ property.size }}</h4>
                    <p>Numero stanze: {{ property.rooms }}</p>
                    <p>Numero letti : {{ property.beds }}</p>
                    <p>Numero bagni: {{ property.bathrooms }}</p>
                    <p>Prezzo: {{ property.price }}</p>
                </div>

                <div
                    class="flex-end border-[#4d1635] border-2 rounded-md m-5 w-1/3 p-6"
                >
                    <p class="mb-2">
                        Controlla le Statistiche
                        <Link
                            href="/admin/stats"
                            class="text-white hover:text-black transition delay-150 bg-green-400 hover:bg-yellow-200 px-3 py-2 rounded-lg mx-3"
                        >
                            <i class="fa-solid fa-ranking-star mr-1"></i>
                        </Link>
                    </p>

                    <p class="mb-2">
                        Modifica qui il tuo appartamento
                        <Link
                            :href="route('properties.edit', property)"
                            class="text-white hover:text-black transition delay-150 bg-yellow-400 hover:bg-yellow-200 px-3 py-2 rounded-lg mx-2"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </Link>
                    </p>

                    <p>
                        Cancella il tuo appartamento
                        <button
                            class="text-white hover:text-black transition delay-150 bg-red-600 hover:bg-red-400 px-3 py-2 rounded-lg"
                            @click="deleteItem(property)"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </p>
                </div>
            </div>

            <div class="border-[#4d1635] border-2 rounded-md m-5 w-2/3 p-3">
                <h2 class="font-bold mb-3">Descrizione dell'appartamento:</h2>
                <p>{{ property.description }}</p>
            </div>


        </main>
    </section>
</template>

<style></style>
