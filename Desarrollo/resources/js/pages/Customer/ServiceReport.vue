<template>
  <visitor>
    <div class="bg-gray-100 min-h-screen">
      <div class="max-w-6xl mx-auto py-8">
        <div class="text-center my-4 font-bold">
          <h1 class="text-2xl">HISTORIAL DE SERVICIOS</h1>
        </div>

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
            <circle
              class="opacity-25"
              cx="12"
              cy="12"
              r="10"
              stroke="currentColor"
              stroke-width="4"
            />
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
          <span class="text-xl text-gray-900 w-full"
            >¡No hay servicios contratados aún!</span
          >
          <div class="w-full mt-3 sm:px-10">
            <img
              class="h-56 sm:h-96 w-full object-contain"
            
            />
          </div>
        </div>

        <div v-show="!loading && services.length > 0" class="flex flex-col">
          <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
              class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
            >
              <div
                class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
              >
                <table class="min-w-full divide-y divide-gray-200">
                  <thead>
                    <tr>
                      <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Fecha y Hora
                      </th>
                      <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Servicio
                      </th>
                      <th
                        class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                      >
                        Estado
                      </th>

                    </tr>
                  </thead>
                  <tbody
                    v-for="service in services"
                    v-bind:key="service._id"
                    class="bg-white divide-y divide-gray-200"
                  >
                    <ServiceItem
                      :_id="service._id"
                      :title="service.title"
                      :date="service.date"
                      :status="service.status"
                      :bill_status="service.bill_status"
                      @onServiceCompleted="completeService"
                      @onServiceIncomplete="incompleteService"
                    ></ServiceItem>
                    <!-- More rows... -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div
      v-show="confirmOpen"
      class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
    >
      <div
        @click="confirmOpen = false"
        class="fixed inset-0 transition-opacity"
      >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
      <div
        class="relative bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full sm:p-6"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
      >
        <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
          <button
            @click="confirmOpen = false"
            type="button"
            class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
            aria-label="Close"
          >
            <svg
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>

        <div class="mt-4">
          <div
            class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"
          ></div>
        </div>
        <div class="flex items-center">
          <input
            id="remember_me"
            type="checkbox"
            class="form-checkbox h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
          />
          <label
            for="remember_me"
            class="ml-2 block text-sm leading-5 text-gray-900"
            >Acepto recibir a su correo electrónico novedades del
            sistema.</label
          >
        </div>
        <div class="flex items-center">
          <input
            id="remember_me"
            type="checkbox"
            class="form-checkbox h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
          />
          <label
            for="remember_me"
            class="ml-2 block text-sm leading-5 text-gray-900"
            >Acepto los términos y condiciones de uso del servicio
            KusaWasi.</label
          >
        </div>
        <div class="flex items-center">
          <input
            id="remember_me"
            type="checkbox"
            class="form-checkbox h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
          />
          <label
            for="remember_me"
            class="ml-2 block text-sm leading-5 text-gray-900"
            >Acepto las politicas del servicio SirwuiQuy.</label
          >
        </div>
        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
          <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button
              @click="
                message =
                  'Su información detallada del contrato ha sido enviada a su correo electronico. ¡Gracias por confiar en nosotros!';
                messageOpen = true;
              "
              type="button"
              class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary transition ease-in-out duration-150 sm:text-sm sm:leading-5"
            >
              Aceptar
            </button>
          </span>
        </div>
      </div>
    </div>

    <div
      v-show="messageOpen"
      class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
    >
      <div
        @click="messageOpen = false"
        class="fixed inset-0 transition-opacity"
      >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
      <div
        class="relative bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
      >
        <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
          <button
            @click="messageOpen = false"
            type="button"
            class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
            aria-label="Close"
          >
            <svg
              class="h-6 w-6"
              fill="none"
              viewBox="0 0 24 24"
              stroke="currentColor"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>

        <div class="mt-4">
          <div
            class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"
          ></div>
        </div>
        <span v-text="message"></span>
      </div>
    </div>
  </visitor>
</template>

<script>
import Visitor from "../Layouts/Visitor";
import ServiceItem from "../../components/ServiceItem";
export default {
  name: "ServiceReport",
  components: {
    Visitor,
    ServiceItem,
  },
  data: () => {
    return {
      services: [],
      confirmOpen: false,
      messageOpen: false,
      message: " ",
      loading: false,
    };
  },
  async created() {
    localStorage.removeItem('e_pay');
    localStorage.removeItem('email');
    localStorage.removeItem('pago');
    
    this.services.push({
      _id: "100",
      title: "hola",
      date: "10/12/20",
      status: "pendiente",
    });
  },
  methods: {
    completeService(obj) {
      console.log("completado");
    },
    incompleteService(obj) {
      console.log("incompleto");
    },
  },
};
</script>