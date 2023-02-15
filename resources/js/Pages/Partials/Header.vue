<script>
export default {
    components: { Link },

}
import { Link } from '@inertiajs/vue3'
</script>

<template>

  <header class="bg-gray-100 h-32 w-screen m-0 px-8 flex justify-between items-center border-b-2 border-gray-600">
    <div class="logo">
        <img class="max-h-20 object-scale-down" src="../Admin/Layouts/Images/Logo_V2.png" alt="Logo Boolbnb">
    </div>
    <div class="nav-bar">
        <ul class="flex justify-between p-0 text-2xl text-gray-600 font-bold ">
            <li class="">
                <Link href="/admin/properties"><i class="fa-solid fa-house mr-2 lg:mr-8"></i><span class="mr-4 hidden lg:inline-block">Proprietà</span></Link>
            </li>
            <li class="flex">
                <Link href="/admin/messages"><i class="fa-solid fa-message mr-2 lg:mr-4"></i><span class="mr-4 hidden lg:inline-block">Messaggi</span></Link>
            </li>
            <li class="flex">
                <Link href="/admin/sponsors"><i class="fa-solid fa-credit-card mr-2 lg:mr-4"></i><span class="mr-4 hidden lg:inline-block">Sponsor</span></Link>
            </li>
            <li class="flex">
                <Link href="/admin/stats"><i class="fa-solid fa-ranking-star mr-2 lg:mr-4"></i><span class="mr-4 hidden lg:inline-block">Statistiche</span></Link>
            </li>
        </ul>
    </div>
    <div class="logout">
        <button class="bg-cyan-700 hover:bg-cyan-900 text-white font-bold py-2 px-4 rounded-lg">
            <Link href="/admin/stats">Logout</Link>
        </button>
    </div>
  </header>


<!-- <nav class= "border-gray-200 px-2 md:px-4 py-2.5 bg-gray-200">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
        <img class="max-h-20 object-scale-down" src="../Admin/Layouts/Images/Logo_V2.png" alt="Logo Boolbnb">

        <div id="mega-menu" class="items-center justify-between hidden w-full text-sm md:flex md:w-auto md:order-1">
            <ul class="flex flex-col mt-4 font-medium md:flex-row md:space-x-8 md:mt-0">
                <li class="inline-block">
                    <Link href="/admin/properties"><i class="fa-solid fa-house flex items-center py-2 pl-3 pr-4 text-blue-600 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-blue-500 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"></i><span class="mr-4 inline-block">Proprietà</span></Link>
                </li>
                <li>
                    <Link href="/admin/messages"><i class="fa-solid fa-message block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"></i><span class="mr-4">Messaggi</span></Link>
                </li>
                <li>
                    <Link href="/admin/sponsors"><i class="fa-solid fa-credit-card block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"></i><span class="mr-4">Sponsor</span></Link>
                </li>
                <li>
                    <Link href="/admin/stats"><i class="fa-solid fa-ranking-star block py-2 pl-3 pr-4 text-gray-700 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-gray-400 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700"></i><span class="mr-4">Stats</span></Link>
                </li>
            </ul>
        </div>
        <div class="flex items-center md:order-2">
        <a href="#" class="text-white bg-cyan-700 hover:bg-cyan-900 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 mr-1 md:mr-2">Logout</a>
        <button data-collapse-toggle="mega-menu" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mega-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
        </button>
    </div>
    </div>
</nav> -->



</template>

<style>

</style>
