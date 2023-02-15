<script>
export default {
    components: { Link },

}
import { Link } from '@inertiajs/vue3'
</script>

<template>
  <header class="bg-gray-300 h-32 m-0 px-2 flex justify-between items-center">
    <div class="">
        <img class="h-40 object-scale-down" src="../Admin/Layouts/Images/Logo_V1.png" alt="Logo Boolbnb">
    </div>
    <div class="">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
            <Link href="/admin/stats">Logout</Link>
        </button>
    </div>
  </header>
</template>

<style>

</style>
