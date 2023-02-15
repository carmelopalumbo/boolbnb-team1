<script>
export default {
    components: { Link },

}
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <header class="bg-gray-300 h-32 m-0 p-0 flex justify-between content-center">
    <img class="h-40" src="../Admin/Layouts/Images/Logo_V1.png" alt="Logo Boolbnb">
    <Link href="/admin/stats">Logout</Link>
  </header>
</template>

<style>

</style>
