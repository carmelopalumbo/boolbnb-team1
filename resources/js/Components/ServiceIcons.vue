<script>
export default {
    name: "ServiceIcons",
    props: {
        services: String,
    },
};
</script>

<template>
    <p v-if="services === 'cucina'">
        <i class="fas fa-utensils text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">cucina</span>
    </p>
    <p v-if="services === 'tv'">
        <i class="fas fa-tv text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">tv</span>
    </p>
    <p v-if="services === 'wifi'">
        <i class="fas fa-wifi text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">wi-fi</span>
    </p>
    <p v-if="services === 'posto auto'">
        <i class="fas fa-parking text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">posto auto</span>
    </p>
    <p v-if="services === 'piscina'">
        <i class="fas fa-swimming-pool text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">piscina</span>
    </p>
    <p v-if="services === 'aria condizionata'">
        <i class="fas fa-wind text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">aria condizionata</span>
    </p>
    <p v-if="services === 'vista mare'">
        <i class="fas fa-water text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">vista mare</span>
    </p>
    <p v-if="services === 'ascensore'">
        <i class="fas fa-elevator text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">ascensore</span>
    </p>
    <p v-if="services === 'animali ammessi'">
        <i class="fas fa-paw text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">animali ammessi</span>
    </p>
    <p v-if="services === 'giardino'">
        <i class="fas fa-tree text-[#4d1635] text-xl"></i>
        <span class="uppercase ml-2">giardino</span>
    </p>
</template>
