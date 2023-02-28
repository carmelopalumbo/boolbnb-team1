<script>
import Footer from "./Partials/Footer.vue";
import ServiceIcons from "@/Components/ServiceIcons.vue";
import tt from "@tomtom-international/web-sdk-maps";
import Swiper, { Navigation, Pagination, Scrollbar, Autoplay } from "swiper";
import { initCarousels } from "flowbite";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";
import "swiper/css/autoplay";

export default {
    name: "PropertyDetail",

    components: { Footer, ServiceIcons, Carousel},

    props: {
        property: Object,
        services: Object,
        media_property: Object,
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
        console.log(this.media_property);
        initCarousels();
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
                <div class="text-center w-full mx-8">
                    <h1 class="text-4xl text-[#4d1635]">
                        {{ property.name }}
                    </h1>
                    <p class="mt-2 text-xl">
                        {{ property.address }}
                    </p>
                </div>
            </div>

            <div v-if="!media_property.length" class="relative m-5">
                <img :src="'http://[::1]:5173/storage/app/public/' + property.cover_image" class="mx-auto mb-3 rounded-md" width="600" height="600" alt="cover image">
            </div>


            <div v-else id="default-carousel" class="relative my-8 carousel-inner" data-carousel="slide">
                <!-- Carousel wrapper -->
                <div class="relative h-96 overflow-hidden rounded-lg">
                    <!-- Cover image -->
                    <div class="hidden duration-500 ease-in-out" data-carousel-item>
                        <span class="absolute text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 sm:text-3xl dark:text-gray-800">First Slide</span>
                        <img :src="'http://[::1]:5173/storage/app/public/' + property.cover_image" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <!-- Gallery -->
                    <div
                    v-for="image in media_property"
                    :key="image.id" class="hidden duration-500 ease-in-out h-full" data-carousel-item>
                        <img :src="'http://[::1]:5173/storage/app/public/' + image.file_name" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>

                </div>
                <!-- Slider controls -->
                <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-hover:bg-[#4d1635]/50  group-focus:ring-4 group-focus:ring-[#4d1635] group-focus:outline-none focus:ring-[#4d1635] focus:border-[#4d1635]">
                        <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 group-focus:ring-4  group-hover:bg-[#4d1635]/50  group-focus:ring-[#4d1635] focus:ring-[#4d1635] focus:border-[#4d1635] group-focus:outline-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>

            <div class="flex justify-between flex-col md:flex-row">
                <div class="flex flex-col w-3/5 sm:mx-auto">
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
                    <div class="m-5 w-4/5 py-3">
                        <h2 class="uppercase text-[#4d1635] font-bold mb-3">
                            Descrizione dell'appartamento:
                        </h2>
                        <p class="py-1">{{ property.description }}</p>
                    </div>
                    <div class="m-5 w-2/3 py-3">
                        <h2 class="uppercase text-[#4d1635] font-bold mb-3">
                            Servizi dell'appartamento:
                        </h2>
                        <div v-if="!property.services.length">Nessun servizio</div>
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
                    class="border-[#4d1635] border-2 rounded-md w-2/5 m-5 p-3 rows-span-2 sm:mx-auto h-1/2"
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

<style lang="css" scoped>
#map {
    height: 550px;
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

/* .carousel-inner{
    height: 11200px;
} */

/* .swiper {
    width: 100%;
    height: 100%;
}

.swiper-slide {
    background-color: #eee;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
} */

/* .galleryimage{
    max-width:  600px;
    max-height: 600px;
    object-fit: cover;
} */

</style>
