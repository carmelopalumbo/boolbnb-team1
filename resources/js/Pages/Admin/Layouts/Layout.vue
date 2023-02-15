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
    <Header />

    <header>
        <h1 class="text-blue-600">Prova layout {{ name }}</h1>
    </header>
    <Nav />

    <slot/>

</template>


<style>

</style>
