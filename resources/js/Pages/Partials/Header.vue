<script setup>
import { Navbar, NavbarLogo, NavbarCollapse, NavbarLink } from "flowbite-vue";
import { Link } from "@inertiajs/vue3";
import DropdownLink from "@/Components/DropdownLink.vue";
</script>

<template>
    <section class="header-top-fix">
        <Navbar>
            <template #logo>
                <!-- <NavbarLogo> -->
                <img
                    class="max-h-10 object-scale-down"
                    src="../Admin/Layouts/Images/Logo_V2.png"
                    alt="Logo Boolbnb"
                />
                <!-- </NavbarLogo> -->
            </template>

            <template #default="{ isShowMenu }">
                <NavbarCollapse :isShowMenu="isShowMenu" class="z-10">
                    <NavbarLink className="text-base text-center items-center pb-2"
                        ><Link
                            href="/admin/properties"
                            :class="{ 'active': $page.url === '/admin/properties' }"
                            class="align-middle transition delay-150 hover:text-[#4d1635]"
                            ><i class="fa-solid fa-house mr-1"></i
                            ><span class="active:text-red-500 active:font-bold">Proprietà</span></Link
                        ></NavbarLink
                    >
                    <NavbarLink className="text-base text-center pb-2"
                        ><Link
                            href="/admin/messages"
                            :class="{ 'active': $page.url === '/admin/messages' }"
                            class="align-middle transition delay-150 hover:text-[#4d1635]"
                            ><i class="fa-solid fa-message mr-1"></i
                            ><span class="">Messaggi</span></Link
                        ></NavbarLink
                    >
                    <NavbarLink className="text-base text-center pb-2"
                        ><Link
                            href="/admin/sponsors"
                            :class="{ 'active': $page.url === '/admin/sponsors' }"
                            class="align-middle transition delay-150 hover:text-[#4d1635]"
                            ><i class="fa-solid fa-credit-card mr-1"></i
                            ><span class="">Sponsor</span></Link
                        ></NavbarLink
                    >
                    <NavbarLink className="text-base text-center pb-2"
                        ><Link
                            href="/admin/stats"
                            :class="{ 'active': $page.url === '/admin/stats' }"
                            class="align-middle transition delay-150 hover:text-[#4d1635]"
                            ><i class="fa-solid fa-ranking-star mr-1"></i
                            ><span class="">Statistiche</span></Link
                        ></NavbarLink
                    >
                    <Link
                        :href="route('logout')"
                        method="post"
                        as="button"
                        class="text-white bg-[#4d1635] text-sm px-4 py-2.5 text-center md:mr-0 transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-300 font-bold rounded-lg w-25 mx-auto"
                    >
                        Log Out
                    </Link>
                </NavbarCollapse>
            </template>
        </Navbar>
    </section>
</template>

<style lang="css" scoped>
.active{
    color: #4d1635;
}

</style>
