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

            <div class="mx-auto h-5/6 w-5/6 mt-3 flex justify-between ">
                <div class="w-1/5 mx-2 rounded-md border-[#4d1635] border-2">

                </div>
                <div class="w-1/5 mx-2 rounded-md border-[#4d1635] border-2">
                    <h1>ciao</h1>
                </div>
                <div class="w-1/5 mx-2 rounded-md border-[#4d1635] border-2">
                    <h1>ciao</h1>
                </div>
                <div class="w-1/5 mx-2 rounded-md border-[#4d1635] border-2">
                    <h1>ciao</h1>
                </div>
                <div class="w-1/5 mx-2 rounded-md border-[#4d1635] border-2">
                    <h1>ciao</h1>
                </div>

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
