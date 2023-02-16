<script setup>
import { Navbar, NavbarLogo, NavbarCollapse, NavbarLink } from 'flowbite-vue'
</script>

<template>
    <Navbar class="bg-slate-500">
      <template #logo>

        <NavbarLogo link="https://www.google.com/" alt="Flowbite logo" image-url="https://flowbite.com/docs/images/logo.svg" src="../Admin/Layouts/Images/Logo_V2.png">
            <img class="max-h-10 object-scale-down" src="../Admin/Layouts/Images/Logo_V2.png" alt="Logo Boolbnb">
        </NavbarLogo>
      </template>

      <template #default="{isShowMenu}">
        <NavbarCollapse :isShowMenu="isShowMenu">
          <NavbarLink is-active><Link href="/admin/properties"><i class="fa-solid fa-house mr-2"></i><span class="mr-4">Proprietà</span></Link></NavbarLink>
          <NavbarLink><Link href="/admin/messages"><i class="fa-solid fa-message mr-2"></i><span class="mr-4">Messaggi</span></Link></NavbarLink>
          <NavbarLink><Link href="/admin/sponsors"><i class="fa-solid fa-credit-card mr-2"></i><span class="mr-4">Sponsor</span></Link></NavbarLink>
          <NavbarLink><Link href="/admin/stats"><i class="fa-solid fa-ranking-star mr-2"></i><span class="mr-4">Statistiche</span></Link></NavbarLink>
          <button type="button" class="text-white bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-blue-300 text-sm px-5 py-2.5 text-center mr-3 md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hover:bg-cyan-900 font-bold rounded-lg">Logout</button>
        </NavbarCollapse>
      </template>

      <template #right-side>
      </template>
    </Navbar>
</template>
