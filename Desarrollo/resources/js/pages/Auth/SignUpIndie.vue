<template>
  <!-- SING UP INDIE: Vista de registro del cliente y trabajador independiente.
  Solicita al usuario nuevo un nombre de usuario,
  un correo y una contraseña para poder registrarlo. hi-->
  <Visitor>
    <main class="flex flex-col justify-center py-8 sm:px-6 lg:px-8">
      <div class="sm:mx-auto">
        <img class="mx-auto h-36 w-auto" src="../../../assets/Sirwiyquy_b.png" alt="Workflow" />
        <h2
          class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900"
        >Crear cuenta como <br>{{identifier}}</h2>
      </div>

      <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md">
        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
          <!-- Sección de ingreso de usuario.
          Solicita un nombre de usuario y lo valida.-->
          <div>
            <label for="username" class="block text-sm font-medium leading-5 text-gray-700">Usuario</label>
            <div class="mt-1 rounded-md shadow-sm">
              <input
                id="username"
                v-model="username"
                placeholder="Ingrese un nombre de usuario"
                type="text"
                required
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
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
                content="Registrar"
                color="primary"
                @onClick="submitSignup()"
                :isLoading="buttonLoading"
              ></AnimatedButton>
            </span>
          </div>

          <div class="mt-4 flex text-center justify-between">
            <div class="text-sm leading-5">
              <span
                class="font-medium"
              >Al registrarte, estas aceptando los términos y condiciones de uso del servicio SirwiyQuy</span>
            </div>
          </div>

          <!-- Sección de logeo.
          Te redirige a la vista de logeo "Login".-->
          <div class="mt-6 flex text-right justify-between">
            <div class="text-base leading-5">
              <span class="font-medium">¿Ya tienes cuenta?</span>
              <router-link
                :to="'/login/'+routes"
                class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
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

export default {
  name: "SignUpIndie",
  components: {
    Visitor,
    AnimatedButton,
  },
  data: () => {
    return {
      hasError: false,
      buttonLoading: false,

      routes: "",
      identifier: "",

      username: "",
      email: "",
      password: "",
      repeat_password: "",

      error_username: "",
      error_email: "",
      error_password: "",
      error_repeat_password: "",

      vacio_username: "",
      vacio_email: "",
      vacio_pass: "",
      vacio_repeat_pass: "",
    };
  },
  props: {
    identity: String, //Ruta de tipo de usuario traida en primer plano
  },
  //Funcion que se implementa cuando se esta construyendo el componente
  async created() {
    //Se crea condicionales para verificar de donde proviene
    //Una vez cargado no se cambiara el valor hasta que se recarge o vaya a otra pestaña diferente
    if (this.identity == "customer") {
      this.identifier = "cliente";
      this.routes = "customer";
    } else if (this.identity == "employee") {
      this.identifier = "trabajador";
      this.routes = "employee";
    } else this.$router.push("/login");
  },
  methods: {
    async submitSignup() {
      /*this.validateSubmit();
      if (this.hasError) return;
      this.buttonLoading = true;

      //Se conecta con la lógica de negocio
      //En el de empresa es lo mismo solo que con mas variables
      //Variables si o si requeridas:
      //identity, username, email, password
      let response = await api.post(`/signup`, {
        identity: this.identifier,
        username: this.username,
        email: this.email,
        password: this.password,
      });
      
      //Si hay algun error en la creacion del usuario
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

      //Si se envia correo con exito
      this.$toast.open({
        message: response.data.data.success2.original.success[0],
        type: "info",
        duration: 10000,
        dismissible: true,
      });

      //Redireccionamiento de rutas
      if (this.identifier == "trabajador") this.$router.push("/login/employee");
      else this.$router.push("/login/customer");*/
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
    },
  },
};
</script>