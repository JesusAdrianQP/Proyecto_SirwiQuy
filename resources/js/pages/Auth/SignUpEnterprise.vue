<template>
  <!-- SING UP ENTERPRISE: Vista de registro del usuario empresa-->
  <Visitor>
    <main class="flex flex-col justify-center pt-2 pb-4 bg-gray-100">
      <div class="md:text-center md:flex-col md:flex md:justify-center md:items-center">
         
          <img class="h-48 sm:h-56 lg:h-48 px-6 w-auto mt-4" src="../../../assets/illustrations/sign-up-enterprise.png" alt="avatar" />
          
          <p class="uppercase px-5 mt-4 text-3xl md:text-4xl font-extrabold text-gray-900"
          >Crear cuenta </p>
        
          <p class="px-5 text-sm">Esta cuenta sera creada para un usuario de tipo <b class="text-base2 italic">{{identifier}}</b></p>
      </div>

      <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-2xll">
        <nav class="mx-3 sm:mx-6">
          <ul class="bg-white shadow rounded-md divide-y divide-gray-300 md:flex md:divide-y-0">
            <li @click="step=0" class="group cursor-pointer relative md:flex-1 md:flex">
              <!-- Completed Step -->
              <div class="px-6 py-4 flex items-center text-sm leading-5 font-medium space-x-4">
                <div
                  class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 rounded-full"
                  :class="step==0?'border-primary-600' : 'border-gray-300  group-hover:border-gray-400' "
                >
                  <p
                    :class="step==0?'text-primary-600' : 'text-gray-500  group-hover:text-gray-900' "
                  >01</p>
                </div>
                <p
                  class="text-sm leading-5 font-medium"
                  :class="step==0?'text-primary-600' : 'text-gray-500  group-hover:text-gray-900' "
                >Datos de la empresa</p>
              </div>

              <div class="hidden md:block absolute top-0 right-0 h-full w-5">
                <svg
                  class="h-full w-full text-gray-500"
                  viewBox="0 0 22 80"
                  fill="none"
                  preserveAspectRatio="none"
                >
                  <path
                    d="M0 -2L20 40L0 82"
                    vector-effect="non-scaling-stroke"
                    stroke="currentcolor"
                    stroke-linejoin="round"
                  />
                </svg>
              </div>
            </li>

            <li @click="step=1" class="group cursor-pointer relative md:flex-1 md:flex">
              <!-- Completed Step -->

              <div class="px-6 py-4 flex items-center text-sm leading-5 font-medium space-x-4">
                <div
                  class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 rounded-full"
                  :class="step==1?'border-primary-600' : 'border-gray-300  group-hover:border-gray-400' "
                >
                  <p
                    :class="step==1?'text-primary-600' : 'text-gray-500  group-hover:text-gray-900' "
                  >02</p>
                </div>
                <p
                  class="text-sm leading-5 font-medium"
                  :class="step==1?'text-primary-600' : 'text-gray-500  group-hover:text-gray-900' "
                >Datos del administrador</p>
              </div>

              <div class="hidden md:block absolute top-0 right-0 h-full w-5">
                <svg
                  class="h-full w-full text-gray-500"
                  viewBox="0 0 22 80"
                  fill="none"
                  preserveAspectRatio="none"
                >
                  <path
                    d="M0 -2L20 40L0 82"
                    vector-effect="non-scaling-stroke"
                    stroke="currentcolor"
                    stroke-linejoin="round"
                  />
                </svg>
              </div>
            </li>

            <li @click="step=2" class="group cursor-pointer relative md:flex-1 md:flex">
              <!-- Completed Step -->

              <div class="px-6 py-4 flex items-center text-sm leading-5 font-medium space-x-4">
                <div
                  class="flex-shrink-0 w-10 h-10 flex items-center justify-center border-2 rounded-full"
                  :class="step==2?'border-primary-600' : 'border-gray-300  group-hover:border-gray-400' "
                >
                  <p
                    :class="step==2?'text-primary-600' : 'text-gray-500  group-hover:text-gray-900' "
                  >03</p>
                </div>
                <p
                  class="text-sm leading-5 font-medium"
                  :class="step==2?'text-primary-600' : 'text-gray-500  group-hover:text-gray-900' "
                >Datos de la cuenta</p>
              </div>
            </li>
          </ul>
        </nav>

        <div class="pt-5 pb-4 mx-3 sm:mx-6 px-1 sm:px-8 mt-4 mb-4 bg-white shadow rounded-lg  sm:mb-6 md:mb-8">
          <div v-show="step==0">
            <div class="mx-5 sm:mx-1 grid grid-cols-1 row-gap-5 col-gap-8 sm:grid-cols-4">
              <!-- Sección de ingreso de RUC.
              Solicita el RUC y lo valida.-->
              <div class="sm:col-span-2">
                <label for="rucDoc" class="block text-sm font-medium leading-5 text-gray-700">RUC</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <input
                    placeholder="Ingrese su RUC"
                    type="text"
                    id="rucDoc"
                    v-model="ruc"
                    inputmode="numeric"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                    maxlength="11"
                    pattern="[0-9]*"
                    @change="validateRUC"
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                  <div
                    class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                  >
                    <IconSvg
                      v-show="!ruc_valid"
                      solid="solid"
                      icon="exclamation-circle"
                      myClass="h-5 w-5 text-red-500"
                    />
                    <IconSvg
                      v-show="ruc_valid"
                      solid="solid"
                      icon="check-circle"
                      myClass="h-5 w-5 text-green-500"
                    />
                  </div>
                </div>
                <small v-if="error_ruc" class="text-red-600">
                  {{
                  error_ruc
                  }}
                </small>
                <small v-if="vacio_ruc" class="text-yellow-600">
                  {{
                  vacio_ruc
                  }}
                </small>
              </div>

              <div class="sm:col-span-2">
                <label
                  for="cardnumber"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >Cuenta interbancaria (CCI)</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <input
                    placeholder="Digite su N° de Cuenta"
                    id="cardnumber"
                    type="text"
                    pattern="[0-9]*"
                    maxlength="23"
                    inputmode="numeric"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                    v-model="cardNumber"
                    @change="validateCardNumber()"
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                  <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg id="ccicon" class="ccicon h-8" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    </svg>
                  </div>
                </div>
                <small v-if="vacio_cardNumber" class="text-yellow-600">
                  {{
                  vacio_cardNumber
                  }}
                </small>
                 <small v-if="error_cardNumber" class="text-red-600">
                  {{
                  error_cardNumber
                  }}
                </small>
              </div>

              <div class="sm:col-span-4">
                <label
                  for="input_name_enterprise"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >Razón social</label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input
                    disabled="disabled"
                    id="input_name_enterprise"
                    type="text"
                    v-model="name_enterprise"
                    class="bg-gray-100 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
              </div>

              <div class="sm:col-span-4">
                <label
                  class="block text-sm leading-5 font-medium text-gray-700"
                >Imagen de la empresa</label>
                <div class="w-full sm:flex">
                  <div class="flex items-center sm:w-1/4">
                    <div class="mt-2" v-if="!file_enterprise">
                      <label
                        for="file_enterprise"
                        style="cursor: pointer"
                        class="w-full py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-center text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                      >Seleccionar imagen</label>

                      <span class="file_enterprise">
                        <input
                          id="file_enterprise"
                          type="file"
                          style="display:none;"
                          accept=".png,.jpeg,.jpg"
                          @change="onFileChange($event, 'file_enterprise')"
                        />
                      </span>
                    </div>

                    <div class="flex items-center w-full mt-1" v-else>
                      <button
                        @click="removeImage($event, 'file_enterprise')"
                        class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                      >Eliminar imagen</button>
                    </div>
                  </div>

                  <div class="mt-3 sm:mt-4 sm:w-3/4" v-if="file_enterprise">
                    <img
                      :src="file_enterprise"
                      class="object-cover inline-block h-28 w-28 sm:h-40 sm:w-40 rounded-full"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-show="step==1">
            <div class="mx-5 sm:mx-1 grid grid-cols-1 row-gap-5 col-gap-8 sm:grid-cols-4">
              <!-- Sección de ingreso de DNI.
              Solicita el DNI y lo valida.-->
              <div class="sm:col-span-2">
                <label for="input_dni" class="block text-sm font-medium leading-5 text-gray-700">DNI</label>
                <div class="mt-1 relative rounded-md shadow-sm">
                  <input
                    placeholder="Ingrese su DNI"
                    id="input_dni"
                    v-model="dni"
                    type="text"
                    inputmode="numeric"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                    maxlength="8"
                    pattern="[0-9]*"
                    @change="validateDNI"
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                  <div
                    class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none"
                  >
                    <IconSvg
                      v-show="!dni_valid"
                      solid="solid"
                      icon="exclamation-circle"
                      myClass="h-5 w-5 text-red-500"
                    />
                    <IconSvg
                      v-show="dni_valid"
                      solid="solid"
                      icon="check-circle"
                      myClass="h-5 w-5 text-green-500"
                    />
                  </div>
                </div>
                <small v-if="error_dni" class="text-red-600">
                  {{
                  error_dni
                  }}
                </small>
                <small v-if="vacio_dni" class="text-yellow-600">
                  {{
                  vacio_dni
                  }}
                </small>
              </div>

              <div class="sm:col-span-2">
                <label
                  for="input_name_admi"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >Nombre(s)</label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input
                    disabled="disabled"
                    id="input_name_admi"
                    v-model="name_admi"
                    type="text"
                    class="bg-gray-100 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
              </div>

              <div class="sm:col-span-2">
                <label
                  for="input_lastnamep_admi"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >Apellido Paterno</label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input
                    disabled="disabled"
                    id="input_lastnamep_admi"
                    v-model="lastnamep_admi"
                    class="bg-gray-100  form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
              </div>

              <div class="sm:col-span-2">
                <label
                  for="input_lastnamem_admi"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >Apellido Materno</label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input
                    disabled="disabled"
                    id="input_lastnamem_admi"
                    v-model="lastnamem_admi"
                    class="bg-gray-100 form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
              </div>

              <div class="sm:col-span-4">
                <label
                  for="photo"
                  class="block text-sm leading-5 font-medium text-gray-700"
                >Foto de Perfil</label>
                <div class="w-full sm:flex">
                  <div class="flex items-center sm:w-1/4">
                    <div class="mt-2" v-if="!file_admi">
                      <label
                        for="file_admi"
                        style="cursor: pointer"
                        class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-center text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                      >Seleccionar imagen</label>

                      <span class="file_admi">
                        <input
                          id="file_admi"
                          type="file"
                          style="display:none;"
                          accept="image/png, .jpeg, .jpg"
                          @change="onFileChange($event,'file_admi')"
                        />
                      </span>
                    </div>

                    <div class="flex items-center w-full mt-1" v-else>
                      <button
                        @click="removeImage($event,'file_admi')"
                        class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                      >Eliminar imagen</button>
                    </div>                  
                  </div>

                  <div class="mt-3 sm:mt-4 sm:w-3/4" v-if="file_admi">
                    <img
                      :src="file_admi"
                      class="object-cover inline-block h-28 w-28 sm:h-40 sm:w-40 rounded-full"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-show="step==2">
            <div class="mx-5 sm:mx-1 grid grid-cols-1 row-gap-5 col-gap-8 sm:grid-cols-4">
              <div class="sm:col-span-2">
                <label
                  for="username"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >Usuario</label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input
                    id="username"
                    v-model="username"
                    placeholder="Ingrese un nombre de usuario"
                    type="text"
                    required
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
                <small v-if="error_username" class="text-red-600">
                  {{
                  error_username
                  }}
                </small>
                <small v-if="vacio_username" class="text-yellow-600">
                  {{
                  vacio_username
                  }}
                </small>
              </div>
              <!-- Fin de sección de ingreso de usuario. -->

              <!-- Sección de ingreso de correo.
              Solicita un correo electrónico y lo valida.-->
              <div class="sm:col-span-2">
                <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Correo</label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input
                    id="email"
                    v-model="email"
                    placeholder="Ingrese un correo electronico"
                    type="email"
                    required
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
                <small v-if="error_email" class="text-red-600">
                  {{
                  error_email
                  }}
                </small>
                <small v-if="vacio_email" class="text-yellow-600">
                  {{
                  vacio_email
                  }}
                </small>
              </div>
              <!-- Fin de sección de ingreso de correo. -->

              <!-- Sección de ingreso de contraseña.
              Solicita una contraseña y la valida.-->
              <div class="sm:col-span-2">
                <label
                  for="password"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >Contraseña</label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input
                    id="password"
                    placeholder="Ingrese una contraseña"
                    v-model="password"
                    type="password"
                    required
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
                <small v-if="error_password" class="text-red-600">
                  {{
                  error_password
                  }}
                </small>
                <small v-if="vacio_pass" class="text-yellow-600">
                  {{
                  vacio_pass
                  }}
                </small>
              </div>
               <!-- Fin de sección de password. -->

              <!-- Solicita repetir la contraseña y la valida. -->
              <div class="sm:col-span-2">
                <label
                  for="repeat_password"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >Repetir Contraseña</label>
                <div class="mt-1 rounded-md shadow-sm">
                  <input
                    id="repeat_password"
                    v-model="repeat_password"
                    placeholder="Verifique su contraseña"
                    type="password"
                    required
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
                <small v-if="error_repeat_password" class="text-red-600">
                  {{
                  error_repeat_password
                  }}
                </small>
                <small v-if="vacio_repeat_pass" class="text-yellow-600">
                  {{
                  vacio_repeat_pass
                  }}
                </small>
              </div>
            </div>
             <!-- Fin de sección de repetir pass. -->

            <div class="mt-4 mb-14 flex text-center justify-between">
              <div class="text-sm leading-5">
                <span
                  class="font-medium"
                >Al registrarte estás aceptando los términos y condiciones de <i>SirwiyQuy</i></span>
              </div>
            </div>
          </div>

          <div class="flex flex-row-reverse mt-6 mr-5">
            <span class="ml-3 inline-flex rounded-md shadow-sm" v-show="step==2">
              <AnimatedButton
                content="Completar registro"
                 color="gradiente"
                @onClick="submitSignup()"
                :isLoading="buttonLoading"
              ></AnimatedButton>
            </span>

            <button
              v-show="step<2"
              @click="step=step+1"
              class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
            >Siguiente</button>

            <button
              v-show="step>0"
              @click="step=step-1"
              type="button"
              class="py-2 px-4 border border-gray-500 rounded-md text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
            >Anterior</button>
          </div>

          <!-- Sección de logeo.
            Te redirige a la vista de logeo "Login".-->
            <div class="mt-6 mb-2 flex text-right justify-between mx-3">
              <div class="text-base leading-5">
                <span class="font-medium">¿Ya tienes cuenta?</span>
                <router-link
                  to="/login/enterprise"
                  class="font-bold text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                >¡Inicia sesión!</router-link>
              </div>
            </div>
            <!-- Fin de sección de logeo. -->
        </div>
      </div>
    </main>
  </Visitor>
