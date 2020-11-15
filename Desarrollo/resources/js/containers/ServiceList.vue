<template>
  <div>
    <div
      v-show="loading && services.length == 0"
      class="h-96 mt-4 bg-gray-200 rounded-lg p-6 flex items-center justify-center"
    >
      <span class="text-xl text-gray-900">Cargando contenido...</span>
      <svg
        class="animate-spin ml-6 h-6 w-6 text-primary-800"
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
      >
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
        <path
          class="opacity-75"
          fill="currentColor"
          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
        />
      </svg>
    </div>

    <div
      v-show="!loading && services.length == 0"
      class="h-104 mt-4 bg-gray-200 rounded-lg p-6 text-center items-center justify-center"
    >
      <span class="text-xl text-gray-900 w-full">¡No se ha encontrado servicios disponibles!</span>
      <div class="w-full mt-3 sm:px-10">
        <img class="h-56 sm:h-96 w-full object-contain" src="../../assets/empty_content.png">
      </div>
    </div>

    <div class="flex flex-wrap mt-8">
      <!--Detalles de cada servicio publicado-->
      <div class="w-full sm:w-1/2 mb-2 p-2" v-for="service in services" v-bind:key="service._id">
        <ServiceCard
          :service_id="service._id"
          :title="service.title"
          :description="service.description"
          :district="service.distrito"
          :supplier_rating="service.calificacion"
          :min_price="service.precioMin"
          :max_price="service.precioMax"
          :file="service.file"
        />
      </div>
      <!--Fin de la sección-->
    </div>

    <!--Lógica de la paginación y de los filtros-->
    <div class="hidden w-full text-center mt-2">
      <Pagination
        :type_pag="type_pagination"
        :title="title"
        :district="district"
        :category="category"
        :prices="prices"
        :calification="value"
        @getServices="setServices"
        @setLoading="loading=true"
      />
    </div>
    <!--Fin de la sección-->
  </div>
</template>

<script>
import ServiceCard from "../components/ServiceCard.vue";
import Pagination from "../components/Pagination.vue";

export default {
  name: "ServiceList",
  components: {
    ServiceCard,
    Pagination,
  },
  props: {
    //Se hereda del componente padre
    title: String,
    district: String,
    category: String,
    prices: Object,
    value: Boolean,
  },
  data: () => {
    return {
      //Arreglo de servicios totales
      type_pagination: "index",
      services: [],

      loading: true,
    };
  },
  methods: {
    setServices(services) {
      this.services = services.services_paginate;
      this.loading = false;
    },
  },
};
</script>