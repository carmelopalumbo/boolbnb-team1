<script>
import { Footer } from "flowbite-vue";
import { Link } from "@inertiajs/vue3";

const date = new Date();
export default {
    name: "App",
    data() {
        return {
            dateTime: {
                hours: date.getHours(),
                minutes: date.getMinutes(),
                seconds: date.getSeconds(),
            },
            timer: undefined,
        };
    },
    methods: {
        setDateTime() {
            const date = new Date();
            this.dateTime = {
                hours: date.getHours(),
                minutes: date.getMinutes(),
                seconds: date.getSeconds(),
            };
        },
    },
    beforeMount() {
        this.timer = setInterval(this.setDateTime, 1000);
    },
    beforeUnmount() {
        clearInterval(this.timer);
    },
};
</script>

<template>
    <section class="footer-bottom-fix">
        <footer
            class="w-full p-4 bg-white border-t shadow md:flex md:items-center md:justify-between md:p-6"
        >
            <span
                class="text-sm text-gray-800 sm:text-center  hidden md:inline-block"
                >© 2023 BoolBnb. All Rights Reserved. |
                <span
                    class="text-sm text-gray-800 sm:text-center"
                    >{{ dateTime.hours }}:{{ dateTime.minutes }}:{{
                        dateTime.seconds
                    }}
                </span>
            </span>

            <ul
                class="flex flex-wrap items-center mt-3 mr-4 text-sm text-gray-800sm:mt-0"
            >
                <li>
                    <a
                        href="#"
                        class="mr-4 text-base font-bold hover:text-[#4d1635] md:mr-6"
                        >Chi siamo</a
                    >
                </li>
            </ul>
        </footer>
    </section>
</template>
