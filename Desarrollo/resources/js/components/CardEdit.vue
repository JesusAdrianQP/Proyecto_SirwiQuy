<template>
  <li class="border-t border-gray-100">
    
    <div class="px-4 py-4 sm:px-6">
        <div class="max-w-sm w-full lg:max-w-full lg:flex">
          <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" 
                :style="{backgroundImage: 'url(\''+imageUrl+'\')'}"
                title="Woman holding a mug">
          </div>
          <div class="border-r border-b border-l border-gray-400 lg:flex-auto lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
            <div class="mb-4">
              
              <div class="text-gray-900 font-bold text-xl mb-2">{{title}}</div>
              <p style="overflow: hidden; 
                  text-overflow: ellipsis;  
                  display: -webkit-box;
                    -webkit-line-clamp: 3;
                    -webkit-box-orient: vertical;" 
                class="whitespace-pre-line text-gray-700 text-base max-h-15 leading-5"
                >{{description}}
              </p>
            </div>
            <div class="mb-4">
            
              <div class="flex items-center mt-1 gap-2">               
                  <p class="text-gray-900 font-bold leading-none">Categoría: </p>               
                  <p class="text-gray-900 leading-none"> Cerrajero</p> 
              </div>
                   
              <div class="flex items-center mt-1 gap-2">
                <p class="text-gray-900 font-bold leading-none">Rango de cercanía: </p>
                <p class="text-gray-900 leading-none">{{address}}</p>
              </div>
              <div class="flex items-center mt-1 gap-2">
                <p class="text-gray-900 font-bold leading-none">Rango de costo: </p>
                <p class="text-gray-900 leading-none"> S/. {{min_price}} a S/. {{max_price}}</p>
              </div>
                    
            </div>
            <div class="inline-flex">
              <!--Boton de actualizar - sirve para actualizar precios-->
              <router-link :to="'/supplier/'+id+'/price/update'">
                <span class="mx-2 text-sm text-center inline-flex rounded-md shadow-sm text-sm text-green-500 hover:text-green-800 hover:underline">
                  Actualizar precio
                </span>
              </router-link>
            <!--Boton de actualizar - sirve para actualizar servicios-->
              <router-link :to="'/supplier/'+id+'/service/update'">
                <span class="mx-2 text-sm text-center inline-flex rounded-md shadow-sm text-sm text-blue-500 hover:text-blue-800 hover:underline">
                  Actualizar servicio
                </span>
              </router-link>
            <!--Boton de borrar - sirve para borrar servicios-->
              
                <button @click="borrarServicio(id)" class="mx-2 text-sm text-center inline-flex rounded-md shadow-sm text-sm text-red-500 hover:text-red-800 hover:underline">
                  Eliminar servicio
                </button>
              
            </div>
          </div>
        </div>
     
    </div> 
  </li>
</template>

<script>
import api from "../api";

export default {
  name: "CardEdit",

  data: () => ({
    isOpen: false,
  }),
  props: {
    id: String,
    imageUrl: String,
    title: String,
    description: String,
    address: String,
    min_price: String,
    max_price: String,

    servicios: [],
  },
  methods: {
    async borrarServicio(servicio_id){
      //Se elimina solo un servicio desde la posición index
      //this.servicios.splice(servicio_id, 1);

      //Conexión con la lógica de borrado

      
    }
    
  }
};
</script>