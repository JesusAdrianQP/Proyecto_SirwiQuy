<template>
  <div class="mb-4 sm:mb-2 lg:mb-5">
    <!--SECCIÓN DE LA TARJETA DE SERVICIO (DETALLES GENERALES)-->
    <div class="h-full">
      
      <div class="max-w-md sm:max-w-2xl lg:max-w-lg2 m-auto sm:mx-auto relative">
        <div v-if="isCustomer" class="w-full text-right absolute" style="top:-28px; left:2px">
          <button @click.prevent="getServiceFavorite()">
            <svg class="w-10 md:w-12" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
              <path :style="paint ? 'fill:#EC5569;':'fill:#DCE6EB;'" d="M407.252,8.241H103.623c-50.527,0-91.487,40.961-91.487,91.487v199.144
                c0,50.528,40.961,91.487,91.487,91.487h43.575c2.073,0,3.753,1.681,3.753,3.753v98.233c0,11.615,14.207,17.246,22.163,8.784
                l103.067-109.59c0.71-0.755,1.699-1.182,2.735-1.182h128.335c50.528,0,91.487-40.961,91.487-91.487V99.729
                C498.741,49.201,457.78,8.241,407.252,8.241z"/>
              <path style="fill:#DCE6EB;" d="M189.442,356.215c0-2.183-1.627-3.952-3.634-3.952h-42.185c-48.915,0-88.569-43.133-88.569-96.341
                V46.215c0-9.003,1.139-17.716,3.263-25.983C30.731,35.988,12.135,65.686,12.135,99.729v199.144
                c0,50.527,40.961,91.487,91.487,91.487h43.575c2.073,0,3.753,1.681,3.753,3.753v98.233c0,11.615,14.207,17.246,22.163,8.784
                l16.325-17.359V356.215H189.442z"/>
              <path style="fill:#EC5569;" d="M358.235,126.972L358.235,126.972c-23.228-23.228-60.888-23.228-84.116,0l-13.121,13.121
                c-3.128,3.128-8.201,3.128-11.33,0l-12.911-12.911c-23.228-23.228-60.888-23.228-84.116,0l0,0
                c-23.228,23.228-23.228,60.888,0,84.116l97.035,97.035c3.128,3.128,8.201,3.128,11.33,0l97.229-97.245
                C381.463,187.86,381.463,150.2,358.235,126.972z"/>
              <path style="fill:#FFF5F5;" d="M358.235,126.972L358.235,126.972c-23.228-23.228-60.888-23.228-84.116,0l-13.121,13.121
                c-3.128,3.128-8.201,3.128-11.33,0l-12.911-12.911c-23.228-23.228-60.888-23.228-84.116,0l0,0
                c-23.228,23.228-23.228,60.888,0,84.116l97.035,97.035c3.128,3.128,8.201,3.128,11.33,0l97.229-97.245
                C381.463,187.86,381.463,150.2,358.235,126.972z"/>
              <path style="fill:#DCE6EB;" d="M183.755,211.298c-23.228-23.228-23.228-60.888,0-84.116l0,0
                c7.619-7.619,16.795-12.723,26.501-15.343c-19.884-5.369-42.006-0.266-57.614,15.343l0,0c-23.228,23.228-23.228,60.888,0,84.116
                l97.035,97.035c3.128,3.128,8.201,3.128,11.33,0l9.89-9.892L183.755,211.298z"/>
              <path d="M407.815,0h-303.63c-21.379,0-41.736,6.707-58.87,19.394c-3.341,2.474-4.043,7.188-1.57,10.529
                c2.474,3.341,7.188,4.042,10.529,1.57c14.522-10.754,31.781-16.439,49.911-16.439h303.629c46.296,0,83.96,37.665,83.96,83.96
                v199.144c0,46.296-37.665,83.96-83.96,83.96H279.48c-3.101,0-6.097,1.296-8.217,3.553l-103.068,109.59
                c-2.225,2.364-4.805,1.693-5.81,1.296c-1.006-0.398-3.345-1.676-3.345-4.924V393.4c0-6.22-5.06-11.28-11.28-11.28h-43.575
                c-46.296,0-83.961-37.665-83.961-83.96V99.014c0-17.032,5.069-33.429,14.66-47.417c2.35-3.429,1.477-8.113-1.951-10.464
                c-3.427-2.351-8.114-1.476-10.464,1.951C11.153,59.59,5.171,78.93,5.171,99.014v199.144c0,54.596,44.418,99.014,99.015,99.014
                h39.801v94.461c0,8.398,5.044,15.824,12.851,18.918c2.461,0.975,5.017,1.449,7.543,1.449c5.489,0,10.84-2.237,14.78-6.425
                l101.95-108.402h126.704c54.596,0,99.014-44.418,99.014-99.014V99.014C506.829,44.418,462.412,0,407.815,0z"/>
              <path d="M331.001,227.529c-2.94,2.94-2.94,7.706,0.001,10.644c2.94,2.939,7.706,2.94,10.644-0.001l22.473-22.476
                c26.124-26.125,26.124-68.636-0.001-94.761c-26.124-26.125-68.635-26.123-94.761,0l-13.119,13.12
                c-0.035,0.035-0.144,0.143-0.344,0.143c-0.2,0-0.307-0.106-0.342-0.143l-12.911-12.91c-26.125-26.125-68.635-26.124-94.76,0
                c-26.125,26.125-26.125,68.636,0,94.761l97.035,97.035c2.934,2.935,6.837,4.551,10.987,4.551c4.15,0,8.053-1.617,10.987-4.552
                l53.325-53.334c2.94-2.94,2.94-7.706-0.001-10.644c-2.94-2.939-7.707-2.94-10.644,0.001l-53.325,53.334
                c-0.035,0.035-0.143,0.142-0.342,0.142c-0.201,0-0.308-0.106-0.343-0.143l-97.035-97.035c-20.256-20.256-20.256-53.215,0-73.472
                s53.215-20.255,73.471,0l12.91,12.91c2.934,2.936,6.837,4.552,10.987,4.552c4.151,0,8.052-1.616,10.988-4.551l13.12-13.12
                c20.26-20.255,53.216-20.254,73.472,0c20.256,20.256,20.256,53.214,0,73.472L331.001,227.529z"/>
              <g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
            </svg>
          </button>
        </div>

        <div style="border-radius: 0.7rem;" class="bg-white shadow-lg overflow-hidden sm:flex sm:h-58 md:h-59 lg:h-56 border-gray-400 border-t border-b">
          <!--Image de la tarjeta-->
          <div class="bg-cover h-40 sm:h-auto sm:w-1/3" :style="{backgroundImage: 'url(\''+file+'\')'}">
          </div>
          <!--Detalles resumidos del servicio dado-->
          <div class="w-full sm:w-2/3 relative">
            <div class="p-4 sm:py-2 md:px-5 md:pt-3 md:pb-2 h-28">
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
                    <div class="w-2/3 text-xl sm_text-lg text-gray-700 font-semibold">
                      Desde S/ {{price.toFixed(2)}}
                    </div>
              
                    <router-link :to="'/service/'+service_id" class="w-1/3">
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
import api from "../api";

export default {
  name: "ServiceCard",
  components: 
  {
    IconSvg
  },
  props: 
  {
    service_id: String,
    file: String,
    title: String,
    description: String,
    district: String,
    supplier_rating: Number,
    price: Number
  },
  data: () => 
  {
    return {
      token: localStorage.getItem('token'),
      level: localStorage.getItem('e_level'),
      star: 1,
      paint: false,
      isCustomer: false
    };
  },
  async created()
  {
    if((this.token == null) && (this.level == null)) { this.isCustomer = false; return; }
    else 
    {
      this.isCustomer = true;

      let response = await api.get(`/favorite/idService=${this.service_id}/idCustomer=${localStorage.getItem('e_id_customer')}`)
      let boolean = response.data.data
      
      if(boolean == 1) this.paint = true;
      else this.paint = false; 
    }
  },
  methods:
  {
    async getServiceFavorite()
    {
      let response = await api.post(`/save_favorite`, {
        idService: this.service_id,
        idCustomer: localStorage.getItem('e_id_customer')
      });
      
      if(response.ok)
      {
        window.location.reload();;

        this.$toast.open({
          message: "Servicio guardado en favorito",
          type: "success",
          duration: 8000,
          dismissible: true,
        });
      }
    }
  }
}
</script>