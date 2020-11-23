<template>
  <!--Sección del componente MATERIALPRICE: se observa el precio
  de los materiales de dicho anuncio-->  
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
</template>

<script>

export default {
  name: "MaterialPrice",
  data: () => {
    return {
      hasError: false,
      formUpdate: false,
      idUpdate: -1,

      name: '',
      price: '',
      
      materialUpdate: '',
      priceUpdate: '',
      materiales: [],
      
      //Precio minimo y precio maximo obtenidos y convertidos a enteros
      pmini: parseInt(localStorage.getItem('p_min')),
      pmax: parseInt(localStorage.getItem('p_max')),

      vacio_name: '',
      vacio_price: ''
    };
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
        alert("Ingrese el nombre y promedio del estudiantes");
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
    async createMaterial() {
      this.validateSubmit();
      if (this.hasError) return;

      //Si cumple condicionales, se inserta campos en el arreglo general
      this.materiales.push({
        name: this.name,
        price: parseFloat(this.price)
      });
     
      //Evento que el componente padre oira para obtener estos dos valores
      this.$emit('getMaterials', {
        material_price: this.materiales,
      })

      //Después de cumplir su insercción, se liberan para insertar más materiales
      this.name = '';
      this.price = '';
    },
    async seeUpdateForm(material_id){
      //Encuentro el indice del elemento a actualizar
      this.idUpdate = material_id;
      this.materialUpdate = this.materiales[material_id].name;
      this.priceUpdate = this.materiales[material_id].price;

      this.formUpdate = true;
    },
    async borrarMaterial(material_id){
      //Se elimina solo un material desde la posición index
      this.materiales.splice(material_id, 1);
    },
    async saveUpdate(material_id){
      this.formUpdate = false;

      //Se actualiza los nuevos materiales
      this.materiales[material_id].name = this.materialUpdate;
      this.materiales[material_id].price = parseFloat(this.priceUpdate);
    },*/
    validateSubmit() {
      this.hasError = false;

      //Condicionales del nombre
      if (this.name == "") {
        this.hasError = true;
        this.vacio_name = "Campo necesario";
      }
      else this.vacio_name = "";
      
      //Condiconales del precio ingresado del producto
      if(this.price == ""){
        this.hasError = true;
        this.vacio_price = "Campo Necesario";
      }
      else this.vacio_price = "";
    }
  }
};
</script>