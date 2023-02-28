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

        darkMode() {
            const themeToggleDarkIcon = document.getElementById(
                "theme-toggle-dark-icon"
            );
            const themeToggleLightIcon = document.getElementById(
                "theme-toggle-light-icon"
            );

            // Change the icons inside the button based on previous settings
            if (
                localStorage.getItem("color-theme") === "dark" ||
                (!("color-theme" in localStorage) &&
                    window.matchMedia("(prefers-color-scheme: dark)").matches)
            ) {
                themeToggleLightIcon.classList.remove("hidden");
            } else {
                themeToggleDarkIcon.classList.remove("hidden");
            }

            const themeToggleBtn = document.getElementById("theme-toggle");

            themeToggleBtn.addEventListener("click", function () {
                // toggle icons inside button
                themeToggleDarkIcon.classList.toggle("hidden");
                themeToggleLightIcon.classList.toggle("hidden");

                // if set via local storage previously
                if (localStorage.getItem("color-theme")) {
                    if (localStorage.getItem("color-theme") === "light") {
                        document.documentElement.classList.add("dark");
                        localStorage.setItem("color-theme", "dark");
                    } else {
                        document.documentElement.classList.remove("dark");
                        localStorage.setItem("color-theme", "light");
                    }

                    // if NOT set via local storage previously
                } else {
                    if (document.documentElement.classList.contains("dark")) {
                        document.documentElement.classList.remove("dark");
                        localStorage.setItem("color-theme", "light");
                    } else {
                        document.documentElement.classList.add("dark");
                        localStorage.setItem("color-theme", "dark");
                    }
                }
            });
        },
    },
    mounted() {
        this.setDateTime();
        this.timer = setInterval(this.setDateTime, 1000);
        this.darkMode();
    },
    beforeDestroy() {
        clearInterval(this.timer);
    },
};
</script>

<template>
    <section class="footer-bottom-fix">
        <footer
            class="w-full p-4 bg-white dark:text-white dark:bg-[#111827] border-t shadow flex md:items-center justify-between flex-row md:p-6"
        >
            <span
                class="text-sm text-gray-800 dark:text-white sm:text-center hidden md:inline-block"
                >© 2023 BoolBnB Team1. All Rights Reserved. |
                <span
                    class="text-sm dark:text-white text-gray-800 sm:text-center"
                    >{{ dateTime.hours }}:{{ dateTime.minutes }}:{{
                        dateTime.seconds
                    }}
                </span>
            </span>

            <div>
                <button
                    id="theme-toggle"
                    type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5"
                >
                    <svg
                        id="theme-toggle-dark-icon"
                        class="hidden w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                        ></path>
                    </svg>
                    <svg
                        id="theme-toggle-light-icon"
                        class="hidden w-5 h-5"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </button>
            </div>

            <div
                class="flex flex-wrap items-center mt-3 mr-4 text-sm text-gray-800sm:mt-0"
            >
                <Link
                    :href="route('about-us')"
                    class="mr-4 text-base font-bold hover:text-[#4d1635] md:mr-6"
                    >Chi siamo</Link
                >
            </div>
        </footer>
    </section>
</template>
