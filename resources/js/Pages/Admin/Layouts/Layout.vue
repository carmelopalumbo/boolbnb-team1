<script>
export default {
  components: { Nav, Header },

}
import Nav from '@/Pages/Partials/Nav.vue';
import Header from '@/Pages/Partials/Header.vue';


</script>

<template>
    <Header />

    <!-- <Nav /> -->

    <slot/>

</template>


<style>

</style>
