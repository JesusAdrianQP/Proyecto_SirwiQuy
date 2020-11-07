<template>
  <!-- EDIT PROFILE: Vista de editar perfil del proveedor.
  Muestra un formulario donde se pueden actualizar los datos del proveedor
  como DNI, edad, foto, nombres, apellidos, departamento, provincia,
  distrito, dirección y cuenta bancaria. -->  
  <SideBar title="Actualización de Datos">
    <div class="bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6">
        <div>
          <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
              Datos Personales
            </h3>
          </div>
          <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
            
            <!-- Sección de ingreso de DNI.
            Solicita el DNI y lo valida. --> 
            <div class="sm:col-span-2">
              <label
                for="input_dni"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                DNI
              </label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <input
                  placeholder="Ingrese su DNI"
                  id="input_dni"
                  :disabled="disabled == 1 ? true : false"
                  v-model="dni"
                  @change="validateDNI"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
                <div
                  class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                >
                  <IconSvg v-show="!dni_valid" solid="solid" icon="exclamation-circle" myClass="h-5 w-5 text-red-500"/>
                  <IconSvg
                  v-show="dni_valid"
                    solid="solid"
                    icon="check-circle"
                    myClass="h-5 w-5 text-green-500"
                  />
                </div>
              </div>
              <small v-if="error_dni" class="text-red-600">{{
                error_dni
              }}</small>
              <small v-if="vacio_dni" class="text-yellow-600">{{
                vacio_dni
              }}</small>
            </div>

            <div class="sm:col-span-2">
              <label
                for="input_age"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Edad
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Digite su edad actual"
                  id="input_age"
                  :disabled="disabled == 1 ? true : false"
                  type="number"
                  max="90"
                  v-model="age"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="error_age" class="text-red-600">{{
                error_age
              }}</small>
              <small v-if="vacio_age" class="text-yellow-600">{{
                vacio_age
              }}</small>
            </div>
            
            <div class="sm:col-span-2">
              <label
                for="photo"
                class="block text-sm leading-5 font-medium text-gray-700"
              >
                Foto de Perfil
              </label>
              <div class="mt-2 flex items-center">
                <!--span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                  <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                </span-->
                <div v-if="!image">
                  <label
                    for="photo"
                    style="cursor: pointer"
                    class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-center text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
                    Seleccionar imagen
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
                </div> 

                <div class="flex items-center" style="width: 100%;" v-else>
                    <button @click="removeImage" class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                      style="width: 100%;">
                  Eliminar imagen
                  </button>

                  <div class="text-center" style="width: 100%;">
                    <img :src="image" class="inline-block h-20 w-20 sm:h-32 sm:w-32 rounded-full"/> 
                  </div>               
                </div>
                
              </div>
            </div>

            <div class="sm:col-span-6">
              <label
                for="input_first_name"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Nombre(s)
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese sus nombres completos"
                  id="input_first_name"
                  v-model="first_name"
                  type="text"
                  disabled="disabled"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_first_name" class="text-yellow-600">{{
                vacio_first_name
              }}</small>
            </div>
            
            <div class="sm:col-span-3">
              <label
                for="input_last_name_p"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Apellido Paterno
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese su apellido paterno"
                  id="input_last_name_p"
                  v-model="last_name_p"
                  disabled="disabled"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_last_name_p" class="text-yellow-600">{{
                vacio_last_name_p
              }}</small>
            </div>

            <div class="sm:col-span-3">
              <label
                for="input_last_name_m"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Apellido Materno
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese su apellido materno"
                  id="input_last_name_m"
                  v-model="last_name_m"
                  disabled="disabled"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_last_name_m" class="text-yellow-600">{{
                vacio_last_name_m
              }}</small>
            </div>
          </div>
        </div>
        <div class="mt-8 border-t border-gray-200 pt-6">
          <div>
            <h3 class="text-lg leading-6 font-medium text-gray-900">
              Domicilio
            </h3>
          </div>
          <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
            <div class="sm:col-span-2">
              <label
                for="select_department"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Departamento
              </label>
              <!--Solo si no se actualizo nada aun o se quiere volver a actualizar-->
              <div v-show="!select" class="mt-1 rounded-md shadow-sm">
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
              <!--Si ya posee un dato guardado-->
              <div v-show="select" class="mt-1 rounded-md shadow-sm">
                <input
                  v-model="department"
                  disabled="disabled"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_department" class="text-yellow-600">{{
                vacio_department
              }}</small>
            </div>

            <div class="sm:col-span-2">
              <label
                for="select_province"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Provincia
              </label>
              <!--Solo si no se actualizo nada aun o se quiere volver a actualizar-->
              <div v-show="!select" class="mt-1 rounded-md shadow-sm">
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
              <!--Si ya posee un dato guardado-->
              <div v-show="select" class="mt-1 rounded-md shadow-sm">
                <input
                  v-model="province"
                  disabled="disabled"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_province" class="text-yellow-600">{{
                vacio_province
              }}</small>
            </div>

            <div class="sm:col-span-2">
              <label
                for="select_district"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Distrito
              </label>
              <!--Solo si no se actualizo nada aun o se quiere volver a actualizar-->
              <div v-show="!select" class="mt-1 rounded-md shadow-sm">
                <select
                  id="select_district"
                  v-model="district"
                  class="form-select block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                >
                  <option selected="" disabled="" value="">Seleccionar</option>
                  <option v-for="district in districts" v-bind:key="district.id">{{district.name}}</option>
                </select>
              </div>
              <!--Si ya posee un dato guardado-->
              <div v-show="select" class="mt-1 rounded-md shadow-sm">
                <input
                  v-model="district"
                  disabled="disabled"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_district" class="text-yellow-600">{{
                vacio_district
              }}</small>
            </div>

            <div class="sm:col-span-6">
              <label
                for="input_address"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Dirección
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese su dirección de referencia"
                  id="input_address"
                  :disabled="disabled == 1 ? true : false"
                  v-model="address"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_address" class="text-yellow-600">{{
                vacio_address
              }}</small>
            </div>

            <div class="sm:col-span-6">
              <label
                for="input_bank_account"
                class="block text-sm font-medium leading-5 text-gray-700"
              >
                Cuenta Bancaria
              </label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese su número de cuenta bancaria"
                  id="input_bank_account"
                  :disabled="disabled == 1 ? true : false"
                  v-model="bank_account"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_bank_account" class="text-yellow-600">{{
                vacio_bank_account
              }}</small>
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
              <button
                @click="submitForm"
                type="submit"
                v-show="!buton"
                class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
              >
                Guardar Cambios
              </button>

              <button
                type="submit"
                v-show="buton"
                @click="change"
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
import IconSvg from "../../components/IconSvg.vue";

