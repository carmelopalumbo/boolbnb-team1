<script>
export default {
    components: {Link},

}
import { Link } from '@inertiajs/vue3'
</script>

<template>
      <section class="sidenav w-1/6 bg-gray-400 h-screen m-0">

        <div class="nav">

            <nav class="nav-top p-4">
                <div class="m-8">
                    <div class="user rounded-full h-32 w-32 flex items-center justify-center bg-cyan-700 text-center text-7xl">
                        JT
                    </div>
                </div>
                <ul class=" flex flex-col p-0 mt-8 text-lg text-white font-bold">
                    <Link href="/admin">Dashboard</Link>
                    <Link href="/admin/properties">Appartamenti</Link>
                    <Link href="/admin/messages">Messaggi</Link>
                    <Link href="/admin/sponsors">Sponsor</Link>
                    <Link href="/admin/stats">Statistiche</Link>

                </ul>
            </nav>


        </div>

        <div class="sidenav-bottom">

        </div>

    </section>

</template>

<style>

</style>
