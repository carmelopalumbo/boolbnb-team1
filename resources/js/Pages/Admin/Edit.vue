<script >
import Layout from "./Layouts/Layout.vue";

export default {
  props: {
    property: Object,
  },

  layout: Layout,
  data() {
    return {
      propertyEdit: {
        name: this.property.name,
        description: this.property.description,
        cover_image: this.property.cover_image,
        beds: this.property.beds,
        price: this.property.price,
        address: this.property.address,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("properties.update", this.property),
        this.propertyEdit
      );
    },
  },
};
</script>
<template>
    <div class="flex flex-col justify-center mx-auto">
        <div class="py-2 inline-block content-center sm:px-6 lg:px-8">
            <div class="overflow-hidden">
                <h1 class="text-center font-bold text-2xl py-6 uppercase">
                    Modifica la tua proprietà
                </h1>
            </div>
        </div>
    </div>

    <div class="flex flex-col justify-center mx-2 mt-20">
        <form class="content-center mx-10" @submit.prevent="submit">
          <div class="mb-6">
            <label class="mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
            <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-1/2 p-2.5" required v-model="propertyEdit.name">
          </div>
          <div class="mb-6 mx-auto">
            <label for="text" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
            <input type="text" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-1/2 p-2.5" required v-model="propertyEdit.description">
          </div>

          <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="default_size">Cover image</label>
            <input class="block w-1/2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="file_input" type="file">
          </div>

          <div class="mb-6">
            <label for="beds" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">N° beds</label>
            <input type="text" id="beds" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-1/2 p-2.5" required v-model="propertyEdit.beds">
          </div>

          <div class="mb-6">
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price/Night</label>
            <input type="text" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-1/2 p-2.5 " required v-model="propertyEdit.price">
          </div>

          <div class="mb-6">
            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
            <input type="text" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-1/2 p-2.5" required v-model="propertyEdit.address">
          </div>

          <button type="submit" class="text-white bg-[#4d1635] hover:bg-[#89275e] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-1/2 sm:w-auto px-5 py-2.5 text-center">Submit</button>
        </form>

    </div>

</template>


<style>
</style>
