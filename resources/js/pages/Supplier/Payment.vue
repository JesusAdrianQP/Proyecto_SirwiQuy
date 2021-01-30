<template>
  <Visitor>
    <Loader class="min-h-screen"
            :load="loading"
      />

    <div v-show="!loading" class="bg-gray-100 min-h-screen pb-6">
      <div class="max-w-6xl mx-auto py-8">
        <div class="text-center my-4 font-bold">
          <h1 class="text-2xl">MÉTODO DE PAGO</h1>
        </div>
        <div class="px-4 grid grid-cols-2 gap-6">
          <div
            class="col-span-2 sm:col-span-1 bg-white overflow-hidden shadow rounded-lg sm:mr-2"
          >
            <div class="px-4 py-5 sm:p-4 text-left">
              <div>
                <p class="text-lg leading-5 font-semibold text-gray-700">
                  Datos del pago
                </p>
                <h3 v-if="identity=='employee'" class="font-semibold mt-3">Nombre</h3>
                <p v-if="identity=='employee'" class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >{{name}}</span
                  >
                </p>
                
                <h3 v-if="identity!='employee'" class="font-semibold mt-3">Razón Social</h3>
                <p v-if="identity!='employee'" class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >{{razonsocial}}</span
                  >
                </p>
                
                <h3 v-if="identity=='employee'" class="font-semibold mt-2">Apellidos</h3>
                <p v-if="identity=='employee'" class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >{{lastnamep}} {{lastnamem}}</span
                  >
                </p>

                <h3 class="font-semibold mt-2">Servicio</h3>
                <p class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >{{title}}</span
                  >
                </p>

                <h3 class="font-semibold mt-2">Dirección exacta</h3>
                <p class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >{{distrito}} - {{address}}</span
                  >
                </p>
                
                <h3 class="font-semibold mt-2">Fecha de la cita</h3>
                <p class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >{{date}}</span
                  >
                </p>

                <h3 class="font-semibold mt-2">Hora de inicio / Hora de fin:</h3>
                <p class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >{{timemini}} a {{timemax}}</span
                  >
                </p>

                <h3 class="font-semibold mt-2">Cuenta a pagar:</h3>
                <p class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >{{account}}</span
                  >
                </p>

                <h3 class="font-semibold mt-2">Total a pagar:</h3>
                <p class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >SOL {{paymentTotal.toFixed(2)}}</span
                  >
                </p>

                <h3 class="font-semibold mt-2">Total a pagar (USD):</h3>
                <p class="sm:text-justify">
                  <span
                    style="
                      white-space: pre-wrap;
                      word-wrap: break-word;
                      font-family: inherit;
                    "
                    >USD {{(paymentTotal / 3.64).toFixed(2)}}</span
                  >
                </p>

                <div class="flex items-center my-2 mt-4">
                  <input
                    id="terms"
                    type="checkbox"
                    value="terms"
                    disabled
                    v-model="isSelect1"
                    class="form-checkbox h-4 w-4 text-primary-500 transition duration-150 ease-in-out"
                  />
                  <label
                    for="terms"
                    class="ml-2 block text-sm leading-5 text-gray-900"
                  >
                    Acepto los términos y condiciones de uso del servicio SirwiyQuy.
                  </label>
                </div>
                <div class="flex items-center">
                  <input
                    id="policy"
                    type="checkbox"
                    value="policy"
                    disabled
                    v-model="isSelect2"
                    class="form-checkbox h-4 w-4 text-primary-500 transition duration-150 ease-in-out"
                  />
                  <label
                    for="policy"
                    class="ml-2 block text-sm leading-5 text-gray-900"
                  >
                    Acepto las politicas del servicio SirwiyQuy.
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div
            class="col-span-2 sm:col-span-1 mt-4 sm:mt-0"
          >
            <div class="bg-white overflow-hidden shadow rounded-lg">
              <div class="px-4 py-5 sm:p-6">
                <p class="text-lg leading-5 font-semibold text-gray-700">
                  Realizar Pago
                </p>

                <div class="px-2 mt-6">
                  <div id="paypal-button-container"></div>
                </div>
              </div>
            </div>

            <div class="mt-8">
              <div class="w-full flex justify-center items-center">
                <img src="../../../assets/illustrations/paypal.png" alt="paypal" style="height: 20rem">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Visitor>
</template>


<script>
import api from "../../api";

import Loader from "../../components/Loader";
import Visitor from "../Layouts/Visitor";
import IconSvg from "../../components/IconSvg";