</template>

<script>
import api from "../../api";

import Visitor from "../Layouts/Visitor";
import AnimatedButton from "../../components/AnimatedButton.vue";
import IconSvg from "../../components/IconSvg.vue";
import Format from "../../formatosBancarios";

export default {
  name: "SignUpEnterprise",
  components: 
  {
    Visitor,
    AnimatedButton,
    IconSvg,
  },
  data: () => 
  {
    return {
      hasError: false,
      buttonLoading: false,
      dni_valid: false,
      ruc_valid: false,
      isType: '',
      ccicon: '',

      identifier: "empresa",
      step: 0,

      username: "",
      email: "",
      password: "",
      repeat_password: "",

      //Nombre de los campos de empresa
      name_enterprise: "",//Razon social de la empresa
      ruc: "",
      file_enterprise: "", //Imagen de la empresa
      cardNumber: "", //Cuenta bancaria de la empresa

      //Nombre de los campos del admi de la empresa
      file_admi: "", //Imagen del administrador de la sesion que registra a la empresa
      name_admi: "",
      lastnamep_admi: "",
      lastnamem_admi: "",
      dni: "",
     
      error_username: "",
      error_email: "",
      error_password: "",
      error_repeat_password: "",
      error_dni: "",
      error_ruc: "",
      error_cardNumber: "",

      vacio_username: "",
      vacio_email: "",
      vacio_pass: "",
      vacio_repeat_pass: "",
      vacio_ruc: "",
      vacio_cardNumber: "", //Cuenta bancaria de la empresa
      vacio_dni: "",
    };
  },
  async mounted()
  {
    this.ccicon = document.getElementById('ccicon');
  },
  methods: {
    async validateCardNumber()
    {
      if((this.cardNumber.replace(/-/g, "").length > 0 && this.cardNumber.replace(/-/g, "").length < 20)
          || this.cardNumber.replace(/-/g, "").length > 20)
      {
        this.hasError = true;
        this.error_cardNumber = "La CCI debe tener 20 dígitos";
        this.vacio_cardNumber = "";
      }
      else if(this.cardNumber.replace(/-/g, "").length == 20)
      {
        this.hasError = false;
        this.error_cardNumber = "";
        this.vacio_cardNumber = "";

        this.cardNumber = this.cardNumber.replace(/\W/gi, '').replace(/\b(\d{3})(\d{3})(\d{12})(\d{2})\b/, '$1-$2-$3-$4').trim();
      }
      else
      {
        this.hasError = false;
        this.error_cardNumber = "";
        this.vacio_cardNumber = "";
      }

      if(this.cardNumber.replace(/-/g, "").length >= 3)
      {
        switch(this.cardNumber.substr(0,3))
        {
          case '002':
            this.ccicon.innerHTML = Format.Bank('bcp');
            break;
          case '003':
            this.ccicon.innerHTML = Format.Bank('interbank');
            break;
          case '009':
            this.ccicon.innerHTML = Format.Bank('scotiabank');
            break;
          case '011':
            this.ccicon.innerHTML = Format.Bank('bbva');
            break;
          default:
            this.ccicon.innerHTML = "";
            break;
        }
      }
      else if(this.cardNumber.replace(/-/g, "").length < 3)
      {
        this.ccicon.innerHTML = "";
      }
    },
    async validateDNI() 
    {
      if ((this.dni.length > 0 && this.dni.length < 8)) {
        this.hasError = true;
        this.dni_valid = false
        this.name_admi = "";
        this.lastnamep_admi = "";
        this.lastnamem_admi = "";
        this.error_dni = "El DNI debe tener 8 dígitos";
        this.vacio_dni = "";
        return;
      }else{
        this.hasError = false;
        this.error_dni = "";
        this.vacio_dni = "";
        if(this.dni.length == 0){return;}
        this.isType = 'DNI';
      } 

      let response = await api.get(`/validate/${this.isType}/${this.dni}`)//Se envia validacion
      
      if (!response.ok) {
        this.dni_valid = false

        this.name_admi = "";
        this.lastnamep_admi = "";
        this.lastnamem_admi = "";
           
        return this.$toast.open({
          message: "El sistema detectó que el DNI no es válido",
          type: "error",
          duration: 8000,
          dismissible: true
        });   
      }
      
      //Si todo esta correcto obtengo datos del DNI, solo los más relevantes
      this.name_admi = response.data.data[0].nombres;
      this.lastnamep_admi = response.data.data[0].apellidoPaterno;
      this.lastnamem_admi = response.data.data[0].apellidoMaterno;
      this.dni_valid = true

      this.$toast.open({
        message: response.data.data.success,
        type: "success",
        duration: 8000,
        dismissible: true
      });
    },
    async validateRUC() 
    {
      //Se comprueba longitud del campo apenas se llene
      if ((this.ruc.length > 0 && this.ruc.length < 11)) {
        this.hasError = true;
        this.ruc_valid = false;
        this.name_enterprise = "";
        this.error_ruc = "El RUC debe tener 11 dígitos";
        this.vacio_ruc = "";
        return;
      }
      else{
        this.hasError = false;
        this.error_ruc = "";
        this.vacio_ruc = "";
        if(this.ruc.length == 0){return;}
        this.isType = 'RUC';
      } 

      let response = await api.get(`/validate/${this.isType}/${this.ruc}`)//Se envia validacion
      
      //Si recibo algún error del RUC
      if (!response.ok) {
        this.ruc_valid = false;

        this.name_enterprise = "";

        return this.$toast.open({
          message:"El sistema detecto que el RUC no es válido",
          type: "error",
          duration: 8000,
          dismissible: true,
        });
      }

      this.ruc_valid = true;
      this.name_enterprise = response.data.data[0].razonSocial;

      this.$toast.open({
        message: response.data.data.success,
        type: "success",
        duration: 8000,
        dismissible: true,
      });
    },
    async submitSignup() {
      this.validateSubmit();
      if (this.hasError) return;
      this.buttonLoading = true;
    
      //Se condiciona la imagen de la empresa
       if(this.file_enterprise === '' | this.file_enterprise === "" | this.file_enterprise === null){
        this.buttonLoading = false;

        return this.$toast.open({
          message: 'Imagen de la empresa requerida',
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      //Se condiciona las imagen del administrador
      if(this.file_admi === '' | this.file_admi === "" | this.file_admi === null){
        this.buttonLoading = false;
        
        return this.$toast.open({
          message: 'Imagen de la empresa requerida',
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      //Se conecta con la lógica de negocio
      //RUC de  ejemplos en : http://www.sunat.gob.pe/descarga/BueCont/BueCont0.html
      let response = await api.post(`/signup`, {
        identity: this.identifier,
        username: this.username,
        email: this.email,
        password: this.password,
        name_enterprise: this.name_enterprise,
        RUC: this.ruc,
        file_enterprise: this.file_enterprise,
        cardNumber: this.cardNumber, 
        file_admi: this.file_admi,
        name_admi: this.name_admi,
        lastnamep_admi: this.lastnamep_admi,
        lastnamem_admi: this.lastnamem_admi,
        DNI: this.dni,
      });

      if (!response.ok) {
        this.buttonLoading = false;

        let er = response.error.errors;
        let mensaje = "Error desconocido";

        if (er.hasOwnProperty("username")) {
          mensaje = er.username[0];
        } else if (er.hasOwnProperty("email")) {
          mensaje = er.email[0];
        }

        return this.$toast.open({
          message: mensaje,
          type: "error",
          duration: 8000,
          dismissible: true,
        });
      }

      this.$toast.open({
        message: response.data.data.success1[0],
        type: "success",
        duration: 10000,
        dismissible : true,
      });

      this.$toast.open({
        message: response.data.data.success2.original.success[0],
        type: "info",
        duration: 10000,
        dismissible: true,
      });

      this.$router.push("/login/enterprise");
    },
    validateSubmit() {
      if(this.hasError == true) this.hasError = true;
        else this.hasError = false;

      //Validaciones del campo usuario
      if (this.username == "") {
        this.hasError = true;
        this.vacio_username = "Campo necesario";
        this.error_username = "";
      } else if (this.username.includes("@") || this.username.includes(".")) {
        this.hasError = true;
        this.vacio_username = "";
        this.error_username =
          "Usuario no válido, el usuario no debe de incluir @ o .";
      } else {
        this.error_username = "";
        this.vacio_username = "";
      }

      //Validaciones del campo Email
      if (this.email == "") {
        this.hasError = true;
        this.vacio_email = "Campo necesario";
        this.error_email = "";
      } else if (
        !this.email.includes("@") ||
        !this.email.includes(".") ||
        this.email.length < 5
      ) {
        this.hasError = true;
        this.vacio_email = "";
        this.error_email = "Correo no válido";
      } else {
        this.error_email = "";
        this.vacio_email = "";
      }

      //Validaciones del campo password
      if (this.password == "") {
        this.hasError = true;
        this.vacio_pass = "Campo necesario";
        this.error_password = "";
      } else if (this.password.length <= 5) {
        this.hasError = true;
        this.vacio_pass = "";
        this.error_password = "La contraseña debe ser mayor de 5 caracteres";
      } else {
        this.error_password = "";
        this.vacio_pass = "";
      }

      //Validaciones del campo repeat password
      if (this.repeat_password == "") {
        this.hasError = true;
        this.vacio_repeat_pass = "Campo necesario";
        this.error_repeat_password = "";
      } else if (this.repeat_password != this.password) {
        this.hasError = true;
        this.error_repeat_password = "Las contraseñas no coinciden";
        this.vacio_repeat_pass = "";
      } else {
        this.error_repeat_password = "";
        this.vacio_repeat_pass = "";
      }

      //Validacion del DNI
      if(this.dni.length==0){
        this.hasError = true;
        this.error_dni = "";
        this.vacio_dni = "Campo necesario";
      }else{
        this.error_dni = "";
        this.vacio_dni = "";
      } 
            
      //Comprobacion de cuenta de empresa
      if (this.cardNumber == "") {
        this.hasError = true;
        this.error_cardNumber = "";
        this.vacio_cardNumber = "Campo necesario";
      } else{
        this.error_cardNumber = "";
        this.vacio_cardNumber = "";
      }

      //Comprobacion de RUC
      if(this.ruc.length == ""){
        this.hasError = true;
        this.error_ruc = "";
        this.vacio_ruc = "Campo necesario";
      }else{
        this.error_ruc = "";
        this.vacio_ruc = "";
      } 
    },
    onFileChange(e, name) 
    {
      var files = e.target.files || e.dataTransfer.files;
      this[name] = files;
      
      if (!files.length) return;
      if(files[0].type != "image/jpeg" && files[0].type != "image/png") 
      {
        this.file_enterprise = '';
        this.file_admi = '';
        return;
      }
      
      this.createImage(files[0], name);
    },
    createImage(file, name) 
    {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm[name] = e.target.result;
      };
      reader.readAsDataURL(file);
    },
    removeImage(e, name) {
      this[name] = "";
    },
  },
};
</script>