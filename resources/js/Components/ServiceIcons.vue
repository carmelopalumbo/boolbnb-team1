<script>
export default {
    name: "ServiceIcons",
    props: {
        services: String,
    },
};
</script>

<template>
    <p v-if="services === 'cucina'"><i class="fas fa-utensils"></i> CUCINA</p>
    <p v-if="services === 'tv'"><i class="fas fa-tv"></i> TV</p>
    <p v-if="services === 'wifi'"><i class="fas fa-wifi"></i> WI-FI</p>
    <p v-if="services === 'posto auto'">
        <i class="fas fa-parking"></i> POSTO AUTO
    </p>
    <p v-if="services === 'piscina'">
        <i class="fas fa-swimming-pool"></i> PISCINA
    </p>
    <p v-if="services === 'aria condizionata'">
        <i class="fas fa-wind"></i> ARIA CONDIZIONATA
    </p>
    <p v-if="services === 'vista mare'">
        <i class="fas fa-water"></i> VISTA MARE
    </p>
    <p v-if="services === 'ascensore'">
        <i class="fas fa-elevator"></i> ASCENSORE
    </p>
    <p v-if="services === 'animali ammessi'">
        <i class="fas fa-paw"></i> ANIMALI AMMESSI
    </p>
    <p v-if="services === 'giardino'"><i class="fas fa-tree"></i> GIARDINO</p>
</template>
