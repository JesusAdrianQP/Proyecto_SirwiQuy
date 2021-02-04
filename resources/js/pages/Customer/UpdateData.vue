<template>
  <!--UPDATE DATA: Sección de actualización de los datos del cliente-->
  <div class="bg-gray-100 min-h-screen">
    <NavBar />
    <!--Sección de la clase principal-->
    <main class="">
      <div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
        <h3 class="text-3xl font-medium leading-6 text-gray-900">
          Datos del Cliente
        </h3>

        <div class="hidden sm:block">
          <div class="py-4">
            <div class="border-t border-gray-200"></div>
          </div>
        </div>
        
        <div class="max-w-2x1 mx-auto py-3 sm:px-6 lg:px-8">
          <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow sm:rounded-md sm:overflow-hidden">
              <div class="px-4 py-5 bg-white sm:p-6">
                <div
                  class="grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6"
                >
                  <!--Sección del DNI-->
                  <div class="sm:col-span-3">
                    <label
                      for="input_dni"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      DNI
                    </label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                      <input
                        id="input_dni"
                        :disabled="disabled"
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
                  <!--Fin de la sección DNI-->

                  <!--Sección del campo edad-->
                  <div class="sm:col-span-3">
                    <label
                      for="input_age"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      Edad
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <input               
                        id="input_age"
                        :disabled="disabled"
                        type="number"
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
                  <!--Fin de la sección edad-->

                  <!--Sección del campo nombre-->
                  <div class="sm:col-span-6">
                    <label
                      for="input_first_name"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      Nombre(s)
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <input
                        id="input_first_name"
                        disabled="disabled"
                        v-model="first_name"
                        type="text"
                        class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      />
                    </div>
                    <small v-if="vacio_first_name" class="text-yellow-600">{{
                      vacio_first_name
                    }}</small>
                  </div>
                  <!--Fin de la sección nombre-->

                  <!--Seccion del campo apellido paterno-->
                  <div class="sm:col-span-3">
                    <label
                      for="input_last_name_p"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      Apellido Paterno
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <input
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
                  <!--Fin de la sección apellido paterno-->

                  <!--Sección del apellido materno-->
                  <div class="sm:col-span-3">
                    <label
                      for="input_last_name_m"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      Apellido Materno
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <input
                        id="input_last_name_m"
                        disabled="disabled"
                        v-model="last_name_m"
                        class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      />
                    </div>
                    <small v-if="vacio_last_name_m" class="text-yellow-600">{{
                      vacio_last_name_m
                    }}</small>
                  </div>
                  <!--Fin de la sección apellido materno-->

                  <!--Sección del select departamento-->
                  <div class="sm:col-span-2">
                    <label
                      for="select_department"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      Departamento
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <select
                        @change="Changeprov"
                        id="select_department"
                        v-model="department"
                        :disabled="disabled"
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
                  <!--Fin de la sección selector departamento-->

                  <!--Sección del selector provincia-->
                  <div class="sm:col-span-2">
                    <label
                      for="select_province"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      Provincia
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <select
                        @change="Changedist"
                        id="select_province"
                        v-model="province"
                        :disabled="disabled"
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
                  <!--Fin de la sección del selector provincia-->

                  <!--Sección del selector distrito-->
                  <div class="sm:col-span-2">
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
                        :disabled="disabled"
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
                  <!--Fin del selector distrito-->

                  <!--Sección de la dirección del cliente-->
                  <div class="sm:col-span-2">
                    <label
                      for="input_address"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      Dirección (Av/Jr/Calle)
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <input
                        :disabled="disabled"
                        id="input_address"
                        v-model="address"
                        class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      />
                    </div>
                    <small v-if="vacio_address" class="text-yellow-600">{{
                      vacio_address
                    }}</small>
                  </div>
                  <!--Fin de la sección dirección del cliente-->

                  <!--Sección del numero de direccion-->
                  <div class="sm:col-span-2">
                    <label
                      for="input_address_number"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      Nro.
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <input
                        :disabled="disabled"
                        id="input_address_number"
                        v-model="address_number"
                        class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      />
                    </div>
                    <small v-if="vacio_address_number" class="text-yellow-600">{{
                      vacio_address_number
                    }}</small>
                  </div>
                  <!--Fin de la seccion numero de la direccion del cliente-->

                  <!--Sección del piso dpto del cliente-->
                  <div class="sm:col-span-2">
                    <label
                      for="input_address_detail"
                      class="block text-sm font-medium leading-5 text-gray-700"
                    >
                      Piso/Dpto (ej. 1/A)
                    </label>
                    <div class="mt-1 rounded-md shadow-sm">
                      <input
                        :disabled="disabled"
                        id="input_address_detail"
                        v-model="address_detail"
                        class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                      />
                    </div>
                    <small v-if="vacio_address_detail" class="text-yellow-600">{{
                      vacio_address_detail
                    }}</small>
                  </div>
                  <!--Fin de la seccion piso por dpto del cliente-->

                  <!--Sección de la foto de perfil del cliente-->
                  <div class="sm:col-span-3">
                    <label
                      for="photo"
                      class="block text-sm leading-5 font-medium text-gray-700"
                    >
                      Foto de Perfil
                    </label>
                    <div class="mt-2 flex items-center">
                      <!--Cuando la imagen aun no ha sido seleccionada-->
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
                      <!--Cuando la imagen ya fue seleccionada-->
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
                  <!--Fin de la sección foto de perfil-->
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="hidden sm:block">
          <div class="py-5">
            <div class="border-t border-gray-200"></div>
          </div>
        </div>

        <div class="mt-10 sm:mt-0">
          <div class="flex justify-center">
            <span class="ml-3 inline-flex rounded-md shadow-sm">
              <button 
                @click="actualizarDatos;startH();disabled=!disabled;"
                type="button"
                v-if="start"
                key='start'
                class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
              >
                Actualizar
              </button>
            
              <button
                @click="startH();submitForm=true;disabled=!disabled;"
                type="submit"
                key='stop' 
                v-else
                class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
              >
                Guardar
              </button> 
            </span>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
