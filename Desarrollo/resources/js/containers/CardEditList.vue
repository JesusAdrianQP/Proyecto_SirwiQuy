<template>
  <div class="bg-white shadow overflow-hidden sm:rounded-md">
    <ul >
      <!--<CardEdit
        :id="service._id"
        :title="service.title"
        :description="service.description"
        :address="service.departamento"
        :min_price="service.precioMin"
        :max_price="service.precioMax"
        :imageUrl="service.file"
      />-->
       <li class="border-t border-gray-100">
    
    <div class="px-4 py-4 sm:px-6">
        <div class="max-w-sm w-full lg:max-w-full lg:flex">
          <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" 
                :style="{backgroundImage: 'url(\''+imageUrl+'\')'}"
                title="Woman holding a mug">
          </div>
          <div class="border-r border-b border-l border-gray-400 lg:flex-auto lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
            <div class="mb-4">
              
              <div class="text-gray-900 font-bold text-xl mb-2">gaasito</div>
              <p style="overflow: hidden; 
                  text-overflow: ellipsis;  
                  display: -webkit-box;
                    -webkit-line-clamp: 3;
                    -webkit-box-orient: vertical;" 
                class="whitespace-pre-line text-gray-700 text-base max-h-15 leading-5"
                >gaasitodescripcion
              </p>
            </div>
            <div class="mb-4">
            
              <div class="flex items-center mt-1 gap-2">               
                  <p class="text-gray-900 font-bold leading-none">Categoría: </p>               
                  <p class="text-gray-900 leading-none"> Cerrajero</p> 
              </div>
                   
              <div class="flex items-center mt-1 gap-2">
                <p class="text-gray-900 font-bold leading-none">Rango de cercanía: </p>
                <p class="text-gray-900 leading-none">gaasitoadrees</p>
              </div>
              <div class="flex items-center mt-1 gap-2">
                <p class="text-gray-900 font-bold leading-none">Precio: </p>
                <p class="text-gray-900 leading-none">Desde S/. 200gaasitos</p>
              </div>
                    
            </div>
            <div class="inline-flex">
              <!--Boton de actualizar - sirve para actualizar precios-->
              <router-link :to="'/supplier/'+id+'/price/update'">
                <button 
                            @click="addOpen=true"
                            type="submit"
                            class="inline-flex items-center px-3 py-3 sm:mx-3 my-3  border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-primary active:bg-green-700 transition ease-in-out duration-150">
                            <span >
                             <IconSvg :solid="true" icon="currency-dollar" class="h-7 w-7 text-white sm:h-5 sm:w-5  "/>         
                            </span>
                            Precio
                            </button>
              </router-link>
            <!--Boton de actualizar - sirve para actualizar servicios-->
              <router-link :to="'/supplier/'+id+'/service/update'">
                <button 
                            @click="addOpen=true"
                            type="submit"
                            class="inline-flex items-center px-3 py-3 sm:mx-3 my-3  border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150">
                            <span >
                             <IconSvg :solid="true" icon="pencil" class="h-7 w-7 text-white sm:h-5 sm:w-5  "/>         
                            </span>
                            Servicio
                            </button>
              </router-link>
            <!--Boton de borrar - sirve para borrar servicios-->
              
                <button @click="modalRemove=true" class="inline-flex items-center px-3 py-3 sm:mx-3 my-3  border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-700 transition ease-in-out duration-150">
                            <span >
                             <IconSvg :solid="true" icon="trash" class="h-7 w-7 text-white sm:h-5 sm:w-5  "/>         
                            </span>
                            Eliminar
                </button>

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
            aria-labelledby="modal-headline"
            >
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
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                    />
                </svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3
                    class="text-lg leading-6 font-medium text-gray-900"
                    id="modal-headline"
                >¿Desea eliminar?</h3>
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
                >Eliminar</button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <button @click="modalRemove = false" 
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                >Cancelar</button>
                </span>
            </div>
            </div>
        </div>
              
            </div>
          </div>
        </div>
     
    </div> 
  </li>
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
import IconSvg from "../components/IconSvg";

export default {
  name: "CardEditList",
  components: {
    CardEdit,
    Pagination,
    IconSvg,
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
      modalRemove: false
    };
  },
};
</script>