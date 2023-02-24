<script>
import Footer from "./Partials/Footer.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "PropertyDetail",

    components: { Footer },

    props: {
        property: Object,
     },

    data() {
        return {
            message: {
                object: "",
                email: "",
                content: "",
            },

            isSend: false,
        };
    },

    methods: {
        submit() {
            this.$inertia.post(route("messages"), {
                message: this.message,
                property: this.property,
            });
            this.isSend = true;
        },
    },
};
</script>

<template>
    <section class="header-top-fix">
        <nav class="px-2 sm:px-4 py-4 ">
            <div class="mx-auto flex justify-center">
                <Link
                    href="/">
                    <img
                    class="max-h-20 object-scale-down"
                    src="../../../../public/Logo_V2.png"
                    alt="Logo Boolbnb"
                    />
                </Link>
            </div>
        </nav>
    </section>

    <div class="ofc mt-20">
        <main class="container mx-auto w-5/6">
            <div class="flex justify-center">
                <div class="text-center w-2/4 mx-8">
                    <h1 class="text-5xl text-[#4d1635]">
                        {{ property.name }}
                    </h1>
                    <p class="mt-2 text-xl">
                        {{ property.address }}
                    </p>
                </div>
            </div>

            <div class="relative m-5">
                <img
                    class="mx-auto mb-3 rounded-md "
                    width="600"
                    height="600"
                    :src="
                        'http://[::1]:5173/storage/app/public/' +
                        property.cover_image
                    "
                />
            </div>

            <!-- <div class="relative m-5">
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
            </div> -->

            <div class="flex">
                <div class="flex flex-col w-1/2">
                    <div class="m-5 w-2/3 p-3">
                        <h4>Misure: {{ property.size }}</h4>
                        <p>N° stanze: {{ property.rooms }}</p>
                        <p>N° posti letti : {{ property.beds }}</p>
                        <p>N° bagni: {{ property.bathrooms }}</p>
                        <p>Prezzo: {{ property.price }} €</p>
                    </div>
                    <div class="m-5 w-2/3 p-3">
                        <h2 class="font-bold mb-3">
                            Descrizione:
                        </h2>
                        <p>Qui ci va la description</p>
                    </div>
                    <div class="m-5 w-2/3 p-3">
                        <h2 class="font-bold mb-3">
                            Servizi disponibili nell'appartamento:
                        </h2>
                        <p>qui vanno i servizi</p>
                    </div>
                </div>

                <form
                    class="border-[#4d1635] border-2 rounded-md w-1/2 m-5 p-3 rows-span-2"
                    v-if="!isSend"
                >
                    <div class="mb-6">
                        <label
                            for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >La tua Email</label
                        >
                        <input
                            v-model="message.email"
                            type="email"
                            id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#4d1635] focus:border-[#4d1635] block w-full p-2.5"
                            placeholder="esempio@mail.com"
                            required
                        />
                    </div>
                    <label
                        for="message"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Messaggio</label
                    >
                    <textarea
                        v-model="message.content"
                        id="message"
                        rows="7"
                        class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-[#4d1635] focus:border-[#4d1635]"
                        placeholder="Scrivi qui il tuo messaggio"
                    ></textarea>

                    <button
                        @click.prevent="submit"
                        class="text-white sm:w-auto px-5 py-2.5 mt-4 bg-[#4d1635] text-sm text-center mx-auto transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-lg disabled:hover:scale-100 disabled:hover:bg-[#4d1635] disabled:opacity-75"
                    >
                        Invia
                    </button>
                </form>

                <div v-else>
                    <h4 class="uppercase">Messaggio inviato</h4>
                </div>
            </div>
        </main>
    </div>

    <Footer/>
</template>

<style>
.header-top-fix {
    height: 90px;
}
.ofc {
    height: calc(100vh - 195px);
    overflow-y: scroll;
    margin-bottom: 20px;
}
</style>
