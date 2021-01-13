<template>
  <!-- SERVICE FORM: Vista de formulario para registro de datos del usuario.
  Valida los nombres y apellidos del usuario con el DNI, además
  solicita edad, dirección, departamento, provincia y distrito. -->  
  <Visitor @onCustomerIdForm="getCustomerIdForm">
    <div class="bg-gray-100 min-h-screen">
      <main class>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
          <h3 class="text-2xl font-medium leading-6 ml-3 mb-4 sm:mb-1 sm:ml-0 text-gray-900">Formulario de Contacto</h3>
          <div class="hidden sm:block">
            <div class="py-5">
              <div class="border-t border-gray-200"></div>
            </div>
          </div>
          
          <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
              <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Datos Personales</h3>
              </div>
            </div>
            
            <div class="mt-5 md:mt-0 md:col-span-2">
              <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white sm:p-6">
                  <div class="grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                    
                        <!-- Sección de muestra de nombres. -->
                    <div class="sm:col-span-3">
                      <label
                        for="input_first_name"
                        class="block text-sm font-medium leading-5 text-gray-700"
                      >
                        Nombre(s) (*)
                      </label>
                      <div class="mt-1 rounded-md shadow-sm">
                        <input
                          placeholder="Ingrese sus nombres completos"
                          id="input_first_name"
                          v-model="first_name"
                          type="text"
                          
                          class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                        />
                      </div>
                      <small v-if="vacio_first_name" class="text-yellow-600">{{
                        vacio_first_name
                      }}</small>
                    </div>
                    <!-- Fin de sección de muestra de nombres. -->

                    <!-- Sección de ingreso de edad.
                    Solicita edad y la valida. -->
                    <div class="sm:col-span-3">
                      <label
                        for="input_age"
                        class="block text-sm font-medium leading-5 text-gray-700"
                      >
                        Edad (*)
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
                    <!-- Fin de sección de ingreso de edad. -->

                    

                    <!-- Sección de muestra de apellidos. -->
                    <div class="sm:col-span-3">
                      <label
                        for="input_last_name_p"
                        class="block text-sm font-medium leading-5 text-gray-700"
                      >
                        Apellido Paterno (*)
                      </label>
                      <div class="mt-1 rounded-md shadow-sm">
                        <input
                          placeholder="Ingrese su apellido paterno"
                          id="input_last_name_p"
                          v-model="last_name_p"

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
                        Apellido Materno (*)
                      </label>
                      <div class="mt-1 rounded-md shadow-sm">
                        <input
                          placeholder="Ingrese su apellido materno"
                          id="input_last_name_m"
                          v-model="last_name_m"
                          
                          class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                        />
                      </div>
                      <small v-if="vacio_last_name_m" class="text-yellow-600">{{
                        vacio_last_name_m
                      }}</small>
                    </div>
                    <!-- Fin de sección de muestra de apellidos. -->
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
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                  <h3 class="text-lg font-medium leading-6 text-gray-900">Datos del Servicio</h3>
                </div>
              </div>
              
              <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                  <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="min-h-screen grid grid-cols-1 row-gap-20 sm:row-gap-8 col-gap-6 sm:grid-cols-6">
                      
                      <!-- Sección de la dirección que se establecera. -->
                      <div class="sm:col-span-6 leading-5">
                        <div class="sm:col-span-2 mb-2">
                          <span class="block font-medium text-xs"
                          >Este servicio solo esta disponible en: <span class="text-xs sm:text-base">{{district}}</span>
                          </span>
                        </div>

                        <div class="sm:col-span-2 mb-4">
                          <label
                            for="input_addres_exactly"
                            class="text-sm font-medium leading-5 text-gray-700"
                          >
                            Dirección exacta (*)
                          </label>
                          <div class="mt-1 rounded-md">
                            <input
                              placeholder="Ingrese su dirección exacta"
                              id="input_addres_exactly"
                              v-model="addres_exactly"
                              class="form-input w-1/2 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            />
                          </div>
                          <small v-if="vacio_addres_exactly" class="text-yellow-600">{{
                            vacio_addres_exactly
                          }}</small>
                        </div>

                        <div class="sm:col-span-2 mb-1">
                          <label
                            for="input_addres_exactly"
                            class="text-sm font-medium leading-5 text-gray-700"
                          >
                            Dirección referencial (*)
                          </label>
                          <small v-if="vacio_addres" class="text-yellow-600">{{
                              vacio_addres
                          }}</small>
                        </div>

                        <!--Mapa iterativo para el usuario -->
                        <div style="height: 20rem" class="sm:col-span-2 px-1 sm:mb-4 mb-12">                        
                        <Maps 
                            :route="type"
                            :lati="lat"
                            :longi="lng"
                            @getCoordinates="setNewCoordinates"
                          />
                        </div>
                      </div>

                      <div class="sm:col-span-6 mt-5 hidden sm:block">
                          <div class="py-3">
                            <div class="border-t border-gray-200"></div>
                          </div>
                      </div>
                       
                      <div class="sm:col-span-6 grid grid-cols-1 row-gap-6 col-gap-6">
                        <!--Fin de la sección -->
                        <div class="sm:col-span-2">
                          <label
                            for="input_date"
                            class="block text-sm font-medium leading-5 text-gray-700"
                          >Fecha (*)</label>
                          <div class="mt-1 rounded-md shadow-sm">
                            <input
                              @change="validateDate"
                              id="input_date"
                              type="date"
                              v-model="date"
                              class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            />
                          </div>
                          <small v-if="error_date" class="text-red-600">{{
                            error_date
                          }}</small>
                          <small v-if="vacio_date" class="text-yellow-600">{{
                            vacio_date
                          }}</small>
                        </div>

                        <div class="sm:col-span-2">
                          <label
                            for="input_start_time"
                            class="block text-sm font-medium leading-5 text-gray-700"
                          >Hora mínima (*)</label>
                          <div class="mt-1 rounded-md shadow-sm">
                            <input
                              id="input_start_time"
                              type="time"
                              v-model="start_time"
                              class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            />
                          </div>
                          <small v-if="vacio_start" class="text-yellow-600">{{
                            vacio_start
                          }}</small>
                          <small v-if="error_start_time" class="text-red-600">{{
                            error_start_time
                          }}</small>
                        </div>

                        <div class="sm:col-span-2">
                          <label
                            for="input_end_time"
                            class="block text-sm font-medium leading-5 text-gray-700"
                          >Hora máxima (*)</label>
                          <div class="mt-1 rounded-md shadow-sm">
                            <input
                              id="input_end_time"
                              type="time"
                              v-model="end_time"
                              class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            />
                          </div>
                          <small v-if="vacio_end" class="text-yellow-600">{{
                            vacio_end
                          }}</small>
                          <small v-if="error_end_time" class="text-red-600">{{
                            error_end_time
                          }}</small>
                        </div>
                      
                        <div class="sm:col-span-6">
                          <label
                            for="input_message"
                            class="block text-sm font-medium leading-5 text-gray-700"
                          >Mensaje (*)</label>
                          <div class="mt-1 rounded-md shadow-sm">
                            <textarea
                              id="input_message"
                              v-model="message"
                              rows="4"
                              class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            ></textarea>
                          </div>
                          <small v-if="error_mensaje" class="text-red-600">{{
                            error_mensaje
                          }}</small>
                           <small v-if="vacio_mensaje" class="text-yellow-600">{{
                            vacio_mensaje
                          }}</small>
                          <div class="mt-1 text-xs leading-5">
                            <span class="font-medium"
                            >(*) Campo obligatorio para la validación del formulario</span>
                          </div>
                        </div>
                      </div>

                    </div>
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
            <div class="flex justify-end">
              <router-link to="/">
                <span class="inline-flex rounded-md shadow-sm">
                  <button
                    type="button"
                    class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                  >Cancelar</button>
                </span>
              </router-link>
              <span class="ml-3 inline-flex rounded-md shadow-sm">
                <MyButton
                  content="Contactar"
                  color="primary"
                  @onClick="submitForm()"
                  :isLoading="buttonLoading"
                ></MyButton>
              </span>
            </div>
          </div>
        </div>
      </main>
    </div>
  </Visitor>
