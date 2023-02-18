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
    <div class="ofc ">
    <slot  />

    </div>

    <Footer/>
</template>

<style>
.header-top-fix{
    height: 120px;
}
.ofc{
    height: calc(100vh - 195px);
    overflow-y: scroll;
    margin-bottom: 20px;
}
.footer-bottom-fix{
 height: 75px;
}
</style>
