<template>
  <SideBar title="Actualización de Precio">
    <div class="bg-white mx-4 px-6 py-5 sm:px-6 mx-2 overflow-hidden shadow rounded-lg">
      
      <!--Sección de mano de obra y materiales-->
      <div>
        <div
          class="mt-1 sm:mt-5 sm:ml-8 grid-cols-1 col-gap-8 row-gap-2"
        >
          <div class="lg:flex">
            <div class="lg:w-1/5">
              <label
                for="input_max_price"
                class="py-1 sm:py-2 block text-sm font-medium leading-5 text-gray-700"
              >Precio de mano de obra</label>
            </div>

            <div class="lg:w-3/5 mt-1 rounded-md shadow-sm">
              <input
                placeholder="Ingrese el precio de la mano de obra"
                id="input_labor_price"
                type="number"
                :min="pmini"
                :max="pmax"
                v-model="labor_price"
                class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              />

              <small v-if="error_lab" class="text-red-600">{{
                error_lab
              }}</small>
              <small v-if="vacio_lab" class="text-yellow-600">{{
                vacio_lab
              }}</small>
            </div>
          </div>

          <div class="my-4">
            <h1 class="font-semibold">Datos de material</h1>
          </div> 

          <!--Sección del input materiales-->
          <div class="lg:flex">
            <div class="lg:w-1/5">
              <label
                for="input_name"
                class="pt-3 sm:py-3 block text-sm font-medium leading-5 text-gray-700"
              >Material</label>
            </div>
            <div class="lg:w-3/5 mt-1 rounded-md shadow-sm">
              <input
                placeholder="Ingrese el material"
                id="input_name"
                type="text"
                v-model= "name"
                class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              />
              <small v-if="vacio_name" class="text-yellow-600">
              {{
              vacio_name
              }}
            </small>
            </div> 
          </div>
          <!--Fin de la sección-->

          <!--Sección de los precios correspondientes a los materiales-->
          <div class="lg:flex">
            <div class="lg:w-1/5">
              <label
                for="input_price"
                class="sm:py-3 block text-sm font-medium leading-5 text-gray-700"
              >Precio</label>
            </div>
            <div class="lg:w-3/5 mt-1 rounded-md shadow-sm">
              <input
                placeholder="Ingrese el precio unitario"
                id="input_price"
                type="number"
                v-model= "price"
                class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              />
              <small v-if="vacio_price" class="text-yellow-600">
              {{
              vacio_price
              }}
              </small>
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
          <section class="mt-8 data sm:col-span-6">
            <div>
              <h1 class="font-semibold">Lista de materiales</h1>
            </div> 
            <table class="table-fixed">
              <tbody class="divide-y">
                <tr v-for="(material, index) in materiales"
                    :key="material.index">
                  <td class="w-2/4 pr-2 py-4">
                    <span
                      v-if="formActualizar && idActualizar == index">
                      <!-- Formulario para actualizar -->
                      <input v-model="nombreActualizar" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </span>
                    <span v-else>
                    <!-- Dato nombre -->
                      {{ material.name }}
                    </span>
                  </td>
                  <td>
                    <span v-if="formActualizar && idActualizar == index">
                      <!-- Formulario para actualizar -->
                      <input v-model="precioActualizar" type="number" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    </span>
                    <span v-else>
                      <!-- Dato precio -->
                      {{ material.price }}
                    </span>
                  </td>
                  <td>
                    <!-- Botón para guardar la información actualizada -->
                    <span v-if="formActualizar && idActualizar == index">
                      <button @click="guardarActualizacion(index)" class="py-2 px-3 mx-4 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                        Guardar</button>
                    </span>
                    <span v-else>
                      <!-- Botón para mostrar el formulario de actualizar -->
                      <button @click="verFormActualizar(index)" class="py-2 px-3 mx-4 border border-gray-300 rounded-md text-sm leading-4 font-medium text-white focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out bg-green-500">
                        Actualizar</button>
                      <!-- Botón para borrar -->
                      <button @click="borrarMaterial(index)" class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-white focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out bg-red-500">
                        Borrar</button>
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </section>

        </div>
      </div>
      <!--Fin de la sección-->

      <!--Sección donde recibira todo los datos de los componentes hijos-->
      <div class="mx-auto text-center mt-6">
        <span class="ml-3 inline-flex rounded-md shadow-sm">
          <button
            type="submit"
            v-show="!buton"
            @click="submitForm"
            class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
          >
            Guardar
          </button>
        </span>
      </div>
      <!--Fin de la sección-->

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
      buttonLoading: false,
      hasError: false,

      //Ver o no ver el formulario de actualizar
      formActualizar: false,
      //La posición de tu lista donde te gustaría actualizar 
      idActualizar: -1,

      //Se guarda como un objeto los valores del precio y datos del servicio
      price_details: '',
      service_details: '',

      sum: 0,

      //Datos del componente laborprice
      labor_price: 0,

      //Datos del componente materialprice
      materiales: [],
      name: '',
      price: 0,

      //Input nombre dentro del formulario de actualizar
      nombreActualizar: '',
      //Input precio dentro del formulario de actualizar
      precioActualizar: 0,

      //Precio minimo y maximo
      pmin: 0,
      pmax: 0,
      
      error_lab: '',
      vacio_lab: ''
    };
  },
  props: {
    id: String,
  },
  async created() {
    
  },
  methods: {
    /*async createMaterial() {
      this.validateSubmit();
      if (this.hasError) return;

      //Si cumple condicionales, se inserta campos en el arreglo general
      this.materiales.push({
        name: this.name,
        price: parseFloat(this.price)
      });
     
      //Después de cumplir su insercción, se liberan para insertar más materiales
      this.name = '';
      this.price = '';
    },
    verFormActualizar: function (material_id) {
      //Antes de mostrar el formulario de actualizar, rellenamos sus campos
      this.idActualizar = material_id;
      this.nombreActualizar = this.materiales[material_id].name;
      this.precioActualizar = this.materiales[material_id].price;
      //Mostramos el formulario
      this.formActualizar = true;
    },
    guardarActualizacion: function (material_id) {
      // Ocultamos nuestro formulario de actualizar
      this.formActualizar = false;
      // Actualizamos los datos
      this.materiales[material_id].name = this.nombreActualizar;
      this.materiales[material_id].price = parseFloat(this.precioActualizar);
    },
    borrarMaterial: function (material_id) {
      //Borramos de la lista
      this.materiales.splice(material_id, 1);
    },
    validateSubmit() {
      this.hasError = false;

      //Condicionales del precio ingresado
      if (this.labor_price > this.pmax){
        this.hasError = true;
        this.error_lab = "El precio ingresado es mayor a "+ this.pmax;
        this.vacio_lab = "";
      }
      else if(this.labor_price > 0 && this.labor_price < this.pmin){
        this.hasError = true;
        this.error_lab = "El precio ingresado es menor a "+ this.pmin;
        this.vacio_lab = "";
      }
      else if(this.labor_price == ""){
        this.hasError = true;
        this.error_lab = "";
        this.vacio_lab = "Campo Necesario";
      }
      else{  
        this.error_lab = "";
        this.vacio_lab = "";
      }
    },
    async submitForm() {
      this.validateSubmit();
      if (this.hasError) return;
      
      //Calculo de la nueva suma (si hubiera nueva suma)
      for(let i = 0; i < this.materiales.length; i++){
        this.sum = parseFloat(this.sum) + parseFloat(this.materiales[i].price);      
      }

      if(this.sum < parseInt(this.pmax)) this.sum = 0;
      
      //Conexión con la lógica de negocio
      let response = await api.post(`/update_price`,{
        laboral: parseInt(this.labor_price),
        materials: this.materiales,
        pmax: parseInt(this.sum),
        id_service: this.id
      })

      this.$router.push("/supplier/services");
    }*/
  }
};
</script>
