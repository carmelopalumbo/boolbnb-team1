<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-[#4d1635] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#7a305a] focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
