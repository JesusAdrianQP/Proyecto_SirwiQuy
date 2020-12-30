<template>
  <!--NOTIFICATION DETAILS: Se observa la notificación seleccionada con sus datos correspondientes
  y el mapa de google maps señalando la ubicación exacta-->
  <SideBar title="Detalles de la notificación">
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
      <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
          <strong>Servicio:</strong>
          {{title}}
        </h3>

        <dl class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2">
          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Categoría: {{category}}</dd>
          </div>
        </dl>
      </div>

      <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg mb-4 leading-6 font-medium text-gray-900">
          <strong>Datos del cliente</strong>
        </h3>

        <dl class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2">
          <div class="sm:col-span-2">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Mensaje enviado por el solicitante</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{username}}</dt>
          </div>

          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">DNI</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{DNI}}</dt>
          </div>

          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Edad</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{age}}</dt>
          </div>

          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Nombre(s)</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{name}}</dt>
          </div>

          <div class="hidden sm:block sm sm:col-span-1"></div>

          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Apellido paterno</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{lastnamep}}</dt>
          </div>

          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Apellido materno</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{lastnamem}}</dt>
          </div>
        </dl>
        
        <div class="h-px w-full bg-gray-200 mt-4 sm:mt-8"></div>

        <h3 class="text-lg my-4 leading-6 font-medium text-gray-900">
          <strong>Datos del servicio</strong>
        </h3>

        <dl class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-3">
          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Distrito</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{distrito}}</dt>
          </div> 

          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Dirección exacta</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{adress}}</dt>
          </div>
         
          <div class="sm:col-span-3">
            <div>
              <dd class="mt-1 text-sm leading-5 text-blue-500">La siguiente ubicación es una referencia respecto del rango de su dirección</dd>
            </div>
            
            <div id="map" style="height: 20rem">
              <!--Mapa iterativo para el usuario -->
              <Maps 
                :route="type"
                :lati="lat"
                :longi="lng"
              />
            </div>
          </div>

          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Fecha</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{date}}</dt>
          </div>

          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Hora mínima (HH:MM)</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{timemin}}</dt>
          </div>

          <div class="sm:col-span-1">
            <dd class="mt-1 text-sm leading-5 text-gray-900">Hora máxima (HH:MM)</dd>
            <dt class="text-base leading-5 font-medium text-gray-500">{{timemax}}</dt>
          </div>

          <div class="sm:col-span-3">
            <dt class="text-sm leading-5 font-medium text-gray-500">Mensaje</dt>
            <dd class="mt-1 text-base leading-5 text-gray-900">{{message}}</dd>
          </div>

          <div class="sm:col-span-1">
            <dd
              @click="quotationOpen=true"
              class="mt-1 text-sm leading-5 text-primary-500 hover:text-primary-700 hover:underline cursor-pointer"
            >Ver detalle de cotización</dd>
          </div>
        </dl>
        
        <div
          v-show="quotationOpen"
          class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
        >
          <div @click="quotationOpen = false" class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <div
            class="relative bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full sm:p-6"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-headline"
          >
            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
              <button
                @click="quotationOpen = false"
                type="button"
                class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
                aria-label="Close"
              >
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
            <div class="sm:flex sm:items-start">
              <h3
                class="text-lg leading-6 font-medium text-gray-900"
                id="modal-headline"
              >Detalle de cotización</h3>
            </div>
            <div class="mt-4">
              <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                  class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200"
                >
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                      <tr>
                        <th
                          class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >Material</th>
                        <th
                          class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >Cantidad</th>
                        <th
                          class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider"
                        >Total</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="cotizacion in coti_personal" :key="cotizacion.index">
                        <td
                          class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900"
                        >{{cotizacion.name}}</td>
                        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                        >{{cotizacion.cant}}
                        </td>
                        <td
                          class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500"
                        >S/ {{cotizacion.price.toFixed(2)}}</td>
                      </tr>
                      <!-- More rows... -->
                    </tbody>
                  </table>

                  <div class="px-4 py-3 text-xs leading-5">
                    <span class="font-medium text-green-500"
                    >Se agrega S/ {{workforce.toFixed(2)}} al total de su lista por la mano de obra.</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
              <span class="text-base leading-5 font-medium text-gray-900 ml-2">S/ {{sumtotal.toFixed(2)}}</span>
              <span class="text-base leading-5 text-gray-800">TOTAL:</span>
            </div>
          </div>
        </div>

        <div
          v-show="confirmOpen"
          class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
        >
          <div @click="confirmOpen = false" class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <div
            class="relative bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full sm:p-6"
            role="dialog"
            aria-modal="true"
            aria-labelledby="modal-headline"
          >
            <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
              <button
                @click="confirmOpen = false"
                type="button"
                class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
                aria-label="Close"
              >
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>

            <div class="mt-4">
              <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8"></div>
            </div>

            <div v-show="showSelectWorker" class="my-4">
              <label
                for="selectWorker"
                class="block text-sm leading-5 font-medium text-gray-700"
              >Seleccionar Trabajador</label>
              <select
                id="selectWorker"
                v-model="employee"
                class="mt-1 form-select block w-full pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
              >
                <option selected="" disabled="" value="">Trabajador</option>
                <option v-for="employee in subemployee" v-bind:key="employee.id">{{employee.name}} {{employee.lastnamep}} {{employee.lastnamem}}</option>
              </select>
              <small v-if="vacio" class="text-yellow-600">{{
                      vacio
              }}</small>
            </div>

            <div class="flex items-center">
              <input
                id="remember_me"
                v-model="Select1"
                @click="Select1 = true"
                type="checkbox"
                class="form-checkbox h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
              />
              <label
                for="remember_me"
                class="ml-2 block text-sm leading-5 text-gray-900"
              >Acepto los términos y condiciones de uso del servicio SirwiQuy.</label>
            </div>

            <div class="flex items-center mt-2">
              <input
                id="remember_me2"
                v-model="Select2"
                @click="Select2 = true"
                type="checkbox"
                class="form-checkbox h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
              />
              <label
                for="remember_me2"
                class="ml-2 block text-sm leading-5 text-gray-900"
              >Acepto las politicas del servicio SirwiQuy.</label>
            </div>
            
            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
              
              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button
                  @click="SubmitAcept()"
                  type="button"
                  :disabled="Select1 == true && Select2 == true ? false : true"
                  class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                >Aceptar contrato</button>
              </span>
              
              <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <button
                  @click="SubmitDeny()"
                  type="button"
                  class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                >No aceptar contrato</button>
              </span>
            </div>
          </div>
        </div>

        <div class="text-center mt-4">
          <span class="inline-flex rounded-md shadow-sm">
            <MyButton
              content="Dar respuesta"
              color="primary"
              @onClick="validate()"
              :isLoading="buttonLoading"
            ></MyButton>
          </span>
        </div>
      </div>
    </div>
  </SideBar>
