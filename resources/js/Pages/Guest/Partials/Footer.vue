<script>
import { Footer } from "flowbite-vue";
import { Link } from "@inertiajs/vue3";

const date = new Date();
export default {
    name: "Clock",
    data() {
        return {
            dateTime: {
                hours: "",
                minutes: "",
                seconds: "",
            },
            timer: undefined,
        };
    },
    methods: {
        setDateTime() {
            const date = new Date();
            const hours = date.getHours().toString().padStart(2, "0");
            const minutes = date.getMinutes().toString().padStart(2, "0");
            const seconds = date.getSeconds().toString().padStart(2, "0");
            this.dateTime = {
                hours,
                minutes,
                seconds,
            };
        },
    },
    mounted() {
        this.setDateTime();
        this.timer = setInterval(this.setDateTime, 1000);
    },
    beforeDestroy() {
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
                class="text-sm text-gray-800 sm:text-center hidden md:inline-block"
                >© 2023 BoolBnB Team1. All Rights Reserved. |
                <span class="text-sm text-gray-800 sm:text-center"
                    >{{ dateTime.hours }}:{{ dateTime.minutes }}:{{
                        dateTime.seconds
                    }}
                </span>
            </span>

            <ul
                class="flex flex-wrap items-center mt-3 mr-4 text-sm text-gray-800sm:mt-0"
            >
                <li>
                    <Link
                        :href="route('about-us')"
                        class="mr-4 text-base font-bold hover:text-[#4d1635] md:mr-6"
                        >Chi siamo</Link
                    >
                </li>
            </ul>
        </footer>
    </section>
</template>
