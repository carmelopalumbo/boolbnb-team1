<script>
export default {
  name: "ServiceIcons",
  props: {
    services: Object,
  },
  methods: {
    getServiceIcon(service) {
      switch (service) {
        case 'cucina':
      return '<i class="fas fa-utensils"></i>';
    case 'wifi':
      return '<i class="fas fa-wifi"></i>';
    case 'posto auto':
      return '<i class="fas fa-parking"></i>';
    case 'tv':
      return '<i class="fas fa-tv"></i>';
    case 'piscina':
      return '<i class="fas fa-swimming-pool"></i>';
    case 'aria condizionata':
      return '<i class="fas fa-wind"></i>';
    case 'vista mare':
      return '<i class="fas fa-water"></i>';
    case 'ascensore':
      return '<i class="fas fa-elevator"></i>';
    case 'animali ammessi':
      return '<i class="fas fa-paw"></i>';
    case 'giardino':
      return '<i class="fas fa-tree"></i>';
    default:
      return '';
  }
    },
  },
};
</script>


<template>
  <div>
    <div v-for="(service, index) in services" :key="index">
      <i :class="getServiceIcon(service)"></i>
    </div>
  </div>
</template>

