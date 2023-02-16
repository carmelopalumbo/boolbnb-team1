<script setup>
import { Navbar, NavbarLogo, NavbarCollapse, NavbarLink } from 'flowbite-vue'
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <section>
        <Navbar>

          <template #logo>
            <!-- <NavbarLogo> -->
                <img class="max-h-10 object-scale-down" src="../Admin/Layouts/Images/Logo_V2.png" alt="Logo Boolbnb">
            <!-- </NavbarLogo> -->
          </template>

          <template #default="{isShowMenu}">
            <NavbarCollapse :isShowMenu="isShowMenu">
              <NavbarLink className="text-base"><Link href="/admin/properties" class="align-middle"><i class="fa-solid fa-house mr-1"></i><span class="hover:text-cyan-700">Proprietà</span></Link></NavbarLink>
              <NavbarLink className="text-base hover:text-cyan-700 hover:bg-red-600"><Link href="/admin/messages" class="align-middle"><i class="fa-solid fa-message mr-1"></i><span class="">Messaggi</span></Link></NavbarLink>
              <NavbarLink className="text-base  hover:text-cyan-700"><Link href="/admin/sponsors" class="align-middle"><i class="fa-solid fa-credit-card mr-1"></i><span class="">Sponsor</span></Link></NavbarLink>
              <NavbarLink className="text-base"><Link href="/admin/stats" class="align-middle"><i class="fa-solid fa-ranking-star mr-1"></i><span class="">Statistiche</span></Link></NavbarLink>
              <button type="button" class="text-white bg-cyan-700 focus:ring-4 focus:outline-none focus:ring-blue-300 text-sm px-3 py-2.5 text-center md:mr-0 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hover:bg-cyan-900 font-bold rounded-lg"><Link href="/logout" method="post" as="button"></Link>Logout</button>
            </NavbarCollapse>
          </template>

        </Navbar>
    </section>
</template>
