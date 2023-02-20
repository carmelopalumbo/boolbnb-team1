<script>
import Layout from "./Layouts/Layout.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "Messages",
    layout: Layout,
};
</script>

<template>
    <Head title="I MIEI MESSAGGI"></Head>
    <div class="flex justify-center mx-auto">
        <div class="py-6 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h1 class="text-center font-bold text-2xl py-6 uppercase">
                    I miei messaggi
                </h1>
            </div>
        </div>
    </div>
</template>

<style></style>