import functions from "../../functions";
import api from "../../api";

import NavBar from "../../components/NavBar.vue";
import IconSvg from "../../components/IconSvg.vue";

export default {
  name: "UpdateData",
  components: {
    NavBar,
    IconSvg
  },
  data: ()=> {
    return {
      hasError: false,
      dni_valid: false,
      isType: '',
      
      //Valores del v-model
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
      address_number: "",
      address_detail: "",

      departments: [],
      districts: [],
      provinces: [],

      error_dni: "",
      error_age: "",

      vacio_dni:"",
      vacio_age:"",
      vacio_first_name: "",
      vacio_last_name_p: "",
      vacio_last_name_m: "",
      vacio_department: "",
      vacio_province: "",
      vacio_district: "",
      vacio_address: "",
      vacio_address_number: "",
      vacio_address_detail: "",

      //Modal de actualizar
      actualizarDatos:false,

      //Datos de prueba
      

      disabled:true,
      //Transición
      start: true,
      stop: false,

    };
  },
  async mounted(){
    //Cuando se carga se trae automaticamente los departamentos
    let response = await api.get(`/dep`)
    this.departments = response.data.data.departments;
  },
  methods: {

    startH () {
      this.start = !this.start
      this.stop = !this.stop
    },
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
    async submitForm() {
      this.validateSubmit();
      if (this.hasError) return;

      //Se condiciona las imágenes
      if(this.image === '' | this.image === "" | this.image === null){
        return this.$toast.open({
          message: 'La imagen es esencial según nuestras politicas! Por favor ingrese una ...',
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      //Se manda datos a la lógica de negocio
      let response = await api.post(`/edit_data`, {
        identity: "cliente",
        id: localStorage.getItem('e_id'),
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
        nro: this.address_number,
        piso: this.address_detail
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

      //Modifico mis datos de usuario
      localStorage.setItem('e_DNI', this.dni);
      localStorage.setItem('e_edad', this.age);
      localStorage.setItem('e_file', this.image);
      localStorage.setItem('e_name', this.first_name);
      localStorage.setItem('e_lastnamep', this.last_name_p);
      localStorage.setItem('e_lastnamem', this.last_name_m);
      localStorage.setItem('e_depa', this.department);
      localStorage.setItem('e_prov', this.province);
      localStorage.setItem('e_dist', this.district);
      localStorage.setItem('e_adress', this.address);
      localStorage.setItem("e_nro_piso", this.address_number);
      localStorage.setItem("e_piso_dpto", this.address_detail);
      
      this.$router.push("/");
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

      //Comprobacion de direccion por calle
      if (this.address_number == "") {
        this.hasError = true;
        this.vacio_address_number = "Campo necesario";
      } else this.vacio_address_number = "";

      //Comprobacion de direccion por piso o dpto
      if (this.address_detail == "") {
        this.hasError = true;
        this.vacio_address_detail = "Campo necesario";
      } else this.vacio_address_detail = "";
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