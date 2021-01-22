<template>
  <Visitor>
    <div class="bg-gray-100">
      <main class="">
        <div
          class="bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8"
        >
          <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img
              class="mx-auto h-36 w-auto"
              src="../../../assets/illustrations/sign-up.png"
              alt="Workflow"
            />
            <h2
              class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900"
            >
              Recuperar Sesión como {{identifier}}<br>
            </h2>
          </div>

          <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                            
              <!-- Sección de ingreso de correo.
              Solicita un correo electrónico y lo valida.-->
              <div class="mt-2">
                <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Correo</label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input
                      id="email"
                      v-model="email"
                      placeholder="Ingrese un correo electronico"
                      type="email"
                      required
                      class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
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
                            
              <!-- Sección de ingreso de DNI.
              Solicita el DNI y lo valida. --> 
              <div v-if="identifier == 'trabajador'" class="mt-2">
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
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
                <small v-if="error_dni" class="text-red-600">{{
                  error_dni
                }}</small>
                <small v-if="vacio_dni" class="text-yellow-600">{{
                  vacio_dni
                }}</small>
              </div>

              <!-- Sección de ingreso de RUC.
              Solicita el RUC y lo valida.-->
              <div v-if="identifier == 'empresa'" class="mt-2">
                <label for="input_ruc" class="block text-sm font-medium leading-5 text-gray-700">RUC</label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <input
                      placeholder="Ingrese su RUC"
                      id="input_ruc"
                      v-model="ruc"
                      class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                    />
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

                <!-- Sección de ingreso de contraseña.
                Solicita una contraseña y la valida.-->
                <div class="mt-2">
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
                      class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-l-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
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

                <!-- Solicita repetir la contraseña y la valida. -->
                <div class="mt-2">
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
                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-l-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
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
                <!-- Fin de sección de ingreso de contraseña. -->

                <div class="mt-6">
                  <span class="block w-full rounded-md shadow-sm">
                    <AnimatedButton
                      content="Actualizar"
                      color="primary"
                      @onClick="submitPass()"
                      :isLoading="buttonLoading"
                    ></AnimatedButton>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </Visitor>
</template>

<script>
import api from "../../api";

import Visitor from "../Layouts/Visitor";
import AnimatedButton from "../../components/AnimatedButton.vue";

export default {
    name: "RecoverSession",
    components: {
        Visitor,
        AnimatedButton
  },
  data: () => {
    return {
      hasError: false,
      buttonLoading: false,
      errorPage: 0,

      identifier: "",

     
      email: "",
      dni: "",
      ruc: "",
      password: "",
      repeat_password: "",
      
      error_email: "",
      error_dni: "",
      error_ruc: "",
      error_password: "",
      error_repeat_password: "",
      
      vacio_email: "",
      vacio_dni: "",
      vacio_ruc: "",
      vacio_pass: "",
      vacio_repeat_pass: "",
    }
  },
  props: {
    cod: String,
    ide: String
  },
  async created() {
    if(this.ide == 'cliente') this.identifier = 'cliente';
      else if(this.ide == 'trabajador') this.identifier = 'trabajador';
        else if(this.ide == 'empresa') this.identifier = 'empresa';
         else this.$router.push("*");
    
    let response = await api.get(`/reset/${this.cod}/${this.identifier}`)
    this.errorPage = response.data.data;

    if(this.errorPage == 1) this.$router.push("*");
  },
  methods: {
    async submitPass() {
      this.validateSubmit();
      if (this.hasError) return;
      this.buttonLoading = true;

      let response = await api.post(`/changepass`, {
        identity: this.identifier,
        email: this.email,
        dni: this.dni,
        ruc: this.ruc,
        password: this.password
      });

      //Si hay errores se identifica que tipo
      if (!response.ok) {
        this.buttonLoading = false;

        let er = response.error.errors;
        let mensaje = "Error desconocido";

        if (er.hasOwnProperty("fail")) mensaje = er.fail[0];

        return this.$toast.open({
          message: mensaje,
          type: "error",
          duration: 8000,
          dismissible: true,
        });
      }

      //Si la operacion es exitosa
      this.$toast.open({
        message: response.data.data.success[0],
        type: "success",
        duration: 10000,
        dismissible: true,
      });

      //Redireccionamiento de rutas
      this.$router.push("/");
    },
    validateSubmit() {
      this.hasError = false;

      //Validaciones del campo Email
      if (this.email == '') {
        this.hasError = true;
        this.vacio_email = "Campo necesario";
        this.error_email = '';
      } else if (
        !this.email.includes("@") ||
        !this.email.includes(".") ||
        this.email.length < 5
      ) {
        this.hasError = true;
        this.vacio_email = '';
        this.error_email = "Correo no válido";
      } else {
        this.error_email = '';
        this.vacio_email = '';
      }

      if(this.identifier == 'trabajador'){
         //Validación del DNI
        if ((this.dni.length > 0 && this.dni.length < 8) || (this.dni.length > 8)) {
          this.hasError = true;
          this.error_dni = "El DNI debe tener 8 dígitos";
          this.vacio_dni = "";
        } else if(this.dni == ''){
          this.hasError = true;
          this.error_dni = '';
          this.vacio_dni = 'Campo necesario';
        } else{
          this.error_dni = '';
          this.vacio_dni = '';
        } 
      }

      if(this.identifier == 'empresa'){
         //Validacion de RUC
        if ((this.ruc.length > 0 && this.ruc.length < 11) || (this.ruc.length > 11)) {
          this.hasError = true;
          this.error_ruc = "El RUC debe tener 11 dígitos";
          this.vacio_ruc = "";
        }else if(this.ruc == ''){
          this.hasError = true;
          this.error_ruc = '';
          this.vacio_ruc = 'Campo necesario';
        }else{
          this.error_ruc = "";
          this.vacio_ruc = "";
        }
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
    },
  },
};
</script>