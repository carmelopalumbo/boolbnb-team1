<script>
import { Navbar } from "flowbite-vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "Header",
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
    },
};
</script>

<template>
    <section class="header-top-fix dark:bg-[#111827]">
        <nav class="px-2 sm:px-4 py-2.5">
            <div class="w-full flex justify-between">
                <div class="flex">
                    <Link href="/">
                        <img
                            class="max-h-20 object-scale-down dark:invert"
                            src="../../../../../public/Logo_V2.png"
                            alt="Logo Boolbnb"
                        />
                    </Link>
                </div>

                <div v-if="canLogin" class="sm:block text-right flex mx-10">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('properties.index')"
                    >
                        <img
                            class="avatarhome hover:scale-110 transition delay-150 dark:invert"
                            src="../../../../../public/avatarplaceholder.png"
                            alt="avatarplaceholder"
                        />
                    </Link>

                    <div v-else class="pt-4">
                        <Link
                            :href="route('login')"
                            class="text-gray-500 uppercase font-bold transition delay-150 text-lg hover:text-[#4d1635] dark:text-white dark:hover:text-[#89275e]"
                            >Log in</Link
                        >

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="ml-6 text-gray-500 uppercase font-bold transition delay-150 text-lg hover:text-[#4d1635] dark:text-white dark:hover:text-[#89275e]"
                            >Registrati</Link
                        >
                    </div>
                </div>
            </div>
        </nav>
    </section>
</template>

<style lang="css" scoped>
.active {
    /* color: white; */
    color: #4d1635;
    /* background-color: #4d1635; */
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    border: 2px solid #4d1635;
}

section {
    border-bottom: 1px solid white;
    height: 95px;
}

.avatarhome {
    height: 70px;
    width: 70px;
    border-radius: 50%;
    object-fit: cover;
}
</style>
