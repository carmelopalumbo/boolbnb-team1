<script>
export default {
  components: { Nav, Header },
  props:{
    name: String,
  }

}
import Nav from '@/Pages/Partials/Nav.vue';
import Header from '@/Pages/Partials/Header.vue';

</script>

<template>

    <header>
        <h1>Prova layout {{ name }}</h1>
    </header>
    <Nav />
    <Header />

    <slot/>

</template>


<style>

</style>
