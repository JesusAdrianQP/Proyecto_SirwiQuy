<template>
  <Visitor>
    <Loader class="min-h-screen"
            :load="loading"
    />
    
    <div v-show="!loading" class="bg-gray-100" style="min-height: 80vh;">
      <div class="max-w-6xl mx-auto py-8">
        <div class="text-center my-4 font-bold">
          <h1 class="text-2xl">HISTORIAL DE SERVICIOS</h1>
        </div>

        <div
        v-show="!loading && responses.length == 0"
        class="rounded-lg py-3 text-center items-center justify-center"
        >
          <span class="text-xl text-gray-900 w-full">No existen servicios contratados.</span>
          <div class="w-full sm:px-10">
            <img class="h-56 sm:h-64 w-full object-contain" src="../../../assets/empty_2.png">
          </div>
        </div>

        <div  v-show="!loading && responses.length > 0" class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
              class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
            >
              <div
                class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
              >
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-primary-500">
                    <tr>
                      <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider"
                      >
                        Fecha citada
                      </th>
                      <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider"
                      >
                        Código del servicio
                      </th>
                      <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider"
                      >
                        Estado
                      </th>
                      <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider"
                      >
                        Opciones
                      </th>
                      <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-white uppercase tracking-wider"
                      >
                        Importe total
                      </th>
                    </tr>
                  </thead>

                  <tbody
                    v-for="response in responses"
                    v-bind:key="response._id"
                    class="bg-white divide-y divide-gray-200"
                  >
                    <ServiceItem
                      :id_response="response._id"
                      :date="response.date"
                      :id_service="response.id_service"
                      :status="response.status"
                      :sumTotal="response.sumaTotal"
                    ></ServiceItem>
                    <!-- More rows... -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!--Lógica de la paginación y de los filtros-->
          <div class="w-full text-center mt-4">
            <Pagination
              :type_pag="type_pagination"
              :idCustomer="id_customer"
              @getResponses="setResponses"
            />
          </div>
          <!--Fin de la sección-->
        </div>
      </div>
    </div>
  </Visitor>
</template>

<script>
import Visitor from "../Layouts/Visitor";
import ServiceItem from "../../components/ServiceItem";
import Loader from "../../components/Loader";
import Pagination from "../../components/Pagination";

export default {
  name: "ServiceReport",
  components: {
    Visitor,
    ServiceItem,
    Loader,
    Pagination
  },
  data: () => {
    return {
      type_pagination: 'historial_solicitud',
      id_customer: localStorage.getItem('e_id_customer'),
      responses: [],
      id_service: '',

      loading: true,
    };
  },
  methods: {
     setResponses(obj) {
      this.responses = obj.response_paginate;
      this.loading = false;
    }
  },
};
</script>