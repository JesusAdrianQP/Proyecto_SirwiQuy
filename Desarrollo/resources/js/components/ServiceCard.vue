<template>
  <!--SECCIÓN DE LA TARJETA DE SERVICIO (DETALLES GENERALES)-->
  <router-link
    to="/customer/blank"
    class="h-48 max-w-sm w-full lg:max-w-full lg:flex shadow-lg bg-white cursor-pointer hover:bg-gray-200 hover:shadow-xl rounded"
  >
    <div
      class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"
      :style="{backgroundImage: 'url(\''+file+'\')'}"
    ></div>
    <div
      class="w-full rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal bg-white hover:bg-gray-200 shadow sm:shadow-none"
    >
      <div class="mb-1">
        <div style="overflow: hidden; 
                  text-overflow: ellipsis;  
                  display: -webkit-box;
                    -webkit-line-clamp: 1;
                    -webkit-box-orient: vertical;" 
          class="text-gray-900 font-bold text-xl mb-2"
        >{{title}}
        </div>
        
        <p style="overflow: hidden; 
                  text-overflow: ellipsis;  
                  display: -webkit-box;
                    -webkit-line-clamp: 2;
                    -webkit-box-orient: vertical;" 
            class="whitespace-pre-line text-gray-700 text-base max-h-15 leading-5"
        >{{description}}
        </p>
      </div>
      <div class="flex justify-between items-end">
        <div>
          <div class="flex items-center">
            <IconSvg :solid="true" icon="location-marker" class="h-5 w-5 text-primary-500"/>
            <div class="text-sm ml-1">
              <p class="text-gray-900 leading-none">{{district}}</p>
            </div>
          </div>
          <div class="flex items-center mt-1">
            <IconSvg :solid="true" icon="star" class="h-5 w-5 text-yellow-400"/>
            <div class="text-sm ml-1">
              <p class="text-gray-900 leading-none">{{supplier_rating}}</p>
            </div>
          </div>
        </div>
        <p class="text-gray-900 text-sm font-bold leading-none">S/ {{min_price}} a S/ {{max_price}}</p>
      </div>
    </div>
  </router-link>
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
    min_price: Number,
    max_price: Number,
  }
}
</script>