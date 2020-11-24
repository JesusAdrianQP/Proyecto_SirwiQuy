<template>
  <!-- JOIN US: Vista de trabaja con nosotros.
  Permite seleccionar un tipo de proveedor (trabajador independiente
  o empresa) para que se registre en la plataforma. -->
  <Visitor>
    <main>
      <div class="relative bg-white overflow-hidden">
        <div class="max-w-screen-xl lg:w-1/2">
          <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <!--Forma principal del efecto poligonal-->
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
              <polygon points="50,0 100,0 50,100 0,100" />
            </svg>
            <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
            </div>
            <!--Contenido del landing page-->
            <main class="mt-2 max-w-screen-xl px-4 sm:mt-4 sm:px-6 md:mt-8 lg:mt-20 lg:px-8 xl:mt-28">
              <div class="">
                <h2 class="uppercase text-5xl tracking-tight leading-10 font-extrabold text-gray-900 sm:leading-none md:text-6xl">Trabaja con
                <br class="xl:hidden" /><span class="text-primary-600">nosotros </span>
                </h2>

                <p class="my-8 lg:pr-8 text-base text-gray-600 sm:my-7 sm:text-lg sm:max-w-xl md:my-8"
                >
                  <b>¡Somos <i>SirwiyQuy</i>, un hogar para ofrecer tus servicios!</b> <br>
                  Registrate, publica y revisa tus notificaciones, 3 pasos sencillos para obtener ganancias<br>
                  Elige si eres un trabajador independiente o una empresa! ¿Que esperas? Únete, el éxito te esta esperando
                </p>

                <div class="lg:hidden my-10 -mx-20">
                  <img class="h-66 w-full object-cover sm:h-68 md:h-72" src="../../assets/JoinUsPhoto.jpg" alt="JoinUsPhoto">
                </div>

                <!--Botones de redireccionamiento-->
                <div class="sm:grid sm:gap-8 sm:grid-cols-2 mt-5 sm:mt-10 px-4 lg:pr-10 mx-4 sm:justify-center h-full">
                  <!-- Sección de trabajador independiente.
                  Te redirige a la vista de registro "SingUpIndie". --> 
                  <div class="sm:w-full">
                    <router-link to="/signup/indie/employee">
                      <div
                        class="transition ease-in-out duration-150 border-gray-300 border-dashed border-4 hover:border-solid hover:border-primary-400 hover:bg-gray-100 cursor-pointer overflow-hidden rounded-lg"
                      >
                        <div class="px-4 py-5 sm:p-6 text-center text-base">
                          <IconSvg
                            :solid="true"
                            icon="user"
                            myClass="h-16 w-16 mx-auto mb-2 text-gray-800"
                          />
                          Trabajador
                        </div>
                      </div>
                    </router-link>

                    <div class="text-center justify-between">
                      
                        <span class="">¿Ya tienes cuenta? <br></span>
                        <router-link
                          to="/login/employee"
                          class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                        >
                            ¡Inicia sesión!
                        </router-link>
                    </div>
                  </div>
                  <!-- Fin de sección de trabajador independiente. --> 

                  <!-- Sección de empresa. -->
                  <div class="mt-8 sm:mt-0 sm:w-full">
                    <router-link to="/signup/enterprise">
                      <div
                        class="transition ease-in-out duration-150 border-gray-300 border-dashed border-4 hover:border-solid hover:border-primary-400 hover:bg-gray-100 cursor-pointer overflow-hidden rounded-lg mt-4 sm:mt-0"
                      >
                        <div class="px-4 py-5 sm:p-6 text-base text-center mx-auto">
                          <IconSvg
                            :solid="true"
                            icon="office-building"
                            myClass="h-16 w-16 mx-auto mb-2 text-gray-800"
                          />
                          Empresa
                        </div>
                      </div>
                    </router-link>

                    <div class="text-center justify-between">
                      <span class="font-medium">¿Ya tienes cuenta? <br></span>
                        <router-link
                          to="/login/enterprise"
                          class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                        >
                            ¡Inicia sesión!
                        </router-link>
                    </div>
                  </div>
                  <!-- Fin de sección de empresa. --> 

                </div>

              </div>
            </main>
          </div>
        </div>
        <div class="hidden lg:block lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
          <img class="lg:w-full lg:h-full object-cover " src="../../assets/JoinUsPhoto.jpg" alt="JoinUsPhoto">
        </div>
      </div>
    </main>
  </Visitor>
</template>

<script>
import IconSvg from "../components/IconSvg";
import Visitor from "./Layouts/Visitor";

export default {
  name: "JoinUs",
  components: {
    IconSvg,
    Visitor
  }
}
</script>