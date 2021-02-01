<template>
  <!-- LOGIN: Vista de logeo del usuario.
  Valida el usuario o correo y contraseña para poder ingresar.-->
  <Visitor>
    <main class="w-full flex sm:h-screen">
      <div class="w-1/2 hidden lg:flex  bg-gray-100">
       <img style="clip-path: polygon(0 0, 100% 0%, 95% 100%, 0% 100%);" class="object-cover h-auto" alt="Portada" src="../../../assets/imgLogin.jpg">
      </div>

      <div class="w-full lg:w-1/2 py-12 sm:py-0 bg-gray-100">
        <div class="flex sm:h-screen flex-col justify-center pt-2 pb-4 bg-gray-100">
          <div class="md:text-center md:flex-col md:flex md:justify-center md:items-center">
            <p class="uppercase px-5 text-3xl md:text-4xl font-extrabold text-gray-900"
            >Bienvenido</p>
          </div>

          <div class="sm:mx-auto sm:w-full sm:max-w-md mt-4">
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
                      @change="validatePassword()"
                      placeholder="Ingrese su contraseña"
                      class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                    />
                  </div>
                  <small v-if="vacio_pass" class="text-yellow-600">
                    {{
                    vacio_pass
                    }}
                  </small>
                  <small v-if="error_pass" class="text-red-600">
                    {{
                    error_pass
                    }}
                  </small>
                </div>
                <!-- Fin de sección de ingreso de contraseña. -->
              </div>

              <!-- Sección de recuperación de contraseña.
              Te redirige a la vista de recuperación de contraseña "Blank".-->
              <div class="mt-2 ml-2 sm:ml-0 flex items-center justify-between">
                <div class="text-sm leading-5">
                  <dd
                    @click="openModal=true"
                    class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out cursor-pointer duration-150"
                  >¿Olvidaste tu contraseña? Haga click aquí</dd>
                </div>
              </div>

              <div
                v-show="openModal"
                class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
              >
                <div @click="openModal = false;  
                      hasError = false;
                      vacio_email2 = '';  email_recover='';
                      error_email2 = '';" 
                      class="fixed inset-0 transition-opacity">
                  <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                </div>
                <div
                  class="w-68 fixed bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-xl sm:w-full sm:p-6"
                  role="dialog"
                  aria-modal="true"
                  aria-labelledby="modal-headline"
                >
                  <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
                    <button
                      @click="openModal = false;  
                      hasError = false;
                      vacio_email2 = '';  email_recover='';
                      error_email2 = '';"
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
                    <h2
                      class="text-lg leading-6 font-medium text-gray-900 "
                      id="modal-headline"
                    >Recuperar sesión</h2>
                  </div>
                  
                  <div class="mt-3">
                    <div class="grid grid-cols-3 sm:gap-8 col-span-3 -my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8" >
                      <div class="col-span-3 sm:col-span-1 mt-1 rounded-md w-full">
                        <label
                          for="identifier"
                          class="block text-sm font-medium leading-5 text-gray-700"
                        >Recuperar como:</label>
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

                      <div class="col-span-3 sm:col-span-2 mt-3 md:mt-1 rounded-md w-full">
                        <div>
                          <label
                          for="email_recover"
                          class="block text-sm font-medium leading-5 text-gray-700"
                          >Correo:</label>
                          <input
                            id="email_recover"
                            v-model="email_recover"
                            placeholder="Ingrese su correo"
                            type="text"
                            @change="validateEmail()"
                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                          />
                        </div>
                        <small v-if="vacio_email2" class="text-yellow-600">{{
                            vacio_email2
                        }}</small>
                         <small v-if="error_email2" class="text-red-600">{{
                            error_email2
                        }}</small>
                      </div>
                    </div>
                  </div> 
                    
                  <div class="text-center sm:text-right mt-6">
                    <button
                      @click="ResetPass()"
                      type="submit"
                      class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
                    >
                      Enviar
                    </button>
                  </div>
                </div>
              </div>
               <!-- Fin de sección de recuperación de contraseña. -->

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
  components: 
  {
    Visitor,
    AnimatedButton,
  },
  data: () => 
  {
    return {
      openModal: false,
      buttonLoading: false,
      isEnterprise: false,

      routes: "",
      identifier: "",

      loger: '',
      password: '',
      email_recover: '',

      vacio_loger: '',
      vacio_pass: '',
      error_pass: '',
      vacio_email2: '',
      error_email2: ''
    };
  },
  props: 
  {
    identity: String,
  },
  async created() 
  {
    this.validateRouter(this.identity);
  },
  watch: 
  { 
    identity: function(newVal, oldVal) 
    {
      this.validateRouter(newVal);
    }
  },
  methods: 
  {
    validateRouter(id)
    {
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
    change()
    {
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
    validateEmail()
    {
      const correo = () => /^(([^<>()$\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email_recover);
      
      this.error_email2 = '';
      this.vacio_email2 = '';

      if(this.email_recover == '') {return;}

      if(!correo(this.email_recover))
      {
        this.error_email2 = 'Correo no válido';
        this.vacio_email2 = '';
      }
    },
    async submitLogin() 
    {
      this.validatePassword();
      var boolean = false;

      if (this.loger == "") { this.vacio_loger = "Campo obligatorio"; boolean = true;} 
      else { this.vacio_loger = ""; }

      if(this.password == "" && this.error_pass == "" )
      { 
        this.vacio_pass = "Campo obligatorio";
        this.error_pass = "";
        boolean = true;
      }
      else if(this.password != "" && this.error_pass != "") { this.vacio_pass = ""; boolean = true;}
      else if(this.password != "" && this.error_pass == "")
      {
        this.vacio_pass = "";
        this.error_pass = "";
      }

      if(boolean == true) { return; }
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
      localStorage.setItem('token', response.data.data.replace(/ /g, ""));
      
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

        if(localStorage.getItem('suma')!=null) 
          this.$router.push("/request/form/service");
        else if(localStorage.getItem('e_bandera')!=null)
        {
          localStorage.removeItem('e_bandera');
          
          this.$router.push("/customer/payment/link="
          +localStorage.getItem('e_link')+"/response="
          +localStorage.getItem('e_response'));
        }
        else
          this.$router.push("/");
      }
    },
    async ResetPass()
    {
      this.validateEmail();

      if (this.email_recover == "" && this.error_email2 == "") 
      {
        this.vacio_email2 = "Campo necesario";
        this.error_email2 = "";
        return;
      }
      else if(this.email_recover != "" && this.error_email2 != "") { this.vacio_email2 = ""; return; }
      else if(this.email_recover != "" && this.error_email2 == "")
      {
        this.error_email2 = "";
        this.vacio_email2 = "";
      }

      this.openModal = false;
      
      //Post para verificar existencia y enviar correo
      let response = await api.post(`/reset`, {
        identity: this.identifier,
        email: this.email_recover
      });
      
      this.vacio_email2 = '';
      this.error_email2 = '';
      this.email_recover = '';    
      
      if (!response.ok)
      {        
        let er = response.error.errors;
        let mensaje = "Error desconocido";

        if (er.hasOwnProperty("mail")) mensaje = er.mail[0];
        return this.$toast.open({
          message: mensaje,
          type: "error",
          duration: 8000,
          dismissible: true,
        });
      }
      
      this.$toast.open({
        message: response.data.data.success[0],
        type: "success",
        duration: 8000,
        dismissible: true,
      });
    },
    validatePassword() 
    {
      this.error_pass = "";
      this.vacio_pass = "";
      
      if(this.password.length == 0){return;}

      if(this.password.length >= 8)
			{	
        this.vacio_pass = "";	
				var mayuscula = false;
				var minuscula = false;
				var numero = false;
				
				for(var i = 0; i<this.password.length; i++)
				{
					if(this.password.charCodeAt(i) >= 65 && this.password.charCodeAt(i) <= 90) { mayuscula = true; }
					else if(this.password.charCodeAt(i) >= 97 && this.password.charCodeAt(i) <= 122) { minuscula = true; }
					else if(this.password.charCodeAt(i) >= 48 && this.password.charCodeAt(i) <= 57) { numero = true; }
        }
        
        if(mayuscula == false) { this.error_pass = "Su contraseña debe tener al menos una letra mayuscula"; return;}
        if(minuscula == false) { this.error_pass = "Su contraseña debe tener al menos una letra minuscula"; return;}
        if(numero == false) { this.error_pass = "Su contraseña debe tener al menos un número"; return;}
        
        if(mayuscula == true && minuscula == true && numero == true) { this.error_pass = "" }
			}
      else if(this.password.length < 8 && this.password.length > 0)
      { 
        this.error_pass = "La longitud mínima es de 8 caracteres";
        this.vacio_pass = "";
      }
    }
  },
};
</script>