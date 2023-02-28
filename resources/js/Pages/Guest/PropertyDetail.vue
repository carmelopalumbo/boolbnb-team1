<script>
import Footer from "./Partials/Footer.vue";
import tt from "@tomtom-international/web-sdk-maps";
import ServiceIcons from "@/Components/ServiceIcons.vue";

export default {
    name: "PropertyDetail",

    components: { Footer, ServiceIcons },

    props: {
        property: Object,
        services: Object,
    },

    data() {
        return {
            message: {
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
        initMap() {
            const center = new tt.LngLat(
                parseFloat(this.property.longitude),
                parseFloat(this.property.latitude)
            );
            const map = tt.map({
                key: "ryfFS68OaO3jRhbpAPo3U6smYXGydYjO",
                container: "map",
                center: center,
                zoom: 18,
            });
            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());
        },
    },
    mounted() {
        this.initMap();
        console.log(this.property);
    },
};
</script>

<template>
    <section class="header-top-fix">
        <nav class="px-2 sm:px-4 py-4">
            <div class="mx-auto flex justify-center">
                <Link href="/">
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
                    class="mx-auto mb-3 rounded-md"
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

            <div class="flex justify-between flex-col md:flex-row">
                <div class="flex flex-col w-1/2 sm:mx-auto">
                    <div class="m-5 w-1/3 py-3">
                        <h2 class="uppercase text-[#4d1635] font-bold mb-3">
                            Dettagli appartamento:
                        </h2>
                        <h4 class="flex justify-between py-1">{{ property.size }}㎡</h4>
                        <h4 class="flex justify-between">
                            {{ property.rooms }} stanze
                        </h4>
                        <h4 class="flex justify-between py-1">
                            {{ property.beds }} posti letto
                        </h4>
                        <h4 class="flex justify-between py-1">
                            {{ property.bathrooms }} bagni
                        </h4>
                        <h4 class="flex justify-between py-1">{{ property.price }}€</h4>
                    </div>
                    <div class="m-5 w-2/3 py-3">
                        <h2 class="uppercase text-[#4d1635] font-bold mb-3">
                            Descrizione dell'appartamento:
                        </h2>
                        <p class="py-1">{{ property.description }}</p>
                    </div>
                    <div class="m-5 w-2/3 py-3">
                        <h2 class="uppercase text-[#4d1635] font-bold mb-3">
                            Servizi dell'appartamento:
                        </h2>
                        <div
                            v-for="service in property.services"
                            :key="service.id"
                            class="py-1"
                        >
                            <ServiceIcons :services="service.name" />
                        </div>
                    </div>

                </div>

                <form
                    class="border-[#4d1635] border-2 rounded-md w-1/2 m-5 p-3 rows-span-2 sm:mx-auto"
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
                        :disabled="!message.content"
                        class="text-white sm:w-auto px-5 py-2.5 mt-6 bg-[#4d1635] text-sm text-center mx-auto transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-lg disabled:hover:scale-100 disabled:hover:bg-[#4d1635] disabled:opacity-75"
                    >
                        Invia
                    </button>
                </form>

                <div v-else class="flex">
                    <h4
                        class="uppercase text-[#4d1635] self-center font-bold text-2xl text-center"
                    >
                        Messaggio inviato <br />
                        Il proprietario ti risponderà il prima possibile.
                    </h4>
                </div>
            </div>
            <div
                class="flex justify-center my-10 border-[#4d1635] border-2 p-6 rounded-xl cursor-grabbing"
            >
                <div class="mx-auto" id="map"></div>
            </div>
        </main>
    </div>
    <Footer />
</template>

<style>
#map {
    height: 800px;
    width: 100%;

}
.header-top-fix {
    height: 90px;
}
.ofc {
    height: calc(100vh - 195px);
    overflow-y: scroll;
    margin-bottom: 20px;
}
</style>
