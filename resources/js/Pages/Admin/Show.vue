<script>
    export default {
        name: 'PropertyDetail',
        props: { property:Object },

    }
</script>

<template>
    <h1>Dettaglio properietà: {{ property.name }}</h1>
    <h4>Misure: {{ property.size }}</h4>
    <p>Numero stanze: {{ property.bedrooms }}</p>
    <p>Numero letti : {{ property.beds }}</p>
    <p>Numero bagni: {{ property.bathrooms }}</p>
    <p>Indirizzo: {{ property.address }}</p>
    <p>Prezzo: {{ property.price }}</p>

</template>


<style>

</style>
