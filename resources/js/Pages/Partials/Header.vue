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
              <NavbarLink className="text-base text-center"><Link href="/admin/properties" class="align-middle hover:text-[#4d1635]"><i class="fa-solid fa-house mr-1"></i><span class="">Proprietà</span></Link></NavbarLink>
              <NavbarLink className="text-base text-center "><Link href="/admin/messages" class="align-middle hover:text-[#4d1635]"><i class="fa-solid fa-message mr-1"></i><span class="">Messaggi</span></Link></NavbarLink>
              <NavbarLink className="text-base text-center"><Link href="/admin/sponsors" class="align-middle hover:text-[#4d1635]"><i class="fa-solid fa-credit-card mr-1"></i><span class="">Sponsor</span></Link></NavbarLink>
              <NavbarLink className="text-base text-center"><Link href="/admin/stats" class="align-middle hover:text-[#4d1635]"><i class="fa-solid fa-ranking-star mr-1"></i><span class="">Statistiche</span></Link></NavbarLink>
              <button type="button" class="text-white bg-[#4d1635] focus:ring-4 focus:outline-none text-sm px-5 py-2.5 text-center md:mr-0 hover:bg-[#89275e] font-bold rounded-lg w-25 mx-auto"><Link href="/logout" method="post" as="button"></Link>Logout</button>
            </NavbarCollapse>
          </template>

        </Navbar>
    </section>
</template>
