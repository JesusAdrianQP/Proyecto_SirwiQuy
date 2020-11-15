<template>
  <SideBar title="Actualización de Servicio">
    <div class="bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <div class="sm:flex">
        <div class="sm:w-1/2 sm:pr-2">
          <div>
            <label
              for="input_title"
              class="block text-sm font-semibold leading-5 text-gray-700"
            >
              Título :
            </label>
            <div class="mt-1 rounded-md shadow-sm">
              <input
                id="input_title"
                v-model="title"
                class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              />
            </div>
            <small v-if="error_title" class="text-red-600">{{
              error_title
            }}</small>
            <small v-if="vacio_title" class="text-yellow-600">{{
              vacio_title
            }}</small>
          </div>

          <div class="mt-6 ">
            <label
              for="input_description"
              class="block text-sm font-semibold leading-5 text-gray-700"
            >
              Descripción :
            </label>
            <div class="mt-1 rounded-md shadow-sm">
              <textarea
                id="input_description"
                v-model="description"
                rows="6"
                class="whitespace-pre-line form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              ></textarea>
            </div>
            <small v-if="error_description" class="text-red-600">{{
              error_description
            }}</small>
            <small v-if="vacio_description" class="text-yellow-600">{{
              vacio_description
            }}</small>
          </div>

          <div class="mt-6">
            <label
              for="select_category"
              class="block text-sm font-semibold leading-5 text-gray-700"
            >
              Categoría :
            </label>
            <div class="mt-1 rounded-md shadow-sm">
              <select
                id="select_category"
                v-model="category"
                class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              >
                <option disabled="" value="">Seleccionar</option>
                <option value="Gastifero">Gasfitería</option>
                <option value="Electricista">Electricidad</option>
                <option value="Carpintero">Carpintería</option>
                <option value="Cerrajero">Cerrajería</option>
              </select>
            </div>
            <small v-if="vacio_category" class="text-yellow-600">{{
              vacio_category
            }}</small>
          </div>
        </div>
        <div class="sm:w-1/2 sm:pl-2">
          <div class="grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
            <div class="sm:col-span-2">
              <label
                for="select_department"
                class="block text-sm font-semibold leading-5 text-gray-700"
              >
                Departamento :
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <select
                  @change="Changeprov"
                  id="select_department"
                  v-model="department"
                  class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                >
                  <option disabled="" value="">Seleccionar</option>
                  <option v-for="department in departments" v-bind:key="department.id">{{department.name}}</option>
                </select>
              </div>
              <small v-if="vacio_department" class="text-yellow-600">{{
                vacio_department
              }}</small>
            </div>

            <div class="sm:col-span-2">
              <label
                for="select_province"
                class="block text-sm font-semibold leading-5 text-gray-700"
              >
                Provincia :
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <select
                  @change="Changedist"
                  id="select_province"
                  v-model="province"
                  class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                >
                  <option disabled="" value="">Seleccionar</option>
                  <option v-for="province in provinces" v-bind:key="province.id">{{province.name}}</option>
                </select>
              </div>
              <small v-if="vacio_province" class="text-yellow-600">{{
                vacio_province
              }}</small>
            </div>

            <div class="sm:col-span-2">
              <label
                for="select_district"
                class="block text-sm font-semibold leading-5 text-gray-700"
              >
                Distrito :
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <select
                  id="select_district"
                  v-model="district"
                  class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                >
                  <option selected="" disabled="" value="">Seleccionar</option>
                  <option v-for="district in districts" v-bind:key="district.id">{{district.name}}</option>
                </select>
              </div>
             <small v-if="vacio_district" class="text-yellow-600">{{
                vacio_district
              }}</small>
            </div>

            <div class="sm:col-span-3">
              <label
                for="input_min_price"
                class="block text-sm font-semibold leading-5 text-gray-700"
              >
                Menor Precio :
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  id="input_min_price"
                  type='number'
                  v-model="min_price"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="error_min_price" class="text-red-600">{{
                error_min_price
              }}</small>
              <small v-if="vacio_min_price" class="text-yellow-600">{{
                vacio_min_price
              }}</small>
            </div>

            <div class="sm:col-span-3">
              <label
                for="input_max_price"
                class="block text-sm font-semibold leading-5 text-gray-700"
              >
                Mayor Precio :
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  id="input_max_price"
                  type='number'
                  v-model="max_price"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_max_price" class="text-yellow-600">{{
                vacio_max_price
              }}</small>
            </div>

            <div class="sm:col-span-6">
              <label for="cover_photo" class="block text-sm leading-5 font-semibold text-gray-700">
                Imagen :
              </label>
              <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <!--Para elegir una imagen de referencia-->
                <div v-if="!image" class="text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <p class="mt-1 text-sm text-gray-600">
                    <label for="photo" style="cursor: pointer" class="font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:underline transition duration-150 ease-in-out">
                      Agregar fotos
                    </label>
                    <span class="photo">
                      <input
                        id="photo"
                        type="file"
                        style="display:none;"
                        accept="image/png, .jpeg, .jpg"
                        @change="onFileChange"
                      /> 
                    </span>
                  </p>
                  <p class="mt-1 text-xs text-gray-500">
                    PNG, JPG hasta 10MB
                  </p>
                </div>
                <!--Cuando ya se ha seleccionado la imagen se reemplaza con la imagen-->
                <div class="flex items-center" style="width: 100%;" v-else>
                    <button @click="removeImage" type="button" class="font-medium text-teal-600 hover:text-teal-500 focus:outline-none focus:underline transition duration-150 ease-in-out"
                    >
                    Eliminar imagen
                    </button>
                    <div class="text-center" style="width: 100%;">
                      <img :src="image" class="inline-block"/> 
                    </div>               
                </div>
              </div>
            </div>               
          </div>
        </div>
        </div>
        <div class="mt-8 border-t border-gray-200 pt-5">
          <div class="flex justify-end">
            <span class="inline-flex rounded-md shadow-sm">
              <router-link to="/supplier/services">
                <button
                  type="button"
                  class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                >
                  Cancelar
                </button>
              </router-link>
            </span>
            <span class="ml-3 inline-flex rounded-md shadow-sm">
              <button
                type="submit"
                v-show="!buton"
                @click="submitForm"
                class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
              >
                Actualizar datos
              </button>
            </span>
          </div>
        </div>
      </div>
    </div>
  </SideBar>
