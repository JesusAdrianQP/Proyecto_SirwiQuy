<template>
  <!-- SING UP INDIE: Vista de registro del cliente y trabajador independiente.
  Solicita al usuario nuevo un nombre de usuario,
  un correo y una contraseña para poder registrarlo. hi-->
  <Visitor>
    <main class="flex flex-col justify-center pt-2 pb-4 bg-gray-100">
      <div class="md:text-center md:flex-col md:flex md:justify-center md:items-center">
        <img class="h-50 sm:h-56 lg:h-48 px-6 w-auto mt-4" src="../../../assets/illustrations/sign-up.png" alt="avatar" />
        <p class="uppercase px-5 mt-4 text-3xl md:text-4xl font-extrabold text-gray-900"
        >Crear cuenta </p>
        <p class="px-5 text-sm">Esta cuenta sera creada para un usuario de tipo <b class="text-base2 italic">{{identifier}}</b></p>
      </div>

      <div class="sm:mx-auto sm:w-full sm:max-w-md mt-4 mb-4 sm:mb-6 md:mb-8">
        <div class="bg-white pb-4 pt-6 shadow rounded-lg mx-3 px-1 sm:px-10">
          <div class="grid grid-cols-1 col-gap-4 row-gap-5 mx-5 sm:mx-1">
            <div class="sm:col-span-2">
              <label for="username" class="block text-sm font-medium leading-5 text-gray-700">Usuario</label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  id="username"
                  v-model="username"
                  placeholder="Ingrese un nombre de usuario"
                  type="text"
                  required
                  @change="validateUser()"
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
            
            <div class="sm:col-span-2">
              <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Correo</label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  id="email"
                  v-model="email"
                  placeholder="Ingrese un correo"
                  type="text"
                  required
                  @change="validateEmail()"
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
                  @change="validatePassword()"
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
                  @change="validateRepeatPassword()"
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

          <div class="mt-8">
            <span class="block w-2/3 mx-auto rounded-md shadow-sm">
              <AnimatedButton
                content="Registrar"
                color="gradiente"
                @onClick="submitSignup()"
                :isLoading="buttonLoading"
              ></AnimatedButton>
            </span>
          </div>

          <div class="mt-4 flex text-center justify-between">
            <div class="text-sm leading-5">
              <span
                class="font-medium"
              >Al registrarte estás aceptando los términos y condiciones de <i>SirwiyQuy</i></span>
            </div>
          </div>
         
          <div class="mt-6 mb-2 flex text-right justify-between mx-3">
            <div class="text-base leading-5">
              <span class="font-medium">¿Ya tienes cuenta?</span>
              <router-link
                :to="'/login/' + routes"
                class="font-bold text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
              >¡Inicia sesión!</router-link>
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
  name: "SignUpIndie",
  components: 
  {
    Visitor,
    AnimatedButton,
  },
  data: () => 
  {
    return {
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
  props: 
  {
    identity: String, //Ruta de tipo de usuario traida en primer plano
  },
  async created() 
  {
    this.validateRouter(this.identity);
  },
  watch: 
  { 
    identity: function(newVal, oldVal) {
      this.validateRouter(newVal);
    },
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
        break;

        case "employee":
          this.identifier = "trabajador";
          this.routes = "employee";
        break;

        default:
          this.$router.push("/**"); 
        break;
      };
    },
    validateUser()
    {
      this.error_username = '';
      this.vacio_username = '';

      if(this.username == '') {return;}
      
      if(this.username.includes('@') || this.username.includes('.')) 
      {
        this.vacio_username = '';
        this.error_username = 'El usuario no debe de incluir @ ó .';
        return;
      }       
    },
    validateEmail()
    {
      const correo = () => /^(([^<>()$\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.email);
      
      this.error_email = '';
      this.vacio_email = '';

      if(this.email == '') {return;}

      if(!correo(this.email))
      {
        this.error_email = 'Correo no válido';
        this.vacio_email = '';
      }
    },
    validatePassword()
    {
      this.error_password = '';
      this.vacio_pass = '';
      
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
        
        if(mayuscula == false) { this.error_password = "Su contraseña debe tener al menos una letra mayuscula"; return;}
        if(minuscula == false) { this.error_password = "Su contraseña debe tener al menos una letra minuscula"; return;}
        if(numero == false) { this.error_password = "Su contraseña debe tener al menos un número"; return;}
        
        if(mayuscula == true && minuscula == true && numero == true) { this.error_password = "" }
			}
      else if(this.password.length < 8 && this.password.length > 0)
      { 
        this.error_password = "La longitud mínima es de 8 caracteres";
        this.vacio_pass = "";
      }
    },
    validateRepeatPassword()
    {
      this.error_repeat_password = '';
      this.vacio_repeat_pass = '';
      
      if(this.repeat_password.length == 0){return;}

      if(this.repeat_password != this.password)
      {
        this.error_repeat_password = "Las contraseñas no coinciden";
        this.vacio_repeat_pass = "";
      }
    },
    async submitSignup() 
    {
      this.validateUser();
      this.validateEmail();
      this.validatePassword();
      this.validateRepeatPassword();
      var boolean = false;

       if(this.username == '' && this.error_username == '' )
      { 
        this.vacio_username = 'Campo obligatorio';
        this.error_username = '';
        boolean = true;
      }
      else if(this.username != '' && this.error_username != '') { this.vacio_username = ''; boolean = true;}
      else if(this.username != '' && this.error_username == '')
      {
        this.vacio_username = '';
        this.error_username = '';
      }

      if(this.email == '' && this.error_email == '' )
      { 
        this.vacio_email = 'Campo obligatorio';
        this.error_email = '';
        boolean = true;
      }
      else if(this.email != '' && this.error_email != '') { this.vacio_email = ''; boolean = true;}
      else if(this.email != '' && this.error_email == '')
      {
        this.vacio_email = '';
        this.error_email = '';
      }

      if(this.password == '' && this.error_password == '')
      { 
        this.vacio_pass = 'Campo obligatorio';
        this.error_password = '';
        boolean = true;
      }
      else if(this.password != '' && this.error_password != '') { this.vacio_pass = ''; boolean = true;}
      else if(this.password != '' && this.error_password == '')
      {
        this.vacio_pass = '';
        this.error_password = '';
      }

      if(this.repeat_password == '' && this.error_repeat_password == '')
      { 
        this.vacio_repeat_pass = 'Campo obligatorio';
        this.error_repeat_password = '';
        boolean = true;
      }
      else if(this.repeat_password != '' && this.error_repeat_password != '') { this.vacio_repeat_pass = ''; boolean = true;}
      else if(this.repeat_password != '' && this.error_repeat_password == '')
      {
        this.vacio_repeat_pass = '';
        this.error_repeat_password = '';
      }

      if(boolean) return;
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
        type: "success",
        duration: 10000,
        dismissible: true,
      });

      //Redireccionamiento de rutas
      if (this.identifier == "trabajador") this.$router.push("/login/employee");
      else this.$router.push("/login/customer");
    },
  },
};
</script>