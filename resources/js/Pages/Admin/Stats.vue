<script>
import Layout from "./Layouts/Layout.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "Stats",
    layout: Layout,
};
</script>

<template>
    <Head title="STATISTICHE"></Head>
    <div class="flex justify-center mx-auto">
        <div class="py-6 inline-block min-w-full sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h2 class="text-center font-black text-4xl pb-8 uppercase text-[#4d1635]">
                 <i class="fa-solid fa-chart-line"></i>
                <span class="px-3">statistiche delle mie proprietà</span>
                 <i class="fa-solid fa-chart-line"></i>
                </h2>
            </div>
        </div>
    </div>
</template>

<style></style>
