<script>
export default {
    name: 'Home',

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
    }
}
</script>

<template>
          <div
            v-if="canLogin"
            class="hidden fixed top-0 right-0 px-6 py-4 sm:block"
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
</template>

<style>

</style>
