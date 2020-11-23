<template>
  <!-- LOGIN: Vista de logeo del usuario.
  Valida el usuario o correo y contraseña para poder ingresar.-->
  <Visitor>
    <div class="bg-gray-100">
      <main class>
        <div class="bg-gray-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
          <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <img class="mx-auto h-28 w-auto" src="../../../assets/Sirwiyquy_b.png" alt="Workflow" />
            <h2
              class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900"
            >Ingresa a tu cuenta</h2>
            
          </div>

          <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
              <!-- Sección de ingreso de usuario o correo.
              Solicita el usuario o correo y lo valida.-->
              <div>
                <label
                  for="identifier"
                  class="block text-sm font-medium leading-5 text-gray-700"
                >Entrar como:</label>
                <select
                  v-model="identifier"
                  id="identifier"
                  class="form-select block w-full pl-3 pr-10 py-2 text-base leading-6 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
                >
                  <option value="cliente">Cliente</option>
                  <option value="trabajador">Trabajador</option>
                  <option value="empresa">Empresa</option>
                </select>
              </div>

              <div class="mt-4">
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
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
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
              <div class="mt-4">
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
                    class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
                </div>
                <small v-if="vacio_pass" class="text-yellow-600">
                  {{
                  vacio_pass
                  }}
                </small>
              </div>
              <!-- Fin de sección de ingreso de contraseña. -->

              <!-- Sección de recuperación de contraseña.
              Te redirige a la vista de recuperación de contraseña "Blank".-->
              <div class="mt-6 flex items-center justify-between">
                <div class="text-sm leading-5">
                  <dd
                    class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out cursor-pointer duration-150"
                  >¿Olvidaste tu contraseña? Haga click aquí</dd>
                </div>
              </div>

              <div class="mt-6">
                <AnimatedButton
                  content="Ingresar"
                  color="primary"
                  @onClick="submitLogin()"
                  :isLoading="buttonLoading"
                ></AnimatedButton>
              </div>

              <!-- Sección de registro.
              Te redirige a la vista de registro "SignUpIndie".-->
              <div class="mt-6 flex text-right justify-between">
                <div class="text-base leading-5">
                  <span class="font-medium">¿No tienes una cuenta?</span>
                  <router-link
                    v-if="!isEnterprise"
                    :to="'/signup/indie/'+routes"
                    class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                  >¡Regístrate!</router-link>
                  <router-link
                    v-if="isEnterprise"
                    to="/customer/blank"
                    class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                  >¡Regístrate!</router-link>
                </div>
              </div>
              <!-- Fin de sección de registro. -->
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
  name: "Login",
  components: {
    Visitor,
    AnimatedButton,
  },
  data: () => {
    return {
      hasError: false,
      buttonLoading: false,
      isEnterprise: false, //Comprobacion si la ruta es de empresa -
      //esto debido a que la creacion de empresas es diferente

      routes: "", //Se crea para establecer las redirecciones de rutas
      identifier: "", //Se usa para reconocer en que sesion entrara - el patron reconoce que hara gracias a esto

      loger: "",
      password: "",

      vacio_loger: "",
      vacio_pass: "",

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
    } else if (this.identity == "enterprise") {
      this.identifier = "empresa";
      this.isEnterprise = true;
    } else this.$router.push("/login");
  },
  methods: {
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

      //Si todo esta correcto: 
      this.$toast.open({
          message: "Bienvenido, usuario.",
          type: "success",
          duration: 8000,
          dismissible: true,
        });
      

      //Concedo nivel de acceso y enrutamiento dependiendo del usuario
      if (this.identifier == "trabajador" || this.identifier == "empresa") {
            //Sacamos nivel de acceso del usuario
            if(this.identifier == "trabajador") localStorage.setItem('e_level', "employee");
            if(this.identifier == "empresa") localStorage.setItem('e_level', "enterprise");

            //Observamos que si es la primera vez de ingreso - si es asi se requiere actualizar datos
            if (
                localStorage.getItem('e_DNI') === "" ||
                localStorage.getItem('e_DNI') === null ||
                localStorage.getItem('e_DNI') === ""
              )
                this.$router.push("/worker/profile/edit");
              else this.$router.push("/supplier");
      } 
      else{
        localStorage.setItem('e_level', "customer");
      }
      },
      
    
    
    validateSubmit() {
      if(this.hasError == true) this.hasError = true;
        else this.hasError = false;
      //Validaciones de campo email vuejs
      if (this.loger == "") {
        this.hasError = true;
        this.vacio_loger = "Campo obligatorio";
      } else {
        this.vacio_email = "";
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