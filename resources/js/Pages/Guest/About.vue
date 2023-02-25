<script>
import Header from "./Partials/Header.vue";
import Footer from "./Partials/Footer.vue";

export default {
    name: "About",

    components: { Header, Footer },
};
</script>

<template>
    <Header />
        <main class="ofc">

            <div class="container mx-auto w-5/6 rounded-md border-[#4d1635]">
                <h1>ABOUT US</h1>
            </div>

        </main>

    <Footer />
</template>

<style>

.ofc{
    height: calc(100vh - 195px);
    overflow-y: scroll;
    /* margin-bottom: 20px; */
}

</style>
