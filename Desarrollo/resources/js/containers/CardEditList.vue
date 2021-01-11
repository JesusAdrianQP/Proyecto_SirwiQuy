<template>
  <div class="bg-white shadow overflow-hidden sm:rounded-md my-10">
     <ul v-for="service in services" v-bind:key="service._id">
        <CardEdit
          :id="service.id"
          :title="service.title"
          :description="service.description"
          :address="service.distrito"
          :price="service.precio"
          :imageUrl="service.file"
        />
                <!-- modal de eliminar  -->
                <div
                v-show="modalRemove"
                class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
                >
                    <div @click="modalRemove = false" class="fixed inset-0 transition-opacity">
                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                    </div>
                    <div
                    class="relative bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full sm:p-6"
                    role="dialog"
                    aria-modal="true"
                    >
                    aria-labelledby="modal-headline"
                    <div class="sm:flex sm:items-start">
                        <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
                        >
                        <!-- Heroicon name: exclamation -->
                        <svg
                            class="h-6 w-6 text-red-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="2"
                            />
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                        </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3
                            class="text-lg leading-6 font-medium text-gray-900"
                        >¿Desea eliminar?</h3>
                            id="modal-headline"
                        <div class="mt-2">
                            <p
                            class="text-sm leading-5 text-gray-500"
                            >Está seguro que desea eliminar este registro.</p>
                        </div>
                        </div>
                    </div>
                    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button @click="submitDelete"
                            type="button"
                        
                            class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                        >Eliminar</button></span>
                        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button @click="modalRemove = false" 
                            type="button"
                            class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                      
                        >Cancelar</button>  </span>
                    </div>
                    </div>
                </div>
              
    </ul>
  </div>
</template>

<script>
import api from "../api";

import CardEdit from "../components/CardEdit.vue";
import IconSvg from "../components/IconSvg";

export default {
  name: "CardEditList",
  components: {
    CardEdit,
    IconSvg
  },
  props: {
    category: String,
  },
  data: () => {
    return {
      services: [],
      ide: localStorage.getItem('id'),
      modalRemove: false,
      submitDelete: false
    };
  },
  async created(){
    //Se llama a toda la lista de servicios
      /*let response = await api.get(`/services/id=${this.ide}`)
      this.services = response.data.data.servicios;*/

      this.$emit('getLoading', {})
  }
};
</script>