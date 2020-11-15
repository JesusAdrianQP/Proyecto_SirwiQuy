<template>
  <div class="bg-white shadow overflow-hidden sm:rounded-md">
    <ul v-for="service in services" v-bind:key="service._id">
      <CardEdit
        :id="service._id"
        :title="service.title"
        :description="service.description"
        :address="service.departamento"
        :min_price="service.precioMin"
        :max_price="service.precioMax"
        :imageUrl="service.file"
      />
    </ul>
    <div class="w-full text-center mt-2 mb-6">
      <Pagination />
    </div>
  </div>
</template>

<script>
import api from "../api";

import CardEdit from "../components/CardEdit.vue";
import Pagination from "../components/Pagination.vue";

export default {
  name: "CardEditList",
  components: {
    CardEdit,
    Pagination,
  },
  props: {
    category: String,
  },
  data: () => {
    return {
      //Arreglo de servicios totales
      services: [],
      //Id de la sesión del trabajador independiente
      id: localStorage.getItem("e_id"),
    };
  },
};
</script>