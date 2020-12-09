<template>
  <!-- SERVICE COST: Vista de opciones de mano de obra
  y materiales que posee el servicio.
  En base a las opciones seleccionadas por el usuario,
  se hará una cotización del servicio.-->
  <Visitor>
    <div class="bg-gray-100 min-h-screen">
      <main class>
        <div class="max-w-4xl mx-auto py-8 sm:px-6 lg:px-8">
          <div class="bg-white rounded-lg shadow px-5 py-6 sm:px-6 mx-2">
            <h2 class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl"
            >Estima tu costo</h2>
            <p class="my-2 font-semibold">Opciones de este servicio</p>
            <div class="mt-4 sm:flex w-full">

              <!-- Sección de marcado solo mano de obra-->
              <div class="sm:w-2/5">
                <div class="flex">
                  <input
                    id="only_workforce"
                    name="workforce"
                    type="radio"
                    class="form-radio h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
                    value="only_workforce"
                    v-model="includeMaterials1"
                    @change="Validation(); TotalSum()"
                  />
                  <label for="only_workforce" class="ml-3">
                    <span class="block text-sm leading-5 font-medium text-gray-700">Solo mano de obra</span>
                  </label>
                </div>

                <!-- Aparece si es mano de obra-->
                <div
                  v-if="includeMaterials1 == 'only_workforce'"
                  class="mt-1 sm:mt-2 ml-7 w-full"
                >
                  <div class="absolute flex items-center h-5">
                    <input
                      id="workforce"
                      type="checkbox"
                      disabled
                      v-model="workforce"
                      class="form-checkbox h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
                    />
                  </div>
                  <div class="pl-7 text-sm leading-5 mb-4">
                    <label for="workforce" class="text-gray-700">S/ {{workforce.toFixed(2)}}</label>
                  </div>    
                </div>
                <!--Fin de la sección-->
              </div>

                <!-- Sección de marcado con materiales incluidos-->
              <div class="sm:w-3/5">
                <div class="flex">
                  <input
                    id="include_materials"
                    name="workforce"
                    type="radio"
                    class="form-radio h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
                    value="include_materials"
                    v-model="includeMaterials1"
                  />
                  <label for="include_materials" class="ml-3">
                    <span
                      class="block text-sm leading-5 font-medium text-gray-700"
                    >Mano de obra y materiales</span>
                  </label>
                </div>  

                <!-- Aparece si solo es con materiales-->
                <div v-if="includeMaterials1!='only_workforce'">
                  <div v-if="!vacio_material" class="mt-1 sm:mt-2">
                    <div class="sm:flex" v-for="(price, index) in prices" :key="index">
                        
                      <div class="flex mt-3 mb-0 sm:mt-2 sm:mb-2 sm:w-5/6">
                        <div class="absolute my-2 flex items-center h-5">
                          <input
                            :id="price.name"
                            type="checkbox"
                            @change="TotalSum()"
                            class="form-checkbox h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
                            v-model="request_prices"
                            :value="price"
                          />
                        </div>
                          
                        <div class="flex pl-7 text-sm py-2 w-full">
                          <label :for="price.name" class="w-2/4 text-gray-700">{{price.name}}</label>
                          <label :for="price.name" class="w-2/4 text-center sm:pr-3 text-gray-700">S/ {{price.price.toFixed(2)}}</label>
                        </div>
                      </div>

                      <div class="sm:w-1/6 ml-3 mb-5 sm:mb-0">
                        <div class="rounded-md shadow-sm my-2">
                          <input
                            id="input_age"
                            type="number"
                            :name="price.name"
                            v-model="price.cant"
                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            @change="TotalSum()"
                          />
                        </div>
                      </div>
                      <hr>
                    </div>
                  </div>
                  
                  <small v-if="vacio_material" class="text-yellow-600">
                    {{ vacio_material }}
                  </small> 
                </div> 

                <div v-if="includeMaterials1!='only_workforce' && vacio_material==''" class="mt-1 flex justify-between">
                  <div class="text-xs leading-5">
                    <span class="font-medium"
                    >Se agrega S/ {{workforce.toFixed(2)}} al total de su lista por la mano de obra</span>
                  </div>
                </div>  
              </div>
            </div>
            <br><br><br>
            <hr>
            <div class="mx-auto text-5xl text-center mt-8">
              S/ {{suma.toFixed(2)}}
            </div>

            <div class="mx-auto text-center mt-1">
              <button
                @click="Submit()"
                type="button"
                class="inline-flex items-center px-3 py-2 mx-3 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150"
              >Contratar servicio
              </button>
            </div>
          </div>
        </div>
      </main>
    </div>
  </Visitor>
</template>

<script>
import api from "../../api";

import Visitor from "../Layouts/Visitor";

export default {
  name: "ServiceCost",
  components: {
    Visitor,
  },
  data: () => {
    return {
      includeMaterials1: 'include_materials',
      //Se guarda como un objeto los valores de precios del servicio
      price_details: '',

      workforce: 0,
      prices: [], //Arreglo que guarda lo traido
      vacio_material: '',
      suma: 0,
      
      request_prices: [], //Arreglo que guarda mis pedidos
    };
  },
  props: {
    service_id: String,
  },

  methods: {
    async Validation(){
      if(this.includeMaterials1 == 'only_workforce') this.request_prices = [];
    },
    async TotalSum(){
      this.suma = this.workforce;

      if(this.request_prices.length > 0)
      {
        for(var i = 0; i < this.request_prices.length; i++)
        {
          if(this.request_prices[i].name != null && 
          this.request_prices[i].cant == null)
          {
            this.request_prices[i].cant = 1;
          }

          this.suma = this.suma + (this.request_prices[i].price * this.request_prices[i].cant);
        }
      }
    },
    async Submit(){
      localStorage.setItem('worforce', this.workforce);
      localStorage.setItem('request',  JSON.stringify(this.request_prices));//Convierto mi json en string

      if(localStorage.getItem("e_level") == null)
      {
        this.$router.push("/login/customer");
        
        return this.$toast.open({
          message: "Por favor! Ingrese a su sesión para continuar",
          type: "info",
          duration: 8000,
          dismissible: true,
        });
      }
      else this.$router.push("/request/form/service");
    }
  }
};
</script>