<script>
export default {
    components: { Header, Footer },

};
// import Nav from "@/Pages/Partials/Nav.vue";
import Footer from "../Partials/Footer.vue";
</script>

<template>
    <!-- <div class="ofc ">
    <slot  />

    </div> -->

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
