<script>
import Layout from "./Layouts/Layout.vue";
import { Link } from "@inertiajs/vue3";
import { initAccordions } from "flowbite";

export default {
    name: "Messages",
    layout: Layout,
    props: {properties: Object},

    components: {Accordion},

    methods: {
        deleteMessage(message) {
            if (confirm("Confermi eliminazione?"))
                this.$inertia.delete(route("mymessages.delete", message));
        },
    },
    mounted(){
        console.log(this.properties);
        initAccordions();
    }
};
</script>

<template>
    <Head title="I MIEI MESSAGGI"></Head>
    <div class="flex justify-center mx-auto">
        <div class="py-6 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h2 class="text-center font-black text-4xl pb-8 uppercase text-[#4d1635]">
                    <i class="fa-solid fa-message"></i>
                        <span class="px-3">i miei messaggi </span>
                    <i class="fa-solid fa-message"></i>
                 </h2>

                <div id="accordion-collapse" data-accordion="collapse" v-for="property in properties" :key="property.id" class="w-4/6 mx-auto my-2">
                    <div v-if="property.messages.length">
                        <h2 :id="'accordion-collapse-heading-'+property.id">
                        <button type="button" class="flex items-center justify-between w-full p-5 font-medium text-left text-[#4d1635] border border-[#4d1635] rounded-t-xl hover:bg-gray-100 " :data-accordion-target="'#accordion-collapse-body-'+property.id" aria-expanded="false" :aria-controls="'accordion-collapse-body-'+property.id">
                            <span>Messaggi ricevuti per [ {{property.name}} ]</span>
                            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                        </h2>
                        <div :id="'accordion-collapse-body-'+property.id" class="hidden" :aria-labelledby="'accordion-collapse-heading-'+property.id">
                            <div v-for="message in property.messages" :key="message.id" class="p-5 font-light border border-t-0 border-[#4d1635] flex justify-between">
                                <div>
                                    <div class="mb-2 font-bold">Ricevuto da: <p class="font-normal pl-2 py-2">{{message.email}}</p></div>
                                    <div class="mb-2 font-bold">Messaggio:
                                        <p class="font-normal pl-2 py-2">{{message.content}}</p></div>
                                </div>
                                <button
                                    class="text-white hover:text-black transition delay-150 bg-red-600 hover:bg-red-400 px-3 py-2 rounded-lg h-12"
                                    @click="deleteMessage(message)"
                                >
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>





</template>

<style></style>
