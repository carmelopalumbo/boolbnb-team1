<script setup>
import { Navbar, NavbarLogo, NavbarCollapse, NavbarLink } from "flowbite-vue";
import { Link } from "@inertiajs/vue3";
import DropdownLink from "@/Components/DropdownLink.vue";
import { Dropdown } from "flowbite";

</script>

<template>
    <header>
        <Navbar className="h-full py-3 dark:bg-[#111827] relative">
            <template #logo>
                <!-- <NavbarLogo> -->
                <Link href="/">
                    <img
                        class="max-h-10 object-scale-down dark:invert"
                        src="../../../../../public/Logo_V2.png"
                        alt="Logo Boolbnb"
                    />
                </Link>
                <!-- </NavbarLogo> -->
            </template>

            <template #default="{ isShowMenu }">
                <NavbarCollapse
                 :isShowMenu="isShowMenu" class="z-10 absolute mt-12 mx-4 md:mt-0 top-0 right-0 px-4">
                    <NavbarLink
                        className="text-sm text-center items-center py-2"
                    >
                        <Link
                            href="/admin/properties"
                            :class="{
                                active: $page.url === '/admin/properties',
                            }"
                            class="align-middle transition delay-150 hover:text-[#4d1635] dark:text-white dark:hover:text-[#89275e]"
                            ><i class="fa-solid fa-house mr-1"></i
                            ><span>Proprietà</span></Link
                        >
                    </NavbarLink>
                    <NavbarLink className="text-sm text-center py-2"
                        ><Link
                            :href="route('mymessages')"
                            :class="{
                                active: $page.url === '/admin/mymessages',
                            }"
                            class="align-middle transition delay-150 hover:text-[#4d1635] dark:text-white dark:hover:text-[#89275e]"
                            ><i class="fa-solid fa-message mr-1"></i
                            ><span class="">Messaggi</span></Link
                        ></NavbarLink
                    >
                    <NavbarLink className="text-sm text-center py-2"
                        ><Link
                            href="/admin/sponsors"
                            :class="{ active: $page.url === '/admin/sponsors' }"
                            class="align-middle transition delay-150 hover:text-[#4d1635] dark:text-white dark:hover:text-[#89275e]"
                            ><i class="fa-solid fa-credit-card mr-1"></i
                            ><span class="">Boost</span></Link
                        ></NavbarLink
                    >
                    <NavbarLink className="text-sm text-center">
                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="text-white bg-[#4d1635] dark:bg-[#89275e] dark:hover:bg-[#4d1635] text-sm px-4 py-2 text-center md:mr-0 transition delay-150 ease-in-out hover:scale-110 hover:bg-[#89275e] duration-200 font-bold rounded-lg w-25 mx-auto"
                        >
                            Log Out
                        </Link>
                    </NavbarLink>
                </NavbarCollapse>
            </template>
        </Navbar>
    </header>
</template>

<style lang="css" scoped>
header{
    height: 65px;
}
.active {
    /* color: white; */
    color: #89275e;
    /* background-color: #4d1635; */
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    border: 2px solid #89275e;
}
</style>
