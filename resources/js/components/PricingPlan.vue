<template>
<!--Sección del componente PricingPlan donde se observa los diferentes planes de pago para mantener la publicación del servicio.-->  
  <div class=" max-w-full px-6">
      <h1
        class="text-center text-2xl text-black font-medium leading-snug tracking-wider pt-5"
      >
        Elige el servicio a tu medida
      </h1>
      <p class="text-center text-md text-gray-700 mt-1 px-6">
        Genera más ganancias teniendo un alcance mayor con la cantidad de
        publicaciones de servicio.
      </p>
      <div class="h-1 mx-auto bg-indigo-200 w-24 opacity-75 mt-4 rounded"></div>

      <div class="max-w-full md:max-w-6xl mx-auto my-3 md:px-8">
        <div class="relative block flex flex-col md:flex-row items-center grid grid-cols-1 sm:grid-cols-2 gap-20">
          
          <!-- Primer plan de pago -->
          <div
            class=" w-full sm:my-5 my-8 relative z-0 rounded-lg shadow-none md:-mr-4 px-20-"
          >
            <div
              class="bg-white mx-5 text-black rounded-lg shadow-xl shadow-lg overflow-hidden "
            >
              <div
                class="text-sm leading-none rounded-t-lg bg-blue-100 text-black font-semibold uppercase py-4 text-center tracking-wide border-dashed border-2 border-light-blue-500"
              >
                Más popular
              </div>

              <div
                class="block text-center text-sm max-w-sm mx-auto mt-2 text-black px-8 lg:px-6 "
              >
                <h1
                  class="text-lg font-medium uppercase p-3 pb-0 text-center tracking-wide"
                >
                  PLAN BÁSICO
                </h1>
                <h2 class="text-sm text-gray-500 text-center pb-6">
                  <span class="text-3xl">CINCO</span> PUBLICACIONES
                </h2>

                Recomendamos a todos los trabajadores que van a publicar
                servicios por primera vez, empezar por la prueba gratuita de 15
                días y 3 publicaciones con la opción de migrar a un plan mayor
                de ser necesario.
              </div>

                <div class="block text-center text-5xl max-w-sm mx-auto mt-2 text-gray-700 px-8 lg:px-6">
                    USD 15.00
                </div>

              <div class="block flex items-center p-8 uppercase">
                <router-link to="payment" class="w-full">
                <button
                  class="mt-3 text-lg font-semibold bg-blue-700 w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:bg-gray-700"
                >
                  COMPRAR
                </button>
                </router-link>
              </div>
            </div>
          </div>

        <!-- Segundo plan de pago -->
          <div
            class="w-full sm:my-5 my-8 relative z-0 rounded-lg shadow-none md:-ml-4 "
          >
            <div
              class="bg-white mx-5 text-black rounded-lg shadow-xl shadow-lg overflow-hidden"
            >
              <div
                class="block text-center text-sm max-w-sm mx-auto mt-2 text-black px-8 lg:px-6"
              >
                <h1
                  class="text-lg font-medium uppercase p-3 pb-0 text-center tracking-wide"
                >
                  PLAN AVANZADO
                </h1>
                <h2 class="text-sm text-gray-500 text-center pb-6">
                    <span class="text-3xl">QUINCE</span> PUBLICACIONES
                  </h2>

                Si necesitas mayor tiempo de publicación de servicio puedes
                migrar al siguiente plan que permite 15 publicaciones. Los días
                de publicación van de acuerdo con la cantidad de servicios que
                desee publicar.
              </div>
              <div class="flex flex-wrap mt-3 px-6">
                <div class="block text-center text-5xl max-w-sm mx-auto mt-2 text-gray-700 px-8 lg:px-6">
                    USD 60.00
                </div>
              </div>

              <div class="block flex items-center p-8 uppercase">
                <router-link to="payment" class="w-full">
                <button
                  class="mt-3 text-lg font-semibold bg-blue-700 w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:bg-gray-700"
                >
                  COMPRAR
                </button>
                </router-link>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>