export default {
  name: "Payment",
  components: {
    Visitor,
    IconSvg,
    Loader
  },
  data: () => {
    return {
      isSelect1: 'terms',
      isSelect2: 'policy',
      emailCusto: '',
      emailProv: '',
      response_id: '',
      loading: true,

      identity: '',

      name: '',
      lastnamem: '',
      lastnamep: '',
      razonsocial: '',
      title: '',
      distrito: '',
      address: '',
      date: '',
      timemini: 0,
      timemax: 0,
      account: '',
      paymentTotal: 0,
      paypalDolar: 0,

      response: '',
      service: '',
      supplier: '',
      customer: '',
    };
  },
  props: {
    id_link: String,
    id_response: String
  },
  async created() {
    this.loading = true;

    localStorage.setItem('e_link', this.id_link);
    localStorage.setItem('e_response', this.id_response);

    if(localStorage.getItem('e_level') !== 'supplier') 
    {
      this.$toast.open({
        message: "Inicie sesión para consultar por el pago...",
        type: "info",
        duration: 8000,
        dismissible: true,
      });
    
      localStorage.setItem('e_bandera', 'bandera');
      this.$router.push("/login/supplier");
      return;
    }

    let response = await api.get(`/paypal/${localStorage.getItem('e_link')}/${localStorage.getItem('e_response')}`)

    if(!response.ok)
    { 
      this.$toast.open({
        message: "Enlace caducado...",
        type: "error",
        duration: 8000,
        dismissible: true,
      });

      localStorage.setItem('e_bandera2', 'bandera2');

      localStorage.removeItem('e_response');
      localStorage.removeItem('e_link');
      this.$router.push("/"); 
      return;
    }
    
    // this.customer = response.data.data.customer;
    this.service = response.data.data.service;
    this.supplier = response.data.data.supplier;
    this.response = response.data.data.response;

    if(this.supplier.access != localStorage.getItem('token'))
    {
      this.$toast.open({
        message: "Enlace no válido para su usuario...",
        type: "error",
        duration: 8000,
        dismissible: true,
      });

      localStorage.setItem('e_bandera2', 'bandera2');

      localStorage.removeItem('e_response');
      localStorage.removeItem('e_link');
      this.$router.push("/"); 
      return;
    }

    this.emailProv = this.supplier.email;
    this.emailCusto = this.customer.email;

    this.response_id = this.response._id
    this.title = this.service.title;
    this.distrito = this.service.distrito;
    
    this.identity = this.response.identity;
    if(this.identity == 'employee')
    {
      this.name = this.supplier.name;
      this.lastnamep = this.supplier.lastnamep;
      this.lastnamem = this.supplier.lastnamem;
      this.account = this.supplier.cuenta;
    }
    else
    {
      this.razonsocial = this.supplier.name_enterprise;
      this.account = this.supplier.cuenta_enterprise;
    }

    this.address = this.response.addres;
    this.date = this.response.date;
    this.timemini = this.response.timemin;
    this.timemax = this.response.timemax;
    this.paymentTotal = this.response.sumaTotal;
    this.paypalDolar = (this.paymentTotal / 3.64).toFixed(2);

    this.loading = false;
  },
  async mounted(){
    if(localStorage.getItem('e_bandera') == 'bandera' ||
        localStorage.getItem('e_bandera2') == 'bandera2')
    {
      localStorage.removeItem('e_bandera2');
      return;
    }

    window.paypal.Buttons({
      createOrder: (data, actions) => {
        /**Funcion que realiza el envio de los datos a pagar */
        return actions.order.create({
          purchase_units: [{
            description: this.title,
            amount: {
              currency_code: "USD",
              value: this.paypalDolar
            }
          }]
        });
      },
      onApprove: async (data, actions, resp) => {
        const order = await actions.order.capture();
        this.data;
        this.paidFor = true;
        this.loading = false;
        this.UpdateStatus();
        /**Funcion que recupera datos - Posible reporte de transaccion */
      },
      onError: err => {
        console.log(err);
      }
    })
    .render('#paypal-button-container');
  },
  methods:{
    async UpdateStatus(){
      let response = await api.post(`/updatestatus`, {
        typeNot: 'response',
        id: this.response_id,
        status: 'Pendiente',
        email1: this.emailProv,
        email2: this.emailCusto,
        pay: this.paymentTotal
      })

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
        message: "Pago Exitoso - " + response.data.data.success[0],
        type: "success",
        duration: 8000,
        dismissible: true
      });

      localStorage.removeItem('e_response');
      localStorage.removeItem('e_link');
      
      this.$router.push("/");
    }
  }
};
</script>