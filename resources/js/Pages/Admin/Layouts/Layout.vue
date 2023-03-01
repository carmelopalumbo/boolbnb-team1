<script>
export default {
    components: { Header, Footer },
};
// import Nav from "@/Pages/Partials/Nav.vue";
import Header from "@/Pages/Admin/Partials/Header.vue";
import Footer from "@/Pages/Admin/Partials/Footer.vue";
</script>

<template>
    <Header />
    <div class="ofc dark:text-white dark:bg-[#111827] py-20">
        <slot />
    </div>

    <Footer />
</template>

<style>
.ofc {
    height: calc(100vh - 130px);
    overflow-y: scroll;
    /* margin-bottom: 20px; */
}
</style>
