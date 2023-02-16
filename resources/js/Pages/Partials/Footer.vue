<script>
import { Footer } from 'flowbite-vue'
import { Link } from '@inertiajs/vue3';

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
    <section>
        <footer class="fixed bottom-0 left-0 z-20 w-full p-4 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-6 dark:bg-gray-800 dark:border-gray-600">
            <span class="text-sm text-gray-800 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">BoolBnb</a>. All Rights Reserved.
            </span>
            <span class="text-lg text-gray-500 sm:text-center dark:text-gray-400"><a href="https://flowbite.com/" class="hover:underline">{{ dateTime.hours }}:{{ dateTime.minutes }}:{{ dateTime.seconds }}</a>

            </span>
            <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
                <li>
                    <a href="#" class="mr-4 hover:underline md:mr-6 ">Chi shiamo</a>
                </li>
            </ul>


</footer>


    </section>
</template>
