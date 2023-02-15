<script>
export default {
    components: {Link},

}
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <section class="sidenav w-1/12 bg-gray-400 h-screen m-0">

    <div class="nav">

        <nav class="nav-top flex flex-col justify-center p-4">
            <div class="mx-3">
                <Link href="/admin">
                    <div class="user rounded-full h-16 w-16 flex items-center justify-center bg-cyan-700 text-center text-4xl">
                        JT
                    </div>
                </Link>
            </div>
            <ul class="flex flex-col p-0 ml-1 mt-8 text-l text-white font-bold ">
                <li class="flex">
                    <Link href="/admin/properties"><i class="fa-solid fa-house mr-1 mb-2"></i><span class="invisible md:visible">Proprietà</span></Link>
                </li>
                <li class="flex">
                    <Link href="/admin/messages"><i class="fa-solid fa-message mr-1 mb-2"></i><span class="invisible md:visible">Messaggi</span></Link>
                </li>
                <li class="flex">
                    <Link href="/admin/sponsors"><i class="fa-solid fa-credit-card mr-1 mb-2"></i><span class="invisible md:visible">Sponsor</span></Link>
                </li>
                <li class="flex">
                    <Link href="/admin/stats"><i class="fa-solid fa-ranking-star mr-1 mb-2"></i><span class="invisible md:visible">Statistiche</span></Link>
                </li>
            </ul>
        </nav>


    </div>

    <div class="sidenav-bottom">

    </div>

    </section>

</template>

<style>

</style>
