<script>
import { Navbar } from "flowbite-vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "Header",
    props: {
        canLogin: Boolean,
        canRegister: Boolean,
    },
}
</script>

<template>
    <section class="header-top-fix">
        <nav class="bg-white border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
            <div class="container flex flex-wrap items-center justify-between mx-auto">
                <img
                    class="max-h-20 object-scale-down"
                    src="../../../../../public/Logo_V2.png"
                    alt="Logo Boolbnb"
                />


                <div v-if="canLogin" class="px-6 py-4 sm:block text-right">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('properties.index')"
                        class="text-sm text-gray-700 dark:text-gray-500 underline uppercase"
                        >Il mio profilo</Link
                    >

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="text-sm text-gray-700 dark:text-gray-500 underline"
                            >Log in</Link
                        >

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline"
                            >Register</Link
                        >
                    </template>
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
</style>
