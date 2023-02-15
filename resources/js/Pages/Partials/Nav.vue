<script>
export default {
    components: {Link},

}
import { Link } from '@inertiajs/vue3'
</script>

<template>
      <section class="sidenav w-1/6 bg-slate-600 h-screen m-0">

        <div class="nav">

            <nav class="nav-top p-4">
                <div class="user rounded-full p-12 bg-red-600 text-center text-2xl">
                    JT
                </div>
                <ul class=" flex flex-col p-0 mt-8 text-lg">
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
