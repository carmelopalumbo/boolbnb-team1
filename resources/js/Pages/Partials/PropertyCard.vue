<script>
export default {
    name: "PropertyCard",
    props: {
        property: Object,
    },
};
</script>

<template>
    <div class="group container max-w-sm ">
        <div class="max-w-sm border-2 rounded-xl border-[#4d1635] m-5 relative flex align-items-center justify-content-center">
            <!-- <img class="rounded-xl object-none h-48 w-96 group-hover:opacity-25 opacity-60" src="https://images.unsplash.com/photo-1522093007474-d86e9bf7ba6f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&q=80" alt=""/> -->

            <img class="rounded-xl bg-cover bg-center bg-no-repeat h-48 w-96 group-hover:opacity-25" :src="'http://[::1]:5173/storage/app/public/' + property.cover_image" alt=""/>

            <div class="p-5 group-hover:opacity-0 absolute description text-[#89275e]">
                <h5 class="mb-2 text-2xl font-bold tracking-tight ">{{ property.name }}</h5>
                <div class="text-xs mb-2">{{ property.address }}</div>
            </div>
            <div class="px-5 pt-1 rounded-lg absolute group-hover:opacity-0 bottom-1 left-1 text-[#89275e] description ">

                <p class="mb-3 font-normal text-bold ">
                    Prezzo: {{ property.price }} €
                </p>

            </div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 fd-sh group-hover:opacity-100">
                <div class="text-center">
                    <button
                        class="text-center text-white rounded-lg p-4 font-bold text-lg bg-[#89275e]"
                    >
                        Learn more
                        <i class="ml-2 fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<style>
.description {
    text-shadow: 1px 1px 2px white;
}

img {
    filter: brightness(0.7);
}
</style>
