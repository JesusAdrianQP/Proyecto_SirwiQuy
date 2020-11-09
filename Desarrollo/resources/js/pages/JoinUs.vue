<template>
  <!-- JOIN US: Vista de trabaja con nosotros.
  Permite seleccionar un tipo de proveedor (trabajador independiente
  o empresa) para que se registre en la plataforma. -->
  <Visitor>
    <main class="">
      <div class="relative bg-white overflow-hidden">
        <div class="max-w-screen-xl mx-auto">
          <div class="relative z-10 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
            <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
              <polygon points="50,0 100,0 50,100 0,100" />
            </svg>

            <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
            </div>

            <main class="mt-10 mx-auto max-w-screen-xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
              <div class="sm:text-center">
                <h2
                  class="text-4xl tracking-tight leading-10 font-extrabold text-gray-900 sm:text-5xl sm:leading-none md:text-6xl"
                >
                  Trabaja con
                  <br class="xl:hidden" />
                  <span class="text-primary-600">nosotros </span>
                </h2>
                <p
                  class="mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-8 md:text-xl"
                >
                  Somos SirwiyQuy, un hogar para ofrecer tus servicios! Somos la opción que estabas buscando,
              con nuestro sistema podrás obtener ganancias a través de tus servicios ofrecidos en menos de 5 días...
              Elige si eres un trabajador independiente o una empresa! ¿Que esperas? Únete, el éxito te esta esperando
                </p>
                <div class="mt-5 sm:mt-8 px-4 sm:flex sm:justify-center">
                  
                  <!-- Sección de trabajador independiente.
                  Te redirige a la vista de registro "SingUpIndie". --> 
                  <div>
                    <router-link to="/signup/indie/employee">
                      <div
                        class="transition ease-in-out duration-150 border-gray-300 border-dashed border-4 hover:border-solid hover:border-primary-400 hover:bg-gray-100 cursor-pointer overflow-hidden rounded-lg"
                      >
                        <div class="px-4 py-5 sm:p-6">
                          <IconSvg
                            :solid="true"
                            icon="user"
                            myClass="h-12 w-12 mx-auto mb-2 text-gray-800"
                          />
                          Trabajador Independiente
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
                  <div>
                    <router-link to="/signup/enterprise">
                      <div
                        class="transition ease-in-out duration-150 border-gray-300 border-dashed border-4 hover:border-solid hover:border-primary-400 hover:bg-gray-100 cursor-pointer overflow-hidden rounded-lg sm:ml-8 mt-4 sm:mt-0"
                      >
                        <div class="px-4 py-5 sm:p-6 w-48 text-center mx-auto">
                          <IconSvg
                            :solid="true"
                            icon="office-building"
                            myClass="h-12 w-12 mx-auto mb-2 text-gray-800"
                          />
                          Empresa
                        </div>
                      </div>
                    </router-link>

                    <div class="text-center justify-between">
                      <div class="text-base leading-5">
                        <span class="font-medium">¿Ya tienes cuenta? <br></span>
                        <router-link
                          to="/login/enterprise"
                          class="font-medium text-primary-600 hover:text-primary-500 focus:outline-none focus:underline transition ease-in-out duration-150"
                        >
                            ¡Inicia sesión!
                        </router-link>
                      </div>
                    </div>
                  </div>
                  <!-- Fin de sección de empresa. --> 

                </div>

              </div>
            </main>
          </div>
        </div>
        <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
          <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="../../assets/JoinUsPhoto.jpg" alt="JoinUsPhoto">
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