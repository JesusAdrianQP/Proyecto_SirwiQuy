<template>
  <!-- LOGIN: Vista de logeo del usuario.
  Valida el usuario o correo y contraseña para poder ingresar.-->
  <Visitor>
    <main class="w-full flex ">
      <div class="w-1/2 hidden lg:flex  bg-gray-100">
       <img style="clip-path: circle(67.9% at 28% 49%);" class="object-cover h-auto" alt="Portada" src="../../../assets/imgLogin.jpg">
      </div>

      <div class="w-full lg:w-1/2">
        <div class="flex flex-col justify-center pt-2 pb-4 bg-gray-100">
          <div class="md:text-center md:flex-col md:flex md:justify-center md:items-center lg:mt-10">
            <p class="uppercase px-5 mt-4 text-3xl md:text-4xl font-extrabold text-gray-900"
            >Bienvenido</p>
          </div>

          <div class="sm:mx-auto sm:w-full sm:max-w-md mt-4 mb-4 sm:mb-6 md:mb-8 lg:mb-14">
            <div class="bg-white pb-4 pt-6 shadow rounded-lg mx-3 px-1 sm:px-10">
              <div class="grid grid-cols-1 col-gap-4 row-gap-5 mx-5 sm:mx-1">
                <div class="sm:col-span-2">
                  <div class="grid grid-cols-3 gap-5">
                    <div class="flex">
                      <input
                        id="cliente"
                        name="cliente"
                        type="radio"
                        class="form-radio h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
                        value="cliente"
                        v-model="identifier"
                        @change="change"
                      />
                      <label for="cliente" class="ml-1">
                        <span class="block text-sm leading-5 font-medium text-gray-700">Cliente</span>
                      </label>
                    </div>
                  
                    <div class="flex -ml-3">
                      <input
                        id="trabajador"
                        name="trabajador"
                        type="radio"
                        class="form-radio h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
                        value="trabajador"
                        v-model="identifier"
                         @change="change"
                      />
                      <label for="trabajador" class="ml-1">
                        <span class="block text-sm leading-5 font-medium text-gray-700">Trabajador</span>
                      </label>
                    </div>

                    <div class="flex">
                      <input
                        id="empresa"
                        name="empresa"
                        type="radio"
                        class="form-radio h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
                        value="empresa"
                        v-model="identifier"
                         @change="change"
                      />
                      <label for="empresa" class="ml-1">
                        <span class="block text-sm leading-5 font-medium text-gray-700">Empresa</span>
                      </label>
                    </div>
                  </div>
                </div>

                <!-- Sección de ingreso de usuario o correo.
                Solicita el usuario o correo y lo valida.-->
                <div class="sm:col-span-2">
                  <label
                    for="loger"
                    class="block text-sm font-medium leading-5 text-gray-700"
                  >Usuario o correo</label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input
                      v-model="loger"
                      id="loger"
                      required
                      placeholder="Ingrese su usuario o email registrado"
                      class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                    />
                  </div>
                  <small v-if="vacio_loger" class="text-yellow-600">
                    {{
                    vacio_loger
                    }}
                  </small>
                </div>
                <!-- Fin de sección de ingreso de usuario o correo. -->

                <!-- Sección de ingreso de contraseña.
                Solicita la contraseña y la valida.-->
                <div class="sm:col-span-2">
                  <label
                    for="password"
                    class="block text-sm font-medium leading-5 text-gray-700"
                  >Contraseña</label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input
                      v-model="password"
                      id="password"
                      type="password"
                      required
                      placeholder="Ingrese su contraseña."
                      class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                    />
                  </div>
                  <small v-if="vacio_pass" class="text-yellow-600">
                    {{
                    vacio_pass
                    }}
                  </small>
                </div>
                <!-- Fin de sección de ingreso de contraseña. -->
              </div>

              <!-- Sección de recuperación de contraseña.
              Te redirige a la vista de recuperación de contraseña "Blank".-->
              <div class="mt-6 flex items-center justify-between mx-5 sm:mx-1">
                <div class="text-sm leading-5">
                  <dd
                    class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out cursor-pointer duration-150"
                  >¿Olvidaste tu contraseña? Haga click aquí</dd>
                </div>
              </div>

              <div class="mt-8">
                <span class="block w-2/3 mx-auto rounded-md shadow-sm">
                  <AnimatedButton
                    content="Ingresar"
                    color="gradiente"
                    @onClick="submitLogin()"
                    :isLoading="buttonLoading"
                  ></AnimatedButton>
                </span>
              </div>

              <!-- Sección de registro.
              Te redirige a la vista de registro "SignUpIndie".-->
              <div class="mt-6 mb-2 flex text-right justify-between mx-3">
                <div class="text-base leading-5">
                  <span class="font-medium">¿No tienes una cuenta?</span>
                  <router-link
                    v-if="!isEnterprise"
                    :to="'/signup/indie/'+routes"
                    class="font-bold text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                  >¡Regístrate!</router-link>
                  <router-link
                      v-if="isEnterprise"
                      to="/signup/enterprise"
                      class="font-bold text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                  >¡Regístrate!</router-link>
                </div>
              </div>
              <!-- Fin de sección de registro. -->
            </div>
          </div>
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
  name: "Login",
  components: {
    Visitor,
    AnimatedButton,
  },
  data: () => {
    return {
      hasError: false,
      buttonLoading: false,
      isEnterprise: false,

      routes: "",
      identifier: "",

      loger: "",
      password: "",

      vacio_loger: "",
      vacio_pass: "",
    };
  },
  props: {
    identity: String,
  },
  async created() {
    this.validateRouter(this.identity);
  },
   watch: { 
    identity: function(newVal, oldVal) {
      this.validateRouter(newVal);
    },
  },
  methods: {
    async validateRouter(id){
      //Se crea condicionales para verificar de donde proviene
      //Una vez cargado no se cambiara el valor hasta que se recarge o vaya a otra pestaña diferente
      switch(id)
      {
        case "customer":
          this.identifier = "cliente";
          this.routes = "customer";
           this.isEnterprise = false;
        break;

        case "employee":
          this.identifier = "trabajador";
          this.routes = "employee";
           this.isEnterprise = false;
        break;

        case "enterprise":
          this.identifier = "empresa";
          this.isEnterprise = true;
        break;

        default:
          this.$router.push("/**"); 
        break;
      };
    },
    async change(){
      if(this.identifier == "cliente"){
        this.validateRouter("customer");
      }
      else if(this.identifier == "trabajador"){
        this.validateRouter("employee");
      }
      else if(this.identifier == "empresa"){
        this.validateRouter("enterprise");
      }
    },
    async submitLogin() {
      this.validateSubmit();
      if (this.hasError) return;
      this.buttonLoading = true;

      //Conexión con la lógica de negocio
      //Se pasa como parametros el loger (usario o correo)
      //identity -> tipo de identificador para el usuario
      //password -> contraseña
      let response = await api.post(`/login`, {
        identity: this.identifier,
        loger: this.loger,
        password: this.password,
      });

      //Si hay errores se identifica que tipo
      if (!response.ok) {
        this.buttonLoading = false;

        let er = response.error.errors;
        let mensaje = "Error desconocido.";

        if (er.hasOwnProperty("mail")) mensaje = er.mail[0];
        else if (er.hasOwnProperty("user")) mensaje = er.user[0];
        else mensaje = er.pass[0];

        return this.$toast.open({
          message: mensaje,
          type: "error",
          duration: 8000,
          dismissible: true,
        });
      }

      //Guardo token de acceso
      localStorage.setItem('token', response.data.data);
      
      //Si todo esta correcto: 
      this.$toast.open({
          message: "Bienvenido a su sesión",
          type: "success",
          duration: 8000,
          dismissible: true,
      });
      
      //Concedo nivel de acceso y enrutamiento dependiendo del usuario
      if (this.identifier == "trabajador" || this.identifier == "empresa") {
        //Sacamos nivel de acceso del usuario
        if(this.identifier == "trabajador"){
          localStorage.setItem('e_level', "employee");
          this.$router.push("/worker/profile/edit");
        }
        if(this.identifier == "empresa"){
          localStorage.setItem('e_level', "enterprise");
          this.$router.push("/supplier");
        } 
      } 
      else{
        localStorage.setItem('e_level', "customer");
        this.$router.push("/");
      }
    },
    validateSubmit() {
      this.hasError = false;
      
      //Validaciones de campo email vuejs
      if (this.loger == "") {
        this.hasError = true;
        this.vacio_loger = "Campo obligatorio";
      } else {
        this.vacio_loger = "";
      }

      //Validaciones de campo pass vuejs
      if (this.password == "") {
        this.hasError = true;
        this.vacio_pass = "Campo obligatorio";
      } else if (this.password.length < 5) {
        this.hasError = true;
        this.vacio_pass = "Su contraseña no cumple los parámetros.";
      } else {
        this.vacio_pass = "";
      }
    },
  },
};
</script>