<template>
  <div class="mb-4 sm:mb-2 lg:mb-5">
    <!--SECCIÓN DE LA TARJETA DE SERVICIO (DETALLES GENERALES)-->
    <div class="h-full">
      <div class="max-w-md sm:max-w-2xl lg:max-w-lg2 m-auto sm:mx-auto">
        <div style="border-radius: 0.7rem;" class="bg-white shadow-xl overflow-hidden sm:flex sm:h-58 md:h-59 lg:h-57 border-gray-400 border-t border-b">
          <!--Image de la tarjeta-->
          <div class="bg-cover h-40 sm:h-auto sm:w-1/3" :style="{backgroundImage: 'url(\''+file+'\')'}">
          </div>
          <!--Detalles resumidos del servicio dado-->
          <div class="w-full sm:w-2/3">
            <div class="p-4 sm:py-2 md:px-5 md:pt-3 md:pb-2">
              <p class="titulo font-bold text-xl mb-2 md:mb-1 md:text-2xl">{{title}}</p>
              <p class="whitespace-pre-line description text-gray-700 text-sm">{{description}}</p>
            </div>
              
            <div class="px-4 py-2 md:py-3 lg:py-1 bg-gray-100">
              <div class="sm:flex sm:justify-between sm:items-center">
                <div class="w-full">
                  <div class="flex items-center mb-1">
                    <IconSvg :solid="true" icon="location-marker" class="h-5 w-5 text-teal-500"/>
                    <div class="text-sm ml-1">
                      <p class="text-gray-900 mt-1 leading-none">{{district}}</p>
                    </div>
                  </div>

                  <div class="flex items-center">
                    <div class="inline-flex -mx-px">
                      <svg v-for="star in 5" v-bind:key="star.id" class="w-4 h-4 mx-px fill-current" :class="{'text-yellow-500': (star <= supplier_rating), 'text-gray-900':!(star <= supplier_rating)}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                       <path d="M6.43 12l-2.36 1.64a1 1 0 0 1-1.53-1.11l.83-2.75a1 1 0 0 0-.35-1.09L.73 6.96a1 1 0 0 1 .59-1.8l2.87-.06a1 1 0 0 0 .92-.67l.95-2.71a1 1 0 0 1 1.88 0l.95 2.71c.13.4.5.66.92.67l2.87.06a1 1 0 0 1 .59 1.8l-2.3 1.73a1 1 0 0 0-.34 1.09l.83 2.75a1 1 0 0 1-1.53 1.1L7.57 12a1 1 0 0 0-1.14 0z" /></svg>
                    </div>
                    <div class="text-gray-600 ml-2 text-sm mt-1">{{supplier_rating}} estrella(s)</div>
                  </div>
                    
                  <div class="my-4 sm:my-2 lg:my-1 flex items-center w-full">
                    <div class="w-2/3 text-lg text-gray-700 font-semibold">
                      Desde S/ {{price.toFixed(2)}}
                    </div>
              
                    <router-link to="/customer/blank" class="w-1/3">
                      <button class="rounded-full bg-primary-500 text-white hover:bg-indigo-700 hover:shadow-xl focus:outline-none w-10 h-10 flex ml-auto transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-current m-auto">
                          <line x1="12" y1="5" x2="12" y2="19"></line>
                          <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                      </button>
                    </router-link>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--FIN DE LA SECCIÓN-->
</template>

<script>
import IconSvg from "./IconSvg.vue";

export default {
  name: "ServiceCard",
  components: {
    IconSvg
  },
  props: {
    service_id: String,
    file: String,
    title: String,
    description: String,
    district: String,
    supplier_rating: Number,
    price: Number
  },
  data: () => {
    return {
      star: 1,
    };
  },
}
</script>