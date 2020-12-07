<template>
  <div class="w-full px-4 lg:px-4">
    <div class="flex flex-wrap mt-6">
      <!--Componente de carga para los servicios respectivos-->
      <Loader class="min-h-screen"
        :load="loading"
      />

      <!--En caso no se encuentre ningun servicio respectivo-->
      <div
        v-show="!loading && services.length == 0"
        class="w-full rounded-lg flex items-center justify-center px-4 py-8 min-h-screen"
      >
        <div class="text-primary-700">
          <img class="max-h-96 mx-auto px-4" src="../../assets/illustrations/search.png" alt="Data vacia">
          <p class="mt-4 text-base2 text-center sm:text-xl md:text-2xl xl:text-3xl font-bold text-blue-900 mb-2">
            UPS!... No se encontraron servicios
          </p>
        </div>
      </div>

      <!--Detalles de cada servicio publicado-->
      <div class="w-full lg:w-1/2 mt-4 p-2" v-for="service in services" v-bind:key="service._id">
        <ServiceCard
          :service_id="service._id"
          :title="service.title"
          :description="service.description"
          :district="service.distrito"
          :supplier_rating="service.calificacion"
          :price="service.precio"
          :file="service.file"
        />
      </div>
      <!--Fin de la sección-->
    </div>

    <!--Lógica de la paginación y de los filtros-->
    <div class="w-full text-center mb-6 sm:mt-3 md:mt-5">
      <Pagination
        :type_pag="type_pagination"
        :calification="value"
        @getServices="setServices"
      />
    </div>
    <!--Fin de la sección-->
  </div>
</template>

<script>
import ServiceCard from "../components/ServiceCard";
import Pagination from "../components/Pagination";
import Loader from "../components/Loader";

export default {
  name: "ServiceList",
  components: {
    ServiceCard,
    Pagination,
    Loader
  },
  props: {
    //Se hereda del componente padre
    
    value: Boolean,
    
  },
  data: () => {
    return {
      type_pagination: "index",
      services: [], //Arreglo de servicios totales
      loading: true,
    };
  },
  methods: {
    setServices(services) {
      this.services = services.services_paginate;
      this.loading = false;
    }
  },
};
</script>