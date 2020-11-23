<template>
  <div class="h-screen flex overflow-hidden bg-gray-100">
  <!-- Off-canvas menu for mobile -->
  <div class="md:hidden">
    
    <div v-show="isOpen" class="fixed inset-0 flex z-40">
      <transition
        enter-active-class="transition-opacity ease-linear duration-300"
        enter-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition-opacity ease-linear duration-300"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
      >
      <div v-show="isOpen" class="fixed inset-0">
        <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
      </div>
      </transition>
      <transition
        enter-active-class="transition ease-in-out duration-300 transform"
        enter-class="-translate-x-full"
        enter-to-class="translate-x-0"
        leave-active-class="transition ease-in-out duration-300 transform"
        leave-class="translate-x-0"
        leave-to-class="-translate-x-full"
      >
      <div v-show="isOpen" class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
        <div class="absolute top-0 right-0 -mr-14 p-1">
          <button @click="isOpen=false" class="flex items-center justify-center h-12 w-12 rounded-full focus:outline-none focus:bg-gray-600" aria-label="Close sidebar">
            <svg class="h-6 w-6 text-white" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
          <div class="flex-shrink-0 flex items-center px-4">
            <img class="h-12 w-auto" src="../../assets/Logo_Sirwi_b.png" alt="Workflow" />
          </div>
          <nav class="mt-5 px-2">
            <SideBarOptions/>
          </nav>
        </div>
        <!--SOLO APARECE PARA TRABAJADORES INDEPENDIENTES-->
        <div v-if="acceso == 'employee'" class="flex-shrink-0 flex border-t border-gray-200 p-4">
          <router-link to="/worker/profile/edit" class="flex-shrink-0 group block focus:outline-none">
            <div class="flex items-center">
              <div>
                <img class="inline-block h-10 w-10 rounded-full" :src="image" alt="" />
              </div>
              <div class="ml-3">
                <p class="text-base leading-6 font-medium text-gray-700 group-hover:text-gray-900">
                  {{username}}
                </p>
                <p class="text-sm leading-5 font-medium text-gray-500 group-hover:text-gray-700 group-focus:underline transition ease-in-out duration-150">
                  Ver perfil
                </p>
              </div>
            </div>
          </router-link>
        </div>
        <!--FIN DE SECCIÓN-->

        <!--SOLO APARECE PARA ENTERPRISE-->
        <div v-if="acceso == 'enterprise'" class="flex-shrink-0 border-t border-gray-200 p-4">
          <div class="flex items-center">
            <div>
              <img class="inline-block h-9 w-9 rounded-full" :src="image_enter" alt="" />
            </div>
            <div class="ml-3">
              <p class="text-sm leading-5 font-medium text-gray-700 group-hover:text-gray-900">
                {{username}}
              </p>
            </div>
          </div>
        </div>
        <!--FIN DE SECCIÓN-->
        
      </div>
      </transition>
      <div class="flex-shrink-0 w-14">
        <!-- Force sidebar to shrink to fit close icon -->
      </div>
    </div>
  </div>

  <!-- Static sidebar for desktop -->
  <div class="hidden md:flex md:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
      <div class="h-0 flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
        <div class="flex items-center flex-shrink-0 px-4">
          <img class="h-12 w-auto" src="../../assets/Logo_Sirwi_b.png" alt="Workflow" />
        </div>
        <!-- Sidebar component, swap this element with another sidebar if you like -->
        <nav class="mt-5 flex-1 px-2 bg-white">
          <SideBarOptions/>
        </nav>
      </div>

      <!--SOLO APARECE PARA TRABAJADORES INDEPENDIENTES-->
      <div v-if="acceso == 'employee'" class="flex-shrink-0 border-t border-gray-200 p-4">
        <router-link to="/worker/profile/edit" class="flex-shrink-0 group block">
          <div class="flex items-center">
            <div>
              <img class="inline-block h-9 w-9 rounded-full" :src="image" alt="" />
            </div>
            <div class="ml-3">
              <p class="text-sm leading-5 font-medium text-gray-700 group-hover:text-gray-900">
                {{username}}
              </p>
              <p class="text-xs leading-4 font-medium text-gray-500 group-hover:text-gray-700 transition ease-in-out duration-150">
                Ver perfil
              </p>
            </div>
          </div>
        </router-link>
      </div>
      <!--FIN DE SECCION-->

      <!--SOLO APARECE PARA ENTERPRISE-->
      <div v-if="acceso == 'enterprise'" class="flex-shrink-0 border-t border-gray-200 p-4">
        <div class="flex items-center">
          <div>
            <img class="inline-block h-9 w-9 rounded-full" :src="image_enter" alt="" />
          </div>
          <div class="ml-3">
            <p class="text-sm leading-5 font-medium text-gray-700 group-hover:text-gray-900">
              {{username}}
            </p>
          </div>
        </div>
      </div>
      <!--FIN DE SECCION-->
    </div>
  </div>
  <div class="flex flex-col w-0 flex-1">
    <div class="md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3">
      <button @click="isOpen=true;" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:bg-gray-200 transition ease-in-out duration-150" aria-label="Open sidebar">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
    </div>
    <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
      <div class="pt-2 relative min-h-full pb-12 md:pt-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
          <h1 class="text-2xl font-semibold text-gray-900">{{title}}</h1>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
          <div class="py-4">
            <slot></slot>
          </div>
        </div>
        <Footer/>
      </div>
    </main>
  </div>
</div>
</template>

<script>
import SideBarOptions from './SideBarOptions'
import Footer from "../containers/Footer";

export default {
  name: 'NavMenu',
  components: {
    SideBarOptions,
    Footer,
  },
  props: {
    title: String
  },
  data: () => {
    return {
      isOpen: false,
      acceso: localStorage.getItem("e_level"),
      username: localStorage.getItem("e_username"),
      image: localStorage.getItem("e_file"),
      image_enter: localStorage.getItem("e_file_admi")
    }
  }
}
</script>