</template>

<script>
import api from "../../api";

import Maps from "../../components/Maps";
import IconSvg from "../../components/IconSvg.vue";
import Visitor from "../Layouts/Visitor";
import MyButton from "../../components/MyButton.vue";

export default {
  name: "ServiceForm", //nombre del componente
  components: {
    Visitor,
    IconSvg,
    Maps,
    MyButton
  },
  data() {
    return {
      identity: '',
      id_provider: '',
      id_customer: '',
      hasError: false,
    
      buttonLoading: false,
      isType:'',
      type:'',

      age: '',
      department: '',
      province: '',
      district: '',
      first_name: '',
      last_name_p: '',
      last_name_m: '',
      lat: 0,
      lng: 0,
      new_lat: 0,
      new_lng: 0,
      addres_exactly: '',
      date: '',
      start_time: '',
      end_time: '',
      message: '',
      coti_personal: '',
      sumatotal: '',

      error_age: '',
      error_mensaje: '',
      error_date: '',
      error_start_time: '',
      error_end_time: '',

      vacio_age: '',
      vacio_first_name: '',
      vacio_last_name_m: '',
      vacio_last_name_p: '',
      vacio_addres: '',
      vacio_date: '',
      vacio_start: '',
      vacio_end: '',
      vacio_mensaje: '',
      vacio_addres_exactly: ''
    };
  },
  async created(){
    if(localStorage.getItem('exist_service') != null || localStorage.getItem('exist_service') != '')
    {
      this.coti_personal = JSON.parse(localStorage.getItem('request'));
      this.sumatotal = localStorage.getItem('suma');
      
      let response = await api.get(`/service_details/${localStorage.getItem('exist_service')}`)
      
      this.district = response.data.data.serv_details[0].distrito;
      this.identity = response.data.data.serv_details[0].identity;
      this.id_provider = response.data.data.serv_details[0].token;/*id del proveedor - receptor*/

      //Dibujo el rango en el mapa para una mejor guía
      this.type = 'Form1';
      this.isType = 'Gmap';

      //Inserto a mi objeto
      this.apidate = this.district.replace(/ /g, "+")

      //Se extrae las coordenadas centrales de la localización de donde se da el servicio
      let response2 = await api.get(`/validate/${this.isType}/${this.apidate}`)
          this.lat = response2.data.data[0].results[0].geometry.location.lat;
          this.lng = response2.data.data[0].results[0].geometry.location.lng;
    }
    else{this.$router.push("/")}
  },
  methods: {
    getCustomerIdForm(obj) {
      this.id_customer = obj.idCustomer;
    },
    setNewCoordinates(obj){
      this.new_lat = obj.lat;
      this.new_lng = obj.lng;
    },
    async submitForm() {
      this.validateSubmit();
      if (this.hasError) return;
      this.buttonLoading = true;
      
      let response4 = await api.post(`/request`, {
        id_provider: this.id_provider,
        id_service: localStorage.getItem('exist_service'),
        identity: this.identity,
        lati: this.new_lat,
        longi: this.new_lng,
        exactly: this.addres_exactly,
        id_customer: this.id_customer,
        name: this.first_name,
        last_name_p: this.last_name_p,
        last_name_m: this.last_name_m,
        age: this.age,
        date: this.date.split('-').reverse().join('/'),
        timemin: this.start_time,
        timemax: this.end_time,
        message: this.message,
        coti_personal: this.coti_personal,
        suma: this.sumatotal
      });
      
      if (!response4.ok) {
        this.buttonLoading = false;
        
        return this.$toast.open({
          message: response4.error.errors.fail[0],
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      this.$toast.open({
        message: response4.data.data.success,
        type: "success",
        duration: 8000,
        dismissible: true
      });

      localStorage.removeItem('exist_service');
      localStorage.removeItem('request');
      localStorage.removeItem('suma');

      this.$router.push("/");
    },
    validateDate(){
      //Ambas fechas estan para capturar la hora estandar peruana
      var date_act = new Date(this.date.replace(/-/g, '\/')); //Convierto mi valor en la fecha exacta elegida
      var hoy = new Date();//Recogo la fecha actual de Peru
      
      if(date_act < hoy.setHours(0,0,0,0)){
        this.hasError = true;
        this.error_date = "La fecha elegida ya expiró";
        this.vacio_date = "";
      }
      else if (date_act > hoy.setHours(0,0,0,0)){
        this.hasError = false;
        this.error_date = "";
        this.vacio_date = "";
      } 
      else{
        this.hasError = true;
        this.error_date = "El servicio esta disponible 24 h después de su elección";
        this.vacio_date = "";
      }
    },
    validateSubmit() {
      if(this.hasError == true) this.hasError = true;
        else this.hasError = false; 

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
      
      //Comprobacion de direccion
      if (this.new_lat == null || this.new_lat == '') {
        this.hasError = true;
        this.vacio_addres = "Campo necesario";
      } else this.vacio_addres = ""; 

      //Comprobacion de fecha
      if (this.date == "") {
        this.hasError = true;
        this.vacio_date = "Campo necesario";
        this.error_date = "";
      }

      //Comprobacion de horario inicial
      if (this.start_time == "") {
        this.hasError = true;
        this.vacio_start = "Campo necesario";
        this.error_start_time = "";
      } 
      else if(this.start_time < "09:00"){
        this.hasError = true;
        this.error_start_time = "El horario de atención es apartir de las 9 AM";
        this.vacio_start = "";
      }
      else{
        this.error_start_time = "";
        this.vacio_start = "";
      }

      //Comprobacion de horario final
      if (this.end_time == "") {
        this.hasError = true;
        this.vacio_end = "Campo necesario";
        this.error_end_time = "";
      } 
      else if(this.end_time > "20:00"){
        this.hasError = true;
        this.vacio_end = "";
        this.error_end_time = "El horario de atención finaliza de las 8 PM";
      }
      else{
        this.vacio_end = "";
        this.error_end_time = "";
      }

      //Validación del mensaje
      if (this.message == "") {
        this.hasError = true;
        this.error_mensaje = "";
        this.vacio_mensaje = "Campo necesario";
      } else if (this.message.length > 10000) {
        this.hasError = true;
        this.error_mensaje = "Mensaje demasiado largo";
        this.vacio_mensaje = "";
      } else{
        this.error_mensaje = "";
        this.vacio_mensaje = "";
      }

      //Comprobacion de la dirección exacta
      if (this.addres_exactly == "") {
        this.hasError = true;
        this.vacio_addres_exactly = "Campo necesario";
      } else this.vacio_addres_exactly = "";
    },
  },
};
</script>