<script>
import Layout from "./Layouts/Layout.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "Messages",
    layout: Layout,
    props: {properties: Object},
    mounted(){
        console.log(this.properties);
    }
};
</script>

<template>
    <Head title="I MIEI MESSAGGI"></Head>
    <div class="flex justify-center mx-auto">
        <div class="py-6 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h3 class="text-center font-bold text-2xl py-6 uppercase">
                    messaggi ricevuti
                </h3>

                <div>

                    <div v-for="property in properties" :key="property.id">

                        <div v-if="property.messages.length" class="my-10">
                            <h5 v-if="property.messages.length">Messaggi ricevuti per {{property.name}}</h5>

                            <div v-for="message in property.messages" :key="message.id"
                            class="flex space-x-6">
                                <p>EMAIL: {{message.email}}</p>
                                <p>MESSAGGIO: {{message.content}}</p>
                            </div>

                        </div>


                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<style></style>
