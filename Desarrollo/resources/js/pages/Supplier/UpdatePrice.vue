<template>
  <SideBar title="Actualización de Precio">
    <div class="bg-white mx-4 px-6 py-5 sm:px-6 mx-2 overflow-hidden shadow rounded-lg">
      
      <!--Sección de mano de obra y materiales-->
      <div>
        <div
          class="mt-1 sm:mt-5 sm:ml-8 grid-cols-1 col-gap-8 row-gap-2"
        >
          <div class="lg:flex">
            <div class="lg:w-1/3">
              <label
                for="input_max_price"
                class="py-1  my-4 sm:py-2 block text-sm font-medium leading-5 text-gray-700"
              >Precio de mano de obra</label>
            </div>
    
            <div class="lg:w-1/3 my-4 py-1">
              
                  <input v-if="actualizarSalario" v-model="salario" type="number" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                
                <span v-if="!actualizarSalario">S/ {{salario}}</span>
            </div>
          </div>

          <div class="my-4">
            <h1 class="font-semibold">Datos de material</h1>
          </div> 

          <!-- materialPrice -->
          <div class="sm:mt-2 grid grid-cols-1 row-gap-6 sm:col-gap-4 sm:grid-cols-6">
    
            <!--Sección del input materiales-->
            <div class="lg:flex sm:col-span-2">
              <div class="lg:w-1/4">
                <label
                  
                  class="pt-3 sm:py-3 block text-sm font-medium leading-5 text-gray-700"
                >Material</label>
              </div>
              <div class="lg:w-3/4 mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese el material"
                  
                  type="text"
                  
                  v-model= "name"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
                
              </div> 
            </div>
            <!--Fin de la sección-->

            <!--Sección de los precios correspondientes a los materiales-->
            <div class="lg:flex sm:col-span-2">
              <div class="lg:w-1/4">
                <label
                  
                  class="sm:py-3 block text-sm font-medium leading-5 text-gray-700"
                >Precio</label>
              </div>
              <div class="lg:w-3/4 mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese el precio unitario"
                  
                  type="number"
                  v-model= "price"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
                
              </div> 
            </div>
            
            <!--Fin de la sección-->

            <!--Boton de agregar - sirve para añadir los materiales-->
            <div class="sm:col-span-2">
              <div class="mt-2 flex items-center">
                <span class="rounded-md shadow-sm">
                  <button
                    @click= "createMaterial"
                    type="button"
                    class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                  >Agregar</button>
                </span>
              </div>
            </div>
            <!--Fin de la sección-->

            <!-- Tabla donde se muestran los datos -->
            <div class="data sm:col-span-6">
              <div>
                <h1 class="font-semibold">Lista de materiales</h1>
              </div>  
              
              <table class="text-left w-full"> 
                  <tr>
                    <th class="sticky top-0 px-6 py-3 text-red-900 bg-red-300">Nombre</th>
                    <th class="sticky top-0 px-6 py-3 text-red-900 bg-red-300">Precio</th>
                  </tr>
                  <tbody class="bg-grey-light flex flex-col items-center justify-between  w-full" >
                    <tr class="flex w-full mb-4">
                    <!--<td v-text="material.name"></td>
                    <td v-text="material.price"></td>
                    v-for="(material, index) in materials" :key="index"-->
                    
                      <div v-if="!actualizarSalario" >
                        <span v-for="(material, index) in materials" :key="index"
                          >
                          <td class="p-4 w-1/4">
                            {{ material.name }}
                          </td>
                          <td class="p-4 w-1/4">
                            {{ material.price }}
                          </td>
                           <br
                        /></span>
                        <br />
                      </div>

                      <div v-if="actualizarSalario"  >
                        <div v-for="(material, index) in materials" :key="index">
                          <input class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" type="text" v-model="material.name" />
                          <input class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" type="text" v-model="material.price" />
                        </div>
                      </div>
                    
                  
                  </tr>
                  </tbody>
                  
                  
                
              </table>
            </div>
          </div> 
                  <!--Fin de la sección-->

      </div>
      </div>
      <!--Fin de la sección-->

      <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse .right-4">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
        <button @click="actualizarSalario=false" 
            type="button"
            class="py-2 px-6 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
          >Guardar</button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
        <button @click="actualizarSalario=true" 
            type="button"
            class="inline-flex justify-center py-2 px-8 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
        >Actualizar Precio</button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
        <router-link to="/supplier/services">  
        <button 
            type="button"
            class="inline-flex justify-center py-2 px-8 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
        >sallir</button>
        </router-link>
        </span>
      </div>

    </div>
  </SideBar>
</template>

<script>
import api from "../../api"

import SideBar from "../../components/SideBar";


export default {
  name: "UpdatePrice",
  components: {
    SideBar
    
  },
  data: () => {
    return {
      name: '',
      price: '',
      
      
      materials: [
        {name: 'madera', price: 50},
        {name: 'palo', price: 10},
        {name: 'cemento', price: 50},
      ],
      actualizarSalario: false,
    
      salario: 10,

    };
  },
  methods : {
    createMaterial: function(){
      if(this.name!="" && this.price!=""){
        this.materials.push({
        
        name: this.name,
        price: this.price
        });
        this.name = '';
        this.price = '';
        console.log(this.materials);
      }
      else{
        alert("Ingrese el nombre y precio del materia");
        //submitForm()
      }
    }
  }
};
</script>
