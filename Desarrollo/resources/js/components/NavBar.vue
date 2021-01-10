<template>
  <!-- 
    NAVBAR: Cabecera principal del sistema
    Aquí se encuentra todos los datos principales del sistema
  -->
  <nav class="bg-white border-b border-gray-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-6">
      <div class="flex justify-between h-16">
        <!--Navbar en vista de laptop-->
        <div class="flex">
          <div class="flex-shrink-0 flex items-center">
            <a href="/">
              <img
                class="hidden lg:block h-16 w-auto"
                src="../../assets/Logo_Sirwi_b.png"
                alt="logo"
              />
              <img
                class="block lg:hidden h-12 w-auto"
                src="../../assets/Sirwiyquy_b_house.png"
                alt="logo"
              />
            </a>
          </div>

          <div class="hidden sm:-my-px sm:ml-4 lg:flex">
            <NavBarOption title="Inicio" url="/" :icon="{ icon: 'home', solid: true }" />
            <NavBarOption  v-if="!isCustomer" title="Trabaja con Nosotros" url="/join_us" :icon="{ icon: 'briefcase', solid: true }"/>
            <NavBarOption title="Ayuda" url="/customer/blank" :icon="{ icon: 'question-mark-circle', solid: true }"/>
            <NavBarOption  v-if="isCustomer" title="Mis servicios" url="/customer/report/service" :icon="{ icon: 'briefcase', solid: true }"/>
          </div>
        </div>

        <div class="hidden sm:ml-4 lg:flex sm:items-center">
          <router-link       
            v-if="!isCustomer"     
            to="/login/customer"
            class="flex w-full rounded-md shadow-sm sm:w-auto"
          >
            <button
              type="button"
              class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary transition ease-in-out duration-150 sm:text-sm sm:leading-5"
            >Ingresar</button>
          </router-link>

          <router-link            
            v-if="!isCustomer"
            to="/signup/indie/customer"
            class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:ml-2 sm:w-auto"
          >
            <button
              type="button"
              class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
            >Crear Cuenta</button>
          </router-link>

          <!-- Perfil de inicio de sesión -->
          <div class="ml-3 relative" v-if="isCustomer">
            <div>
              <button
                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none transition duration-150 ease-in-out"
                id="user-menu"
                aria-label="User menu"
                aria-haspopup="true"
                @click="profileOpen=!profileOpen"
                v-on-clickaway="closeProfile"
              >
                <!-- @click="profileOpen=!profileOpen": Es para constatar que se abra las opciones del menú de perfil-->
                <img class="h-8 w-8 object-cover rounded-full" :src="foto" alt="Perfil" />
                <div class="ml-3">
                  <p
                    class="text-sm leading-5 font-medium text-gray-700 group-hover:text-gray-900"
                  >Bienvenido</p>
                  <p
                    class="text-xs leading-4 font-medium text-gray-500 group-hover:text-gray-700 group-focus:underline transition ease-in-out duration-150"
                  >{{usuario}}</p>
                </div>
                <IconSvg :solid="false" icon="chevron-down" myClass="h-5 w-5 ml-2 mt-2" />
              </button>
            </div>

            <!--Cuando abre el componente-->
            <div
              class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg"
              v-show="profileOpen"
            >
              <div
                class="py-1 rounded-md bg-white shadow-xs"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="user-menu"
              >
                <router-link
                  to="/customer/blank"
                  class="flex items-center cursor-pointer px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                  role="menuitem"
                >
                  <IconSvg :solid="false" icon="cog" class="h-6 w-6 mr-2 text-gray-400" />Ver perfil
                </router-link>

                <router-link
                  to="/customer/blank"
                  class="flex items-center cursor-pointer px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                  role="menuitem"
                >
                  <IconSvg :solid="false" icon="cog" class="h-6 w-6 mr-2 text-gray-400" />Cuenta
                </router-link>

                <a
                  @click="logout"
                  class="flex items-center cursor-pointer px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                  role="menuitem"
                >
                  <IconSvg :solid="false" icon="logout" class="h-6 w-6 mr-2 text-gray-400" />Cerrar sesión
                </a>
              </div>
            </div>
          </div>
        </div>
        <!------------ Fin de la seccion ----------------->

        <!--Icono de la navbar con menu movil-->
        <div class="-mr-2 flex items-center lg:hidden">
          <button
            @click="isMenu()"
            class="inline-flex items-center justify-center p-2 rounded-md text-primary-500 hover:text-primary-300 hover:bg-primary-100 focus:outline-none focus:bg-primary-100 focus:text-primary-500 transition duration-1000 ease-in-out"
          >
            <div class="wrapper-menu">
              <div class="line-menu half start"></div>
              <div class="line-menu"></div>
              <div class="line-menu half end"></div>
            </div> 
          </button>
        </div>
      </div>
    </div>
    
    <!--
      Menu mobil | Open: "block", closed: "hidden"
    -->
    <div :class="isOpen ? 'block' : 'hidden'" class="lg:hidden ">
      <div class="pt-2 pb-3">
        <router-link
          to="/"
          class="block pl-3 pr-4 py-2 border-l-4 border-primary-500 text-md font-medium text-primary-700 bg-primary-50 focus:outline-none focus:text-primary-800 focus:bg-primary-100 focus:border-primary-700 transition duration-150 ease-in-out"
        >Inicio</router-link>

        <router-link
            v-if="!isCustomer"
          to="/join_us"
          class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-md font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
        >Trabaja con Nosotros</router-link>

        <router-link
          v-if="isCustomer"
          to="/customer/report/service"
          class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-md font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
        >Mis servicios</router-link>
        
        <router-link
          to="/customer/blank"
          class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-md font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
        >Ayuda</router-link>
      </div>

      <div class="pt-4 pb-3 border-t border-gray-300">
        <div class="mt-3" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
          <router-link
            v-if="!isCustomer"
            to="/login/customer"
            class="mt-1 block px-4 py-2 text-lg font-bold text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            role="menuitem"
          >Ingresar</router-link>
          <router-link
              v-if="!isCustomer"
            to="/signup/indie/customer"
            class="mt-1 block px-4 py-2 text-lg font-bold text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            role="menuitem"
          >Crear cuenta</router-link>
        </div>
        
        <div v-if="isCustomer">
          <div class="flex items-center px-4">
            <div class="flex-shrink-0">
              <img class="h-10 w-10 object-cover rounded-full" :src="foto" alt="Perfil" />
            </div>
            <div class="ml-3">
              <div class="text-md font-medium leading-6 text-gray-800">Bienvenido</div>
              <div class="text-base font-medium leading-5 text-gray-500">{{usuario}}</div>
            </div>
          </div>

          <div class="mt-3">
            <router-link
              to="/customer/blank"
              class="block px-4 py-2 text-md font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            >Ver perfil</router-link>

            <router-link
              to="/customer/blank"
              class="block px-4 py-2 text-md font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            >Cuenta</router-link>

            <a
              @click="logout"
              class="mt-1 block px-4 py-2 text-md font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            >Cerrar sesión</a>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import IconSvg from "./IconSvg.vue";
import NavBarOption from "./NavBarOption.vue";
import api from "../api";
import { mixin as clickaway } from "vue-clickaway";

export default {
  mixins: [clickaway],
  components: {
    IconSvg,
    NavBarOption,
  },
  data: () => {
    return {
      isOpen: false,
      profileOpen: false
    };
  },
  props: {
    isCustomer: Boolean,
    usuario: String,
    foto: String
  },
  methods: {
    isMenu(){
      if(this.isOpen == false) this.isOpen = true;
        else this.isOpen = false;

      this.$el.querySelector('.wrapper-menu').classList.toggle("open");
    },
    closeProfile: function () {
      if (this.profileOpen) this.profileOpen = false;
    },
    async logout(){
      await api.post(`/changeAccess`, {
        level: localStorage.getItem('e_level'),
        token: localStorage.getItem('token')
      });

      localStorage.removeItem('token');
      localStorage.removeItem('e_level');
      
      window.location.reload();
    }
  },
};
</script>