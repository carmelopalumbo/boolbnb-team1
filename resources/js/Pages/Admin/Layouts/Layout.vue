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
    <div class="ofc dark:text-white dark:bg-[#111827]">
        <slot />
    </div>

    <Footer />
</template>

<style>
.ofc {
    height: calc(100vh - 130px);
    padding: 25px 0;
    border-top: 1px solid white;
    overflow-y: scroll;
    /* margin-bottom: 20px; */
}
</style>
