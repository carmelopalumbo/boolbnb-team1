<script>
export default {
    name: "PropertyCard",
    props: {
        property: Object,
    },
};
</script>

<template>
    <div class="group container max-w-md">
        <div
            class="max-w-md border-4 rounded-xl border-[#4d1635] dark:border-[#89275e] m-5 relative flex align-items-center justify-content-center cardshadow"
        >
            <img
                class="rounded-lg bg-cover bg-center bg-no-repeat h-64 w-full group-hover:opacity-25 dark:opacity-60 opacity-50"
                :src="
                    'http://[::1]:5173/storage/app/public/' +
                    property.cover_image
                "
                alt="Cover image"
            />
            <span
                v-if="property.is_sponsored"
                class="bg-green-200 text-green-600 absolute bottom-4 right-3 text-sm font-bold mr-2 px-2.5 py-0.5 rounded-full uppercase"
                >In evidenza</span
            >

            <div
                class="p-5 group-hover:opacity-0 absolute description text-[#89275e] dark:text-[#4d1635] font-bold"
            >
                <h5 class="mb-2 text-2xl tracking-tight uppercase">
                    {{ property.name }}
                </h5>
                <div class="text-xs mb-2">{{ property.address }}</div>
            </div>
            <div
                class="px-5 pt-1 rounded-lg absolute group-hover:opacity-0 bottom-1 left-1 text-[#89275e] dark:text-[#4d1635] description font-bold"
            >
                <p class="mb-3 border-[#89275e] border rounded-2xl px-3 py-0.5">
                    {{ property.price }} € / <i class="fa-solid fa-moon"></i>
                </p>
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 fd-sh group-hover:opacity-100 transition delay-150"
            >
                <div class="text-center">
                    <Link
                        class="text-center text-white rounded-lg p-4 font-bold text-lg bg-[#89275e] uppercase"
                        :href="route('propertydetail', property.slug)"
                    >
                        scopri di più
                        <i class="ml-2 fa-solid fa-arrow-right"></i>
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.description {
    text-shadow: 1px 1px 4px white;
}
.cardshadow {
    box-shadow: 5px -3px 16px -3px #4d1635;
}
</style>
