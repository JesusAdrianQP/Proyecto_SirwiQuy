<template>
  <!-- CREATE SERVICE: Vista de registro de servicio.
  Muestra un formulario donde se solicita el titulo, descripción,
  categoría, departamento, provincia, distrito, precio minimo, precio
  máximo y una imagen del servicio a registrar. -->  
  <SideBar title="Publicar Servicio">

       <Loader class="min-h-screen"
            :load="loading"
      />

    <div v-show="!loading" class="bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <div class="sm:flex">
        <div class="sm:w-1/2 sm:pr-2">

          <!-- Sección de ingreso de titulo.
          Solicita el titulo y lo valida. --> 
          <div>
            <label
              for="input_title"
              class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-primary-600 "
            >
              Título
            </label>
            <div class="mt-1 rounded-md shadow-sm ">
              <input
                id="input_title"
                v-model="title"
                class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 border-primary-600 "
              />
            </div>
            <small v-if="error_title" class="text-red-600">{{
              error_title
            }}</small>
            <small v-if="vacio_title" class="text-yellow-600">{{
              vacio_title
            }}</small>
          </div>
          <!-- Fin de sección de ingreso de titulo. --> 

          <!-- Sección de ingreso de descripción.
          Solicita la descripción y la valida. --> 
          <div class="mt-6">
            <label
              for="input_description"
              class="block text-sm font-medium leading-5 text-gray-700"
            >
              Descripción
            </label>
            <div class="mt-1 rounded-md shadow-sm">
              <textarea
                id="input_description"
                v-model="description"
                rows="10"
                class="border-primary-600 whitespace-pre-line form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              ></textarea>
            </div>
            <small v-if="error_description" class="text-red-600">{{
              error_description
            }}</small>
            <small v-if="vacio_description" class="text-yellow-600">{{
              vacio_description
            }}</small>
          </div>
          <!-- Fin de sección de ingreso de descripción. --> 

          <!-- Sección de selección de categoría.
          Solicita la categoría y la valida. --> 
          <div class="mt-6">
            <label
              for="select_category"
              class="block text-sm font-medium leading-5 text-gray-700"
            >
              Categoría
            </label>
            <div class="mt-1 rounded-md shadow-sm">
              <select
                id="select_category"
                v-model="category"
                class="form-select block w-full border-primary-600 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
              >
                <option disabled="" value="">Seleccionar</option>
                <option value="Gasfitero">Gasfitería</option>
                <option value="Electricista">Electricidad</option>
                <option value="Carpintero">Carpintería</option>
                <option value="Cerrajero">Cerrajería</option>
                <option value="Vidriero">Vidrieria</option>
                <option value="Jardinero">Jardineria</option>
                <option value="Fumiguero">Fumigación</option>
              </select>
            </div>
            <small v-if="vacio_category" class="text-yellow-600">{{
              vacio_category
            }}</small>
          </div>
          <!-- Fin de sección de selección de categoría. --> 

          <!-- Sección de selección de distrito.
            Solicita el distrito y lo valida. --> 
            <div class="mt-6">
              <label
                for="select_district"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Distrito
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <select
                  id="select_district"
                  v-model="district"
                  class="form-select block w-full border-primary-600 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                >
                  <option selected="" disabled="" value="">Seleccionar</option>
                  <option v-for="district in districts" v-bind:key="district.id">{{district.name}}</option>
                </select>
              </div>
             <small v-if="vacio_district" class="text-yellow-600">{{
                vacio_district
              }}</small>
            </div>
            <!-- Fin de sección de selección de distrito. -->

        </div>
        <div class="sm:w-1/2 sm:pl-2">
          <div class="grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">

            

            <!-- Sección de ingreso de imagen.
            Solicita la imagen y la valida. --> 
            <div class="sm:col-span-6">
              <label for="cover_photo" class="block text-sm leading-5 font-medium text-gray-700">
                Imagen
              </label>
              <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-primary-600 border-dashed rounded-md">
                <!--Para elegir una imagen de referencia-->
                <div v-if="!image" class="text-center">
                  <svg class="mx-auto h-30 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                  <p class="mt-1 text-sm text-gray-600">
                    <label for="photo" style="cursor: pointer" class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition duration-150 ease-in-out">
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
                    PNG, JPG hasta 20KB
                  </p>
                </div>
                <!--Cuando ya se ha seleccionado la imagen se reemplaza con la imagen-->
                <div class="flex items-center" style="width: 100%;" v-else>
                    <button @click="removeImage" type="button" class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition duration-150 ease-in-out"
                    >
                    Eliminar imagen
                    </button>
                    <div class="text-center" style="width: 100%;">
                      <img :src="image" class="inline-block"/> 
                    </div>               
                </div>
              </div>
            </div> 
            <!-- Fin de sección de ingreso de imagen. -->

            <div class="sm:col-span-6">
              <img class="h-42 w-auto" src="../../../assets/public.png" alt="Workflow" />
            </div>

          </div>
        </div>
        </div>
        <div class="mt-8 border-t border-gray-200 pt-5">
          <div class="flex justify-end">
            <span class="inline-flex rounded-md shadow-sm">
              <router-link to="/worker">
                <button
                  type="button"
                  class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                >
                  Cancelar
                </button>
              </router-link>
            </span>
            <span class="ml-3 inline-flex rounded-md shadow-sm">
              <MyButton
                content="Siguiente"
                color="primary"
                @onClick="submitForm()"
                :isLoading="buttonLoading"
              ></MyButton>
            </span>
          </div>
        </div>
      </div>
    </div>
  </SideBar>
</template>


<script>
import api from "../../api";

import Loader from "../../components/Loader";
import SideBar from "../../components/SideBar";
import MyButton from "../../components/MyButton.vue";

export default {
  name: "CreateService",
  components: {
    SideBar,
    MyButton,
    Loader
  },
  data: () => {
    return {
      acceso: localStorage.getItem('e_level'),
      token: localStorage.getItem('token'),
      loading: true,
      username: '',
      img: '',
      id: '',

      hasError: false,
      buttonLoading: false,
      title: "",
      description: "",
      category: "",
      district: "",
      image: "",

      districts: [],
      
      error_title: "",
      error_description: "",

      vacio_title: "",
      vacio_district: "",
      vacio_description: "",
      vacio_category: "",
    }
  },
  async created()
  {
    let response = await api.post(`/dist`, {id: '1501'})
    this.districts = response.data.data.districts;

    this.loading = false;
  },
  methods: {
    async submitForm() {
      this.validateSubmit();
      if (this.hasError) return;
      this.buttonLoading = true;

      //Se condiciona las imágenes
      if(this.image === '' || this.image === "" || this.image === null){
        this.buttonLoading = false;

        return this.$toast.open({
          message: 'Imagen requerida',
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      //Se guarda provisionalmente los datos
      localStorage.setItem('e_title', this.title);
      localStorage.setItem('e_desc', this.description);
      localStorage.setItem('e_cate', this.category);
      localStorage.setItem('e_dist', this.district);
      localStorage.setItem('e_file', this.image);
      
      this.$router.push("/supplier/create/price");
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

      //Comprobacion de distritos
      if (this.district == "") {
        this.hasError = true;
        this.vacio_district = "Campo necesario";
      } else this.vacio_district = "";
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
    }
  }
}
</script>