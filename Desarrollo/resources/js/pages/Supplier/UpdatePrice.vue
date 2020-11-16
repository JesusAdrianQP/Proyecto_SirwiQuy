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
              <span v-if="formUpdate && idUpdate == index">
                  <input v-model="priceUpdate" type="number" class="form-control" />
                </span>
                <span v-else>S/ 50</span>
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
                  for="input_name"
                  class="pt-3 sm:py-3 block text-sm font-medium leading-5 text-gray-700"
                >Material</label>
              </div>
              <div class="lg:w-3/4 mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese el material"
                  id="input_name"
                  type="text"
                  @keyup.enter= "createMaterial"
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
            <div class="lg:flex sm:col-span-2">
              <div class="lg:w-1/4">
                <label
                  for="input_price"
                  class="sm:py-3 block text-sm font-medium leading-5 text-gray-700"
                >Precio</label>
              </div>
              <div class="lg:w-3/4 mt-1 rounded-md shadow-sm">
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
            <div class="data sm:col-span-6">
              <div>
                <h1 class="font-semibold">Lista de materiales</h1>
              </div>  
              
              <table class="table-fixed">
                <tbody class="divide-y divide-gray-400">
                  <tr>
                    <td class="w-2/4 pr-2 py-4">
                      <span class="grid gap-1 lg:gap-16 lg:grid-cols-2">
                        <span v-if="formUpdate && idUpdate == index">
                          <input v-model="materialUpdate" type="text"/>
                        </span>
                        <span v-else>madera</span>
                      
                        <span v-if="formUpdate && idUpdate == index">
                          <input v-model="priceUpdate" type="number" class="form-control" />
                        </span>
                        <span v-else>S/ 50</span>
                      </span>
                    </td>
                    
                  </tr>
                  <tr v-for="(material, index) in materiales" :key="material.index">
                    <td class="w-2/4 pr-2 py-4">
                      <span class="grid gap-1 lg:gap-16 lg:grid-cols-2">
                        <span v-if="formUpdate && idUpdate == index">
                          <input v-model="materialUpdate" type="text"/>
                        </span>
                        <span v-else>{{material.name}}</span>
                      
                        <span v-if="formUpdate && idUpdate == index">
                          <input v-model="priceUpdate" type="number" class="form-control" />
                        </span>
                        <span v-else>S/ {{material.price.toFixed(2)}}</span>
                      </span>
                    </td>
                    
                    <td class="w-1/4 py-4">
                      <span v-if="formUpdate && idUpdate == index">
                        <button
                          @click="saveUpdate(index)"
                          class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                        >Guardar</button>
                      </span>
                      
                      <span v-else class="grid gap-1 lg:grid-cols-2">
                        <!-- Botón para mostrar el formulario de actualizar -->
                        <button
                          @click="seeUpdateForm(index)"
                          class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-white focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out bg-green-500"
                        >Actualizar</button>
                        <!-- Botón para borrar -->
                        <button
                          @click="borrarMaterial(index)"
                          class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-white focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out bg-red-500"
                        >Borrar</button>
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div> 
                  <!--Fin de la sección-->

        </div>
      </div>
      <!--Fin de la sección-->

      <!--Sección donde recibira todo los datos de los componentes hijos
      <div class="mx-auto text-center mt-6">
        <span class="ml-3 inline-flex rounded-md shadow-sm">
          <button
            @click= "createMaterial"
            type="button"
            class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
          >Agregar</button>
          <button
            type="submit"
            v-show="!buton"
            @click="submitForm"
            class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
          >
            Actualizar Precio
          </button>
        </span>
      </div>-->
      <!--Fin de la sección-->
      <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse .right-4">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
        <button 
            type="button"
            class="py-2 px-6 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
          >Cancerlar</button>
        </span>
        <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
        <button @click="updateOpen=false" 
            type="button"
            class="inline-flex justify-center py-2 px-8 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
        >Actualizar Precio</button>
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
      formUpdate: false,
      idUpdate: -1,
      materialUpdate: '',
      priceUpdate: '',
      materiales: [],

      hasError: false,   
      error_name: '',
      error_price: ''
      /*
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
      */
    };
  },
  props: {
    id: String,
  },
  async created() {
    
  },
  methods: {

    createMaterial: function () {

      if(this.name!="" && this.price!=""){
        this.materiales.push({
        
        name: this.name,
        price: this.price
        });
        this.name = '';
        this.price = '';
        console.log(this.materiales);
      }
      else{
        alert("Ingrese el nombre del material y precio");
        //submitForm()
      }
      
    },
    seeUpdateForm: function (material_id){
      this.idUpdate = material_id;
      this.materialUpdate = this.materiales[material_id].name;
      this.priceUpdate = this.materiales[material_id].price;

      this.formUpdate = true;
    },
    borrarMaterial: function(material_id){
      this.materiales.splice(material_id, 1);
    },
    guardarActualizacion: function (material_id){
      this.formUpdate = false;

      this.materiales[material_id].name = this.materialUpdate;
      this.materiales[material_id].price = this.priceUpdate;
    },/*
    async submitForm() {
      this.validateSubmit();
      if (this.hasError) return;
      let response = await api.post(`/set/price`, {
        nombre: this.nombre,
        precio: this.precio,
      })
    },*/
    validateSubmit() {
      this.hasError = false;
      if (this.name == "") {
        this.hasError = true;
        this.error_name = "Campo obligatorio";
      } else this.error_name = "";
      if (this.price == "") {
        this.hasError = true;
        this.price = "Campo obligatorio";
      } else this.price = "";
      
      
    }

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
