<script>
export default {
    components: {Link},

}
import { Link } from '@inertiajs/vue3'
</script>

<template>
      <section class="sidenav w-1/12 bg-gray-400 h-screen m-0">

        <div class="nav">

            <nav class="nav-top p-4">
                <div class="mx-3">
                    <Link href="/admin">
                        <div class="user rounded-full h-16 w-16 flex items-center justify-center bg-cyan-700 text-center text-4xl">
                            JT
                        </div>
                    </Link>
                </div>
                <ul class=" flex flex-col p-0 ml-1 mt-8 text-lg text-white font-bold">
                    <Link href="/admin/properties">Proprietà</Link>
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
