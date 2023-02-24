<script>
export default {
    name: "PropertyDetail",
    props: { property: Object },

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
    <header class="flex justify-center header-top-fix mx-auto w-5/6 mt-4">
        <img
            class="max-h-10 object-scale-down"
            src="../../../../public/Logo_V2.png"
            alt="Logo Boolbnb"
        />
    </header>

    <div class="ofc">
        <main class="container mx-auto w-5/6">
            <div class="flex justify-center">
                <div class="text-center w-2/4 mx-8">
                    <h1 class="text-2xl">
                        {{ property.name }}
                    </h1>
                    <p>
                        Indirizzo:
                        {{ property.address }}
                    </p>
                </div>
            </div>

            <div class="relative m-5">
                <h2 class="text-center py-2">Immagine di copertina</h2>

                <img
                    class="mx-auto mb-3"
                    width="300"
                    height="300"
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
                <div class="flex flex-col">
                    <div class="m-5 w-2/3 p-3">
                        <h4>Misure: {{ property.size }}</h4>
                        <p>Numero stanze: {{ property.rooms }}</p>
                        <p>Numero letti : {{ property.beds }}</p>
                        <p>Numero bagni: {{ property.bathrooms }}</p>
                        <p>Prezzo: {{ property.price }} €</p>
                    </div>
                    <div class="m-5 w-2/3 p-3">
                        <h2 class="font-bold mb-3">
                            Descrizione dell'appartamento:
                        </h2>
                        <p>Qui ci va la description</p>
                    </div>
                    <div class="m-5 w-2/3 p-3">
                        <h2 class="font-bold mb-3">
                            Servizi dell'appartamento:
                        </h2>
                        <p>qui vanno i servizi</p>
                    </div>
                </div>

                <form
                    class="border-[#4d1635] border-2 rounded-md w-2/3 m-5 p-3 rows-span-2"
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="nome.cognome@esempio.com"
                            required
                        />
                    </div>
                    <label
                        for="message"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Scrivi il tuo messaggio</label
                    >
                    <textarea
                        v-model="message.content"
                        id="message"
                        rows="7"
                        class="block resize-none p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Scrivi qui il tuo messaggio"
                    ></textarea>
                    <button
                        @click.prevent="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-2 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        Invia
                    </button>
                </form>

                <div v-else>
                    <h4>MESSAGGIO INVIATO BLA BLA BLA BLA</h4>
                </div>
            </div>
        </main>
    </div>
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
