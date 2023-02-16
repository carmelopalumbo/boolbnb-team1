<script>
export default {
    components: { Header, Footer },

};
// import Nav from "@/Pages/Partials/Nav.vue";
import Header from "@/Pages/Partials/Header.vue";
import Footer from "@/Pages/Partials/Footer.vue";
</script>

<template>
    <Header />

    <slot/>

    <Footer/>
</template>

<style>

</style>
