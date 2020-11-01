<template>
  <!-- 
    NAVBAR: Cabecera principal del sistema
    Aquí se encuentra todos los datos principales del sistema
  -->
  <nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-6">
      <div class="flex justify-between h-16">
        <div class="flex">
          <div class="flex-shrink-0 flex items-center">
            <router-link to="/">
              <img
                class="hidden lg:block h-10 w-auto"
                src="../../assets/logo_negro_1.png"
                alt="Workflow logo"
              />
            </router-link>
            <router-link to="/">
              <img
                class="block lg:hidden h-8 w-auto"
                src="../../assets/logo_negro_1.png"
                alt="Workflow logo"
              />
            </router-link>
          </div>
          <div class="hidden sm:-my-px sm:ml-4 lg:flex">
            <NavBarOption title="Inicio" url="/" :icon="{ icon: 'home', solid: true }" />
            <NavBarOption
              v-if="!isCustomer"
              title="Trabaja con Nosotros"
              url="/customer/blank"
              :icon="{ icon: 'briefcase', solid: true }"
            />
            <NavBarOption
              title="Ayuda"
              url="/customer/blank"
              :icon="{ icon: 'question-mark-circle', solid: true }"
            />
          </div>
        </div>

        <div class="hidden sm:ml-4 lg:flex sm:items-center">
          <router-link
            v-if="!isCustomer"
            to="/customer/blank"
            class="flex w-full rounded-md shadow-sm sm:w-auto"
          >
            <button
              type="button"
              class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary transition ease-in-out duration-150 sm:text-sm sm:leading-5"
            >Ingresar</button>
          </router-link>
          <router-link
            v-if="!isCustomer"
            to="/customer/blank"
            class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:ml-2 sm:w-auto"
          >
            <button
              type="button"
              class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
            >Crear Cuenta</button>
          </router-link>
        </div>
        </div>

        <div class="-mr-2 flex items-center lg:hidden">
          <!-- Mobile menu button -->
          <button
            @click="isOpen = !isOpen"
            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
          >
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg
              :class="isOpen ? 'hidden' : 'block'"
              class="h-6 w-6"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg
              :class="isOpen ? 'block' : 'hidden'"
              class="h-6 w-6"
              stroke="currentColor"
              fill="none"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!--
      Mobile menu | Open: "block", closed: "hidden"
    -->
    <div :class="isOpen ? 'block' : 'hidden'" class="lg:hidden">
      <div class="pt-2 pb-3">
        <router-link
          to="/"
          class="block pl-3 pr-4 py-2 border-l-4 border-primary-500 text-base font-medium text-primary-700 bg-primary-50 focus:outline-none focus:text-primary-800 focus:bg-primary-100 focus:border-primary-700 transition duration-150 ease-in-out"
        >Inicio</router-link>
        <router-link
          v-if="!isCustomer"
          to="/customer/blank"
          class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
        >Trabaja con Nosotros</router-link>
        <router-link
          to="/customer/blank"
          class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
        >Ayuda</router-link>
      </div>

      <div class="pt-4 pb-3 border-t border-gray-200">
        <div class="mt-3" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
          <router-link
            v-if="!isCustomer"
            to="/customer/blank"
            class="mt-1 block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            role="menuitem"
          >Ingresar</router-link>
          <router-link
            v-if="!isCustomer"
            to="/customer/blank"
            class="mt-1 block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            role="menuitem"
          >Crear cuenta</router-link>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import IconSvg from "./IconSvg.vue";
import NavBarOption from "./NavBarOption.vue";
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
    };
  },
  methods: {
    closeCategories: function () {
      if (this.categoriesOpen) this.categoriesOpen = false;
    },
  },
};
</script>