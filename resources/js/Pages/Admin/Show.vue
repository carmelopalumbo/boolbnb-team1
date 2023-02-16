<script>

import Layout from "./Layouts/Layout.vue";

export default {
    name: "PropertyDetail",
    props: { property: Object },

    layout: Layout,
};
</script>

<template>
    <section class="">
        <main class="">
            <div  class="text-center bg-pink-900 w-30 mx-8 rounded-md">
                <h1 class="text-2xl ">{{ property.name }}</h1>
                <p>Indirizzo: {{ property.address }}</p>
            </div>

            <div class=" bg-auto bg-center w-30 h-auto mx-8 mt-2 rounded-md" style="background-image: url(https://www.arteincasamia.it/site/assets/files/1781/placeholder.png)">
                <h4>Misure: {{ property.size }}</h4>
                <p>Numero stanze: {{ property.bedrooms }}</p>
                <p>Numero letti : {{ property.beds }}</p>
                <p>Numero bagni: {{ property.bathrooms }}</p>
            </div>



        <p>Prezzo: {{ property.price }}</p>
    </main>
    </section>


</template>

<style></style>