</template>

<script>
import api from "../../api";

import SideBar from "../../components/SideBar";

export default {
  name: "UpdateService",
  components: {
    SideBar
  },
  data() {
    return {
      hasError: false,
      buttonLoading: false,

      //Se guarda como un objeto los valores del servicio
      service_details: '',

      title: "",
      description: "",
      category: "",
      department: "",
      province: "",
      district: "",
      min_price: "",
      max_price: "",
      image: "",

      departments: [],
      districts: [],
      provinces: [],
        
      error_title: "",
      error_description: "",
      error_min_price: "",

      vacio_title: "",
      vacio_department: "",
      vacio_province: "",
      vacio_district: "",
      vacio_description: "",
      vacio_category: "",
      vacio_min_price: "",
      vacio_max_price: ""
    }
  },
  props: {
    id: String,
  },
  /*async created() {
    let response = await api.get(`/service/${this.id}`);
    this.service_details = response.data.data.serv_details;

    //Se le asigna los valores correspondientes
    this.title = this.service_details.title;
    this.description = this.service_details.description;
    this.category = this.service_details.category;
    this.department = this.service_details.departamento;
    this.province = this.service_details.provincia;
    this.district = this.service_details.distrito;
    this.min_price = this.service_details.precioMin;
    this.max_price = this.service_details.precioMax;
    this.image = this.service_details.file;

    //Ubica el departamento, provincia y distrito ya elegido por el proveedor
    let response1 = await api.get(`/dep`)
    this.departments = response1.data.data.departments;
    
    let response2 = await functions.getProv(this.department, this.departments)
    this.provinces = response2.data.data.provinces;

    let response3 = await functions.getDist(this.province, this.provinces)  
    this.districts = response3.data.data.districts;
  },
  async mounted(){
    //Cuando se carga se trae automaticamente los departamentos listos para ser usados en cualquier instante
    let response = await api.get(`/dep`)
    this.departments = response.data.data.departments;
  },
  methods: {
    //Recalcula solo provincias
    async Changeprov()
    {
      let response = await functions.getProv(this.department, this.departments)
      this.provinces = response.data.data.provinces; 
    },
    //Recalcula Distritos
    async Changedist()
    {
      let response = await functions.getDist(this.province, this.provinces)  
      this.districts = response.data.data.districts;
    },
    async change(){
      //Se habilita campos
      this.select = false;
      this.buton = false;
      this.disabled = 0;
      this.department = "";
      this.district = "";
      this.province = "";
    },
    //Funciones para ubicar imagen
    onFileChange(e) {
      var files = e.target.files || e.dataTransfer.files;
      this.image = files;
      if (!files.length)
        return;
      this.createImage(files[0]);
    },
    createImage(file) {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.image = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage(e) {
      this.image = '';
    },
    async borrarMaterial(material_id){
      //Se elimina solo un material desde la posición index
      this.materiales.splice(material_id, 1);
    },
    validateSubmit() {
      this.hasError = false;

      //Validación del titulo
      if (this.title == "") {
        this.hasError = true;
        this.error_title = "";
        this.vacio_title = "Campo necesario";
      } else if (this.title.length > 50) {
        this.hasError = true;
        this.error_title = "Título demasiado largo";
        this.vacio_title = "";
      } else{
        this.error_title = "";
        this.vacio_title = "";
      } 

      //Validación de la descripción
      if (this.description == "") {
        this.hasError = true;
        this.error_title = "";
        this.vacio_description = "Campo necesario";
      } else if (this.description.length > 7500) {
        this.hasError = true;
        this.error_description = "Descripción demasiado larga";
        this.vacio_description = "";
      } else{
        this.error_description = "";
        this.vacio_description = "";
      }

      //Comprobacion de categorias
      if(this.category == ""){
        this.hasError = true;
        this.vacio_category = "Campo necesario";
      } else this.vacio_category = "";

      //Comprobacion de departamento
      if (this.department == "") {
        this.hasError = true;
        this.vacio_department = "Campo necesario";
      } else this.vacio_department = "";

      //Comprobacion de provincias
      if (this.province == "") {
        this.hasError = true;
        this.vacio_province = "Campo necesario";
      } else this.vacio_province = "";

      //Comprobacion de distritos
      if (this.district == "") {
        this.hasError = true;
        this.vacio_district = "Campo necesario";
      } else this.vacio_district = "";
        
      //Comprobacion de precios mínimos        
      if (this.min_price == "") {
        this.hasError = true;
        this.vacio_min_price = "Campo necesario";
        this.error_min_price = "";
      } else if (this.min_price < 70) {
        this.hasError = true;
        this.error_min_price = "Precio mínimo igual a 71";
        this.vacio_min_price = "";
      } else{
        this.error_min_price = "";
        this.vacio_min_price = "";
      }

      //Comprobacion de precio máximo
      if (this.max_price == "") {
        this.hasError = true;
        this.vacio_max_price = "Campo necesario";
      } else this.vacio_max_price = "";
    },
    async submitForm() {
      this.validateSubmit();
      if (this.hasError) return;

      //Conexión con la lógica de negocio
      let response = await api.post(`/update_service`, {
        id_service: this.id,
        title: this.title,
        description: this.description,
        category: this.category,
        department: this.department,
        province: this.province,
        district: this.district,
        min_price: this.min_price,
        max_price: this.max_price,
        photo: this.image,
      })
          
      this.$router.push("/supplier/services");
    },
  },*/
}
</script>