export default {
  name: "EditProfile",
  components: {
    SideBar,
    IconSvg
  },
  data: () => {
    return {
      disabled: 0,
      hasError: false,
      dni_valid: false,
      select: false,
      buton:false,
      isType:"",

      dni: "",
      age: "",
      image: "",
      first_name: "",
      last_name_p: "",
      last_name_m: "",
      department: "",
      province: "",
      district: "",
      address: "",
      bank_account: "",

      departments: [],
      districts: [],
      provinces: [],

      error_dni: "",
      error_age: "",
        
      vacio_dni: "",
      vacio_age: "",
      vacio_first_name:"",
      vacio_last_name_m:"",
      vacio_last_name_p:"",
      vacio_department: "",
      vacio_province: "",
      vacio_district: "",
      vacio_address: "",
      vacio_bank_account: "",
    }
  },
  async mounted() {
    //Si es usuario nuevo me muestra todos los campos vacíos
    if(localStorage.getItem('e_DNI') === '' ||  localStorage.getItem('e_DNI') === null ||  localStorage.getItem('e_DNI') === ""){
      console.log("Bienvenido a SirwiyQuy, usuario nuevo")
    }
  },
  methods: {
    //Validacion del DNI con la API
    async validateDNI()
    {
      //Se comprueba longitud del campo apenas se llene
      if ((this.dni.length >= 0 && this.dni.length < 8) || (this.dni.length > 8)) {
        this.hasError = true;
        this.error_dni = "El DNI debe tener 8 dígitos";
        this.vacio_dni = "";
        return;
      }else{
        this.hasError = false;
        this.error_dni = "";
        this.vacio_dni = "";
        this.isType = 'DNI';
      } 

      let response = await api.get(`/validate/${this.isType}/${this.dni}`)//Se envia validacion
      
      if (!response.ok) {
        this.dni_valid = false

        this.first_name = "";
        this.last_name_p = "";
        this.last_name_m = "";
           
        return this.$toast.open({
          message: "Ocurrio un error, el DNI ingresado no existe o es de un menor de edad",
          type: "error",
          duration: 8000,
          dismissible: true
        });   
      }
      
      //Si todo esta correcto obtengo datos del DNI, solo los más relevantes
      this.first_name = response.data.data[0].nombres;
      this.last_name_p = response.data.data[0].apellidoPaterno;
      this.last_name_m = response.data.data[0].apellidoMaterno;
      this.dni_valid = true

      this.$toast.open({
        message: response.data.data.success,
        type: "success",
        duration: 8000,
        dismissible: true
      });
    },
    async submitForm() {
      this.validateSubmit();
      if (this.hasError) return;
    },
    validateSubmit() {
      if(this.hasError == true) this.hasError = true;
        else this.hasError = false;

      //Validacion del DNI
      if(this.dni.length==0){
        this.hasError = true;
        this.error_dni = "";
        this.vacio_dni = "Campo necesario";
      }else{
        this.error_dni = "";
        this.vacio_dni = "";
      } 

      //Comprobacion de edad
      if ((this.age > 0 && this.age < 18)) {
        this.hasError = true;
        this.error_age = "La edad debe ser mayor a 18";
        this.vacio_age = "";
      } else if(this.age == 0){
        this.hasError = true;
        this.error_age = "";
        this.vacio_age = "Campo necesario";
      }else{
        this.error_age = "";
        this.vacio_age = "";
      } 

      //Comprobacion de nombres
      if (this.first_name == "") {
        this.hasError = true;
        this.vacio_first_name = "Campo necesario";
      } else this.vacio_first_name = "";

      //Comprobacion de apellido paterno
      if (this.last_name_p == "") {
        this.hasError = true;
        this.vacio_last_name_p = "Campo necesario";
      } else this.vacio_last_name_p = "";

      //Comprobacion de apellido materno
      if (this.last_name_m == "") {
        this.hasError = true;
        this.vacio_last_name_m = "Campo necesario";
      } else this.vacio_last_name_m = "";

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

      //Comprobacion de dirreccion de casa
      if (this.address == "") {
        this.hasError = true;
        this.vacio_address = "Campo necesario";
      } else this.vacio_address = "";

      //Comprobacion de cuenta bancaria
      if (this.bank_account == "") {
        this.hasError = true;
        this.vacio_bank_account = "Campo necesario";
      } else this.vacio_bank_account = "";
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