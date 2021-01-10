<template>
  <!-- EDIT PROFILE: Vista de editar perfil del proveedor.
  Muestra un formulario donde se pueden actualizar los datos del proveedor
  como DNI, edad, foto, nombres, apellidos, departamento, provincia,
  distrito, dirección y cuenta bancaria. --> 
  <main>
    <Loader class="min-h-screen"
          :load="loading"
        />
    <SideBar v-show="!loading" title="Actualización de Datos"
    :user="username"
    :image="image">
      <div class="bg-white overflow-hidden shadow rounded-lg">
        

        <div class="px-4 py-5 sm:p-6">
          <div>
            <div>
              <h3 class="text-lg leading-6 font-medium text-gray-900">
                Datos Personales
              </h3>
            </div>
            <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">  
              <div class="sm:col-span-3">
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

              <div class="sm:col-span-3">
                <label
                  for="photo"
                  class="block text-sm leading-5 font-medium text-gray-700"
                >
                  Foto de Perfil
                </label>
                <div class="mt-2 flex items-center">
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

              <div class="sm:col-span-3">
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
                  for="input_age"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >
                  Edad
                </label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input
                    placeholder="Digite su edad actual"
                    id="input_age"
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
                  class="block text-sm font-medium leading-5 text-gray-700"
                >
                  Provincia
                </label>
                <!--Solo si no se actualizo nada aun o se quiere volver a actualizar-->
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
                  class="block text-sm font-medium leading-5 text-gray-700"
                >
                  Distrito
                </label>
                <!--Solo si no se actualizo nada aun o se quiere volver a actualizar-->
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
                <router-link to="/supplier">
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
                  class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
                >
                  Guardar Cambios
                </button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </SideBar>
  </main>
</template>

<script>
import api from "../../api";
import functions from "../../functions";
import Loader from "../../components/Loader";

import SideBar from "../../components/SideBar";
import IconSvg from "../../components/IconSvg.vue";

export default {
  name: "EditProfile",
  components: {
    SideBar,
    IconSvg,
    Loader
  },
  data: () => {
    return {
      loading: true,
      token: localStorage.getItem('token'),
      level: localStorage.getItem('e_level'),
      username: '',
      image: '',

      hasError: false,
      dni_valid: false,
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
  async created() {
    let response = await api.get(`/services/level=${this.level}/token=${this.token}`)
    
    let supplier = response.data.data;

    this.username = supplier.username;
    this.image = supplier.file;
    this.dni = supplier.DNI;

    if(this.dni != undefined) {
      localStorage.setItem('e_DNI', this.dni);
      this.$router.push("/supplier");
    }

    let response2 = await api.get(`/dep`)
    this.departments = response2.data.data.departments;

    this.loading = false;
  },
  methods: {
    async validateDNI() {
      if ((this.dni.length >= 0 && this.dni.length < 8) || (this.dni.length > 8)) {
        this.hasError = true;
        this.dni_valid = false
        this.first_name = "";
        this.last_name_p = "";
        this.last_name_m = "";
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
          message: "El sistema detectó que el DNI no es válido",
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
    async Changeprov()
    {
      let response = await functions.getProv(this.department, this.departments)
      this.provinces = response.data.data.provinces; 
    },
    async Changedist()
    {
      let response = await functions.getDist(this.province, this.provinces)  
      this.districts = response.data.data.districts;
    },
    async submitForm() {
      this.validateSubmit();
      if (this.hasError) return;
      
      //Se condiciona las imágenes
      if(this.image === '' | this.image === "" | this.image === null){
        return this.$toast.open({
          message: 'Imagen requerida',
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      //Se manda datos a la lógica de negocio
      let response = await api.post(`/edit_data`, {
        level: this.level,
        token: this.token,
        dni: this.dni,
        age: this.age,
        photo: this.image,
        first_name: this.first_name,
        last_name_p: this.last_name_p,
        last_name_m: this.last_name_m,
        department: this.department,
        province: this.province,
        district: this.district,
        address: this.address,
        bank_account: this.bank_account,
      })

      //Si existe errores en la actualización de datos - no se comunica con la data
      if (!response.ok) {
        let er = response.error.errors;
        let mensaje = "Error desconocido";

        if(er.hasOwnProperty('fail')){
          mensaje = er.fail[0];
        }

        return this.$toast.open({
          message: mensaje,
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }
        
      this.$toast.open({
        message: response.data.data.success[0],
        type: "success",
        duration: 8000,
        dismissible: true
      });

      localStorage.setItem('e_DNI', this.dni);
      
      this.$router.push("/supplier");
    },
    validateSubmit() {
      if(this.hasError == true) this.hasError = true;
        else this.hasError = false;

      if(this.dni.length==0){
        this.hasError = true;
        this.error_dni = "";
        this.vacio_dni = "Campo necesario";
      }else{
        this.error_dni = "";
        this.vacio_dni = "";
      } 

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

      if (this.first_name == "") {
        this.hasError = true;
        this.vacio_first_name = "Campo necesario";
      } else this.vacio_first_name = "";

      if (this.last_name_p == "") {
        this.hasError = true;
        this.vacio_last_name_p = "Campo necesario";
      } else this.vacio_last_name_p = "";

      if (this.last_name_m == "") {
        this.hasError = true;
        this.vacio_last_name_m = "Campo necesario";
      } else this.vacio_last_name_m = "";

      if (this.department == "") {
        this.hasError = true;
        this.vacio_department = "Campo necesario";
      } else this.vacio_department = "";

      if (this.province == "") {
        this.hasError = true;
        this.vacio_province = "Campo necesario";
      } else this.vacio_province = "";

      if (this.district == "") {
        this.hasError = true;
        this.vacio_district = "Campo necesario";
      } else this.vacio_district = "";

      if (this.address == "") {
        this.hasError = true;
        this.vacio_address = "Campo necesario";
      } else this.vacio_address = "";

      if (this.bank_account == "") {
        this.hasError = true;
        this.vacio_bank_account = "Campo necesario";
      } else this.vacio_bank_account = "";
    },
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