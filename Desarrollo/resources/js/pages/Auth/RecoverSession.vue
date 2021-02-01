<template>
  <!-- RECOVER SESSION: Vista de interfaz de recuperacion de sesion de los usuarios
       Solo accesible por el enlace, y valido al correo enviado.-->
  <Visitor>
    <Loader class="min-h-screen"
            :load="loading"
    />
    
    <main v-show="!loading" class="min-h-screen flex flex-col justify-center pt-2 pb-4 bg-gray-100">
      <div class="md:text-center md:flex-col md:flex md:justify-center md:items-center">
        <img class="h-48 sm:h-56 px-6 w-auto mt-4" src="../../../assets/illustrations/forgot-pass.png" alt="forgot-pass" />
        <p class="uppercase px-5 mt-4 text-2xl md:text-3xl font-extrabold text-gray-900"
        >Recuperar Sesión </p>
        <p class="px-5 text-sm">Estas recuperando sesión como <b class="text-base2 italic">{{identifier}}</b></p>
      </div>

      <div class="sm:mx-auto sm:w-full sm:max-w-md mt-4 mb-4 sm:mb-6 md:mb-8">
        <div class="bg-white pb-4 pt-6 shadow rounded-lg mx-3 px-1 sm:px-10">
          <div class="grid grid-cols-1 col-gap-4 row-gap-5 mx-5 sm:mx-1">
            <!-- Sección de ingreso de correo.
            Solicita un correo electrónico y lo valida.-->
            <div class="sm:col-span-2">
              <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Correo</label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  id="email"
                  v-model="email"
                  placeholder="Ingrese su correo"
                  type="text"
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
            <!-- Fin de sección de ingreso de correo. -->
                              
            <!-- Sección de ingreso de DNI.
            Solicita el DNI y lo valida. --> 
            <div v-if="identifier == 'trabajador'" class="sm:col-span-2">
              <label for="input_dni" class="block text-sm font-medium leading-5 text-gray-700">DNI</label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese su DNI"
                  id="input_dni"
                  v-model="dni"
                  type="text"
                  inputmode="numeric"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                  maxlength="8"
                  pattern="[0-9]*"
                  @change="validateDNI()"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
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

            <!-- Sección de ingreso de RUC.
            Solicita el RUC y lo valida.-->
            <div v-if="identifier == 'empresa'" class="sm:col-span-2">
              <label for="input_ruc" class="block text-sm font-medium leading-5 text-gray-700">RUC</label>
              <div class="mt-1 rounded-md shadow-sm">
                <input
                  placeholder="Ingrese su RUC"
                  type="text"
                  id="input_ruc"
                  v-model="ruc"
                  inputmode="numeric"
                  onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                  maxlength="11"
                  pattern="[0-9]*"
                  @change="validateRUC()"
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
            <div class="sm:col-span-2">
              <label for="password" class="block text-sm font-medium leading-5 text-gray-700">Contraseña</label>
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

            <!-- Solicita repetir la contraseña y la valida. -->
            <div class="sm:col-span-2">
              <label for="repeat_password" class="block text-sm font-medium leading-5 text-gray-700">Repetir Contraseña</label>
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
            <!-- Fin de sección de ingreso de contraseña. -->
          </div>

          <div class="mt-8 mb-8">
            <span class="block w-2/3 mx-auto rounded-md shadow-sm">
              <AnimatedButton
                content="Actualizar"
                color="gradiente"
                @onClick="submitPass()"
                :isLoading="buttonLoading"
              ></AnimatedButton>
            </span>
          </div>
        </div>
      </div>
    </main>
  </Visitor>
</template>

<script>
import api from "../../api";

import Visitor from "../Layouts/Visitor";
import Loader from "../../components/Loader.vue";
import AnimatedButton from "../../components/AnimatedButton.vue";

export default {
  name: "RecoverSession",
  components: 
  {
    Visitor,
    AnimatedButton,
    Loader
  },
  data: () => 
  {
    return {
      loading: false,
      buttonLoading: false,
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
  props: 
  {
    code: String,
    identity: String
  },
  async created() 
  {
    this.loading = true;

    if(this.identity == 'cliente') this.identifier = 'cliente';
    else if(this.identity == 'trabajador') this.identifier = 'trabajador';
    else if(this.identity == 'empresa') this.identifier = 'empresa';
    else { this.$router.push("/**"); return; }
    
    let response = await api.get(`/reset/validate/${this.code}/${this.identifier}`)
    if(response.data.data == 0)
    {
      this.$toast.open({
        message: "Enlace no válido o caducado...",
        type: "error",
        duration: 8000,
        dismissible: true,
      });

      this.$router.push("/");
      return;
    }

    this.loading = false;
  },
  methods: 
  {
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
    validateDNI() 
    {
      this.error_dni = '';
      this.vacio_dni = '';

      if(this.dni == ''){return;}

      if ((this.dni.length > 0 && this.dni.length < 8)) 
      {
        this.error_dni = "El DNI debe tener 8 dígitos";
        this.vacio_dni = "";
      }
    },
    validateRUC() 
    {
      this.error_ruc = '';
      this.vacio_ruc = '';
      
      if(this.ruc == ''){return;}

      if ((this.ruc.length > 0 && this.ruc.length < 11)) 
      {
        this.error_ruc = 'El RUC debe tener 11 dígitos';
        this.vacio_ruc = '';
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
    async submitPass() 
    {
      this.validateEmail();
      if(this.identifier == "empresa") { this.validateRUC(); }
      if(this.identifier == "trabajador") { this.validateDNI(); }
      this.validatePassword();
      this.validateRepeatPassword();
      var boolean = false;

      if(this.email == "" && this.error_email == "" )
      { 
        this.vacio_email = "Campo obligatorio";
        this.error_email = "";
        boolean = true;
      }
      else if(this.email != "" && this.error_email != "") { this.vacio_email = ""; boolean = true;}
      else if(this.email != "" && this.error_email == "")
      {
        this.vacio_email = "";
        this.error_email = "";
      }

      if(this.identifier == "empresa")
      {
        if(this.ruc == "" && this.error_ruc == "" )
        { 
          this.vacio_ruc = "Campo obligatorio";
          this.error_ruc = "";
          boolean = true;
        }
        else if(this.ruc != "" && this.error_ruc != "") { this.vacio_ruc = ""; boolean = true;}
        else if(this.ruc != "" && this.error_ruc == "")
        {
          this.vacio_ruc = "";
          this.error_ruc = "";
        }
      }

      if(this.identifier == "trabajador")
      {
        if(this.dni == "" && this.error_dni == "" )
        { 
          this.vacio_dni = "Campo obligatorio";
          this.error_dni = "";
          boolean = true;
        }
        else if(this.dni != "" && this.error_dni != "") { this.vacio_dni = ""; boolean = true;}
        else if(this.dni != "" && this.error_dni == "")
        {
          this.vacio_dni = "";
          this.error_dni = "";
        }
      }

      if(this.password == "" && this.error_password == "" )
      { 
        this.vacio_pass = "Campo obligatorio";
        this.error_password = "";
        boolean = true;
      }
      else if(this.password != "" && this.error_password != "") { this.vacio_pass = ""; boolean = true;}
      else if(this.password != "" && this.error_password == "")
      {
        this.vacio_pass = "";
        this.error_password = "";
      }

      if(this.repeat_password == "" && this.error_repeat_password == "" )
      { 
        this.vacio_repeat_pass = "Campo obligatorio";
        this.error_repeat_password = "";
        boolean = true;
      }
      else if(this.repeat_password != "" && this.error_repeat_password != "") { this.vacio_repeat_pass = ""; boolean = true;}
      else if(this.repeat_password != "" && this.error_repeat_password == "")
      {
        this.vacio_repeat_pass = "";
        this.error_repeat_password = "";
      }

      if(boolean == true) { return; }
      this.buttonLoading = true;

      let response = await api.post(`/changepass`, {
        identity: this.identifier,
        email: this.email,
        dni: this.dni,
        ruc: this.ruc,
        password: this.password
      });

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

      this.$toast.open({
        message: response.data.data.success[0],
        type: "success",
        duration: 10000,
        dismissible: true,
      });

      var user = null;
      if(this.identifier == 'cliente') user = 'customer';
      else if(this.identifier == 'trabajador') user = 'employee';
      else user = 'enterprise';
      
      this.$router.push("/login/" + user);
    }
  },
};
</script>