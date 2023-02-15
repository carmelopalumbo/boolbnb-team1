<script>
export default {
    props: { my_properties: Object },

    mounted() {
        console.log(this.my_properties);
    },
};
</script>

<template>
    <div class="flex flex-col">
  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
      <div class="overflow-hidden">
        <h1 class="text-center font-bold text-2xl py-6">LE MIE PROPRIETA'</h1>
        <table class="w-96 m-auto">
          <thead class="border-b">
            <tr>
              <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                NOME
              </th>
              <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                INDIRIZZO
              </th>
              <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                PREZZO
              </th>
              <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                VISIBILITÀ
              </th>
              <th scope="col" class="text-md font-bold text-gray-900 px-6 py-4 text-left">
                AZIONI
              </th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="property in my_properties" :key="property.id" class="border-b">
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{property.name}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{property.address}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{property.price}} €
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                {{property.is_visible ? 'ANNUNCIO PUBBLICO' : 'ANNUNCIO PRIVATO'}}
              </td>
              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                <button class="text-white bg-blue-500 px-3 py-2 rounded-lg">
                    <i class="fa-regular fa-eye"></i>
                </button>
                <button class="text-white bg-yellow-500 px-3 py-2 rounded-lg mx-2">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="text-white bg-red-500 px-3 py-2 rounded-lg">
                    <i class="fa-solid fa-trash"></i>
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</template>

<style></style>