</template>

<script>
import api from "../../api";

import Maps from "../../components/Maps.vue"
import SideBar from "../../components/SideBar";
import MyButton from "../../components/MyButton.vue";

export default {
  name: "NotificationDetails",
  components: {
    SideBar,
    Maps,
    MyButton,
  },
  data: () => {
    return {
      quotationOpen: false,
      confirmOpen: false,
      buttonLoading: false,
      type: '',
      showSelectWorker: false, //si debe mostrar el selector de trabajadores
      showWorker: localStorage.getItem('e_level'),
      Select1: false,
      Select2: false,

      subemployee: [],
      request: [],
      service: [],
      customer: [],

      vacio: '',
      employee: '',

      id_service:'',
      title: '',
      category: '',
      distrito: '',

      id_customer: '',
      username: '',
      
      coti_personal: [],
      workforce: 0,
      sumtotal: 0,
 
      DNI: '',
      name: '',
      lastnamep: '',
      lastnamem: '',
      age: '',
      adress: '',
      date: '',
      timemin: '',
      timemax: '',
      message: '',
      lat: 0,
      lng: 0,
      status: '',
      fecharequest: '',
      fechaact: ''
    }
  },
  props: {
    notification_id: String
  },
  async created() {
    //Traigo la información necesaria de mi solicitud
    let response = await api.get(`/notifications/${this.notification_id}`)
    this.request = response.data.data.request_details;
    this.service = response.data.data.service_details.original.serv_details;
    this.customer = response.data.data.customer_details;

    this.id_service = this.service._id;
    this.title = this.service.title;
    this.category = this.service.category;
    this.distrito = this.service.distrito;

    this.id_customer = this.customer._id;
    this.username = this.customer.username;

    this.DNI = this.request.DNI;
    this.age = this.request.age;
    this.name = this.request.name;
    this.lastnamep = this.request.lastnamep;
    this.lastnamem = this.request.lastnamem;
    this.date = this.request.date;
    this.timemin = this.request.timemin;
    this.timemax = this.request.timemax;
    this.message = this.request.message;
    this.coti_personal = this.request.cotizacion_personal;
    this.workforce = this.request.worforce;
    this.type = 'Form3';
    this.lat = this.request.new_lat;
    this.lng = this.request.new_lng;
    this.adress = this.request.addres;
    this.status = this.request.status;

    
    this.fechaact = this.request.created_at;
    var fecha = this.fechaact.slice(0,-9).split('-').reverse().join('/');
    this.fecharequest = fecha;

    this.suma();

    if(this.showWorker == 'enterprise')
    { 
      let response2 = await api.get(`/subemployee/list/simple&1/${localStorage.getItem('e_id')}`)
      this.subemployee = response2.data.data.subemployees;
      this.showSelectWorker = true;
    }
  },
  methods:{
    suma(){
      if(this.coti_personal.length == 0) this.sumtotal = this.workforce;
        else{
          for(var i = 0; i < this.coti_personal.length; i++)
          {
            this.sumtotal = this.sumtotal + (this.coti_personal[i].price * parseInt(this.coti_personal[i].cant));
          }

          this.sumtotal = this.sumtotal + this.workforce;
        }
    },
    async SubmitAcept(){
      if(this.showWorker == 'enterprise'){
        this.validateSubmit();
        if (this.hasError) return;
      }

      this.confirmOpen = false;
      this.buttonLoading = true;
      //Respondo actualizando estado
      this.Response();
      //Envio correo positivo si acepto solicitud
      let response3 = await api.post(`/mail_acept`, {
        employee: this.employee,
        id_service: this.id_service,
        id_customer: this.id_customer,
        fecharequest: this.fecharequest,
        DNI: this.DNI,
        age: this.age,
        name: this.name,
        lastnamep: this.lastnamep,
        lastnamem: this.lastnamem,
        date: this.date,
        timemin: this.timemin,
        timemax: this.timemax,
        message: this.message,
        cotizacion: this.coti_personal,
        work: this.workforce,
        lat: this.lat,
        lng: this.lng,    
        adress: this.adress,
        suma: this.sumtotal
      })
      
      //Si existe errores
      if (!response3.ok) {
        this.buttonLoading = false;

        let er = response3.error.errors;
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

      //Redireccionamiento de rutas
      this.$router.push("/supplier/notifications");

      //Si se envia correo con exito
      this.$toast.open({
        message: response3.data.data.success[0],
        type: "info",
        duration: 10000,
        dismissible: true,
      });
    },
    async SubmitDeny(){
      this.confirmOpen = false;
      this.buttonLoading = true;
      //Respondo actualizando estado
      this.Response();
      //Envio correo negativo si rechazo solicitud
      let response2 = await api.post(`/mail_deny`, {
        id_service: this.id_service,
        fecharequest: this.fecharequest,
        id_customer: this.id_customer
      })

      //Redireccionamiento de rutas
      this.$router.push("/supplier/notifications");

      //Si se envia correo con exito
      this.$toast.open({
        message: 'Correo enviado con éxito.',
        type: "info",
        duration: 10000,
        dismissible: true,
      });
    },
    async Response(){
      let response = await api.post(`/updatestatus`, {
        is: "request",
        id: this.notification_id,
        status: 'Respondido',
      })

      //Si existe errores en la actualización de datos - no se comunica con la data
      if (!response.ok) {
        this.buttonLoading = false;

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
    },
    validate(){
      if(this.status == 'No respondido') this.confirmOpen = true;
        else this.confirmOpen = false;
    },
    validateSubmit(){
      this.hasError = false;

      //Comprobacion de trabajador
      if (this.employee_sub == "") {
        this.hasError = true;
        this.vacio = "Campo necesario";
      } else this.vacio = "";
    }
  }
};
</script>