<script>
export default {
    name: 'Home',

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
        properties: Object,
    },

    mounted(){
        console.log(this.properties);
    }

}
</script>

<template>
          <div
            v-if="canLogin"
            class="px-6 py-4 sm:block text-right"
        >
            <Link
                v-if="$page.props.auth.user"
                :href="route('properties.index')"
                class="text-sm text-gray-700 dark:text-gray-500 underline"
                >IL MIO PROFILO</Link
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



        <h1 class="text-center pt-6">SITO PUBBLICO</h1>
        <div class="flex justify-center">
            <input type="text" placeholder="search" class="border-2 rounded">
        </div>

</template>

<style>

</style>
