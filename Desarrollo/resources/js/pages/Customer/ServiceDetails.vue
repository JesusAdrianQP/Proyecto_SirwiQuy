<template>
  <!-- SERVICE DETAILS: Vista de detalles del servicio.
  Muestra la imagen, titulo, descripción, departamento, provincia,
  distrito, precio mínimo y precio máximo del servicio, así como
  también el nombre y calificación del proveedor. --> 
  <Visitor>
      <div class="bg-gray-100 min-h-screen">
        
        <main class>
          <div class="max-w-7xl mx-auto py-8 sm:px-6 lg:px-8 text-center">
            <div class="sm:flex px-4">
              
              <!-- Sección de detalles del servicio.
              Muestra los detalles del servicio seleccionado. -->
              <div class="sm:w-1/2 bg-white overflow-hidden shadow rounded-lg sm:mr-2">
                <div
                  class="h-48 w-full flex-none bg-cover rounded-t text-center overflow-hidden"
                  v-bind:style="{ backgroundImage: 'url(\''+image_url+'\')' }"
                  title="Woman holding a mug"
                >
                </div>
                
                <div class="px-4 py-5 sm:p-4 text-left">
                  <h2 class="text-2xl font-semibold leading-none"
                  >{{ title }}
                  </h2>

                  <div class="mt-4">
                    <h3 class="font-semibold">Descripción:</h3>
                    <p class="sm:text-justify"
                      ><span style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit;"
                      >{{description}}
                      </span>
                    </p> 

                    <h3 class="font-semibold">Categoría:</h3>
                    <div class="flex items-center mt-1">
                      <IconSvg
                        :solid="true"
                        icon="clipboard"
                        class="h-5 w-5 text-primary-500"
                      />
                      <div class="text-sm ml-1">
                        <p
                          class="text-gray-900 font-semibold leading-none"
                        >{{ category }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Fin de sección de detalles del servicio. --> 

              <div class="sm:w-1/2 sm:ml-2 mt-4 sm:mt-0" style="height: fit-content;">
                <!-- Sección de detalles del proveedor.
                Muestra los detalles del proveedor del servicio seleccionado. -->
              <div class="bg-white overflow-hidden shadow rounded-lg"> 
                <div class="px-4 py-5 sm:p-6">
                  <div class="flex items-center">
                    <div>
                      <img
                        @click="imageOpen = true"
                        class="inline-block h-16 w-16 sm:h-20 sm:w-20 rounded-full cursor-pointer"
                        :src="image"
                        alt
                      />
                    </div>
                    <div class="ml-6 text-left">
                      <p class="text-lg leading-5 font-semibold text-gray-700">Proveedor:</p>
                      <p
                        class="text-sm leading-4 font-medium text-gray-500 mt-2"
                      >{{ supplier_name }}</p>
                    </div>
                  </div>
                  
                    <div class="flex items-center mt-2 justify-between">
                      <div class="flex items-center mt-2">
                        <IconSvg :solid="true" icon="star" class="h-5 w-5 text-yellow-400" />
                        <div class="text-sm ml-1">
                          <p
                            class="text-gray-900 font-semibold leading-none"
                          >Calificación: {{ calification }}</p>
                        </div>
                      </div>
                      <router-link
                        class="inline-flex rounded-md shadow-sm ml-2"
                        :to="'/service/'+service_id+'/cost'"
                      >
                        <button
                          type="button"
                          class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150"
                        >Cotizar</button>
                      </router-link>
                    </div>
                </div>
              </div>
              <!-- Fin de sección de detalles del proveedor. -->

              <!--Sección de los detalles de la localización donde se ubica el servicio-->
              <div class="mt-4 bg-white overflow-hidden shadow rounded-lg"> 
                <div class="px-4 py-5 sm:p-6">
                  <div class="flex items-center">
                    <h3 class="font-semibold">Ubicación:</h3>
                  </div>
                  
                  <div class="flex items-center mt-1">
                      <IconSvg
                        :solid="true"
                        icon="location-marker"
                        class="h-5 w-5 text-primary-500"
                      />
                      <div class="text-sm ml-1">
                        <p
                          class="text-gray-900 font-semibold leading-none"
                        >{{ department }} - {{ province }}, {{ district }}</p>
                      </div>
                  </div>
                  
                  <div class="mt-3 flex items-center w-full h-56">

                  </div>
                </div>
              </div>
              <!--Fin de la sección-->

              <p
                @click="guideOpen=true"
                class="text-lg leading-5 font-semibold text-gray-700 mt-6 cursor-pointer hover:text-primary-500 hover:underline"
              >Guía de primeros pasos</p>
            </div>
          </div>
        </div>
      </main>

      <!-- Sección de imagen de proveedor.
      Muestra la imagen del proveedor al darle click. -->
      <div
        v-show="imageOpen"
        class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
      >
        <div @click="imageOpen = false" class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
          class="px-4 pt-5 pb-4 overflow-hidden transform transition-all"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <img
            class="inline-block h-32 w-32 sm:h-64 sm:w-64 rounded-full"
            :src="image"
            alt
          />
        </div>
      </div>
      <!-- Fin de sección de imagen de proveedor. -->

      <!-- Sección de video de guía.
      Muestra el video de Guía de Primeros Pasos al darle click. --> 
      <div
        v-show="guideOpen"
        class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
      >
        <div @click="guideOpen = false" class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
          class="px-4 pt-5 pb-4 overflow-hidden transform transition-all"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
        <iframe width="600" height="400" src="https://www.youtube.com/embed/Ui4pk1aBSgQ"></iframe>
        </div>
      </div>
      <!-- Fin de sección de video de guía. -->

    </div>
  </Visitor>
</template>

<script>
import api from "../../api";

//import Maps from "../../components/Maps";
import IconSvg from "../../components/IconSvg";
import Visitor from "../Layouts/Visitor";

export default {
  name: "ServiceDetails",
  components: {
    IconSvg,
    Visitor,
    //Maps
  },
  data: ()=>{
    return {
      imageOpen: false,
      guideOpen: false,

      //Se guarda como un objeto los valores del servicio
      service_details: '',

      category: '',
      title: '',
      description: '',
      department: '',
      province: '',
      district: '',
      min_price: '',
      max_price: '',
      identity: '',
      ide: '',
      calification: '',

      //Se requiere para encontrar el proveedor exacto
      id_provider: '',
      //Se guarda como un objeto los valores del proveedor
      provider_details: '',

      supplier_name: '',

      image:'',
      image_url: '',
      type: 'customer1',
      
      isType: 'Gmap',
      apidate: '',

      lat: 0,
      lng: 0
    };
  },
  props: {
    service_id: String,
  }
  /*async mounted() {
    //Se traen los datos del servicio filtrado por id
    let response = await api.get(`/service/${this.service_id}`);
    
    //Si es que introducen rutas erroneas inexistentes
    if(response.ok == true)
    {
      this.service_details = response.data.data.serv_details;

      //Extraigo datos del servicio correspondiente
      this.title = this.service_details.title;
      this.category = this.service_details.category;
      this.identity = this.service_details.identity;
      this.id_provider = this.service_details.id_worker;
      this.description = this.service_details.description;
      this.department = this.service_details.departamento;
      this.province = this.service_details.provincia;
      this.calification = this.service_details.calificacion;
      this.district = this.service_details.distrito;
      this.min_price = this.service_details.precioMin;
      this.max_price = this.service_details.precioMax;
      this.image_url = this.service_details.file;

      //Inserto a mi objeto
      this.apidate = this.district.replace(/ /g, "+") + ',' +
                      this.province.replace(/ /g, "+") + ',' + 
                      this.department.replace(/ /g, "+")

      //Se redirige para obtener los datos del proveedor
      if(this.identity == 'employee') this.ide = 'trabajador';
        else if(this.identity == 'enterprise') this.ide = 'empresa';

      //Se trae los datos por la id correspondiente
      let response2 = await api.get(`/details/provider/${this.ide}/${this.id_provider}`)
      this.provider_details = response2.data.data.provider;

      //Extraigo los datos del proveedor
      if(this.identity == 'employee'){
        this.image = this.provider_details.file;
        this.supplier_name = this.provider_details.name + " " 
                              + this.provider_details.lastnamep + " "
                              + this.provider_details.lastnamem;
      }
      else if(this.identity == 'enterprise'){
        this.image = this.provider_details.file_enterprise;
        this.supplier_name = this.provider_details.name_enterprise;
      }

      //Se extrae las coordenadas centrales de la localización de donde se da el servicio
      let response3 = await api.get(`/validate/${this.isType}/${this.apidate}`)
      this.lat = response3.data.data[0].results[0].geometry.location.lat;
      this.lng = response3.data.data[0].results[0].geometry.location.lng;
    }
    else this.$router.push("/NotFound");
  }*/
};
</script>