<template>
  <!-- HOME: Vista de inicio del proveedor.
  Se muestra los datos del proveedor junto con un resumen
  estadístico de clientes, servicios, evaluaciones y ganancias. --> 
  <SideBar title="Inicio">

    <!-- Sección de datos del proveedor - trabajador independiente.
      Muestra la imagen, nombres, apellidos, DNI y domicilio del proveedor. -->
    <div v-if="acceso == 'employee'" class="max-w-xl mx-auto bg-white overflow-hidden shadow rounded-lg">
      <div class="px-4 py-5 sm:p-6 sm:flex">
        <div class="sm:w-1/2 text-center">
          <img
            class="inline-block h-40 w-40 sm:h-30 sm:w-30 rounded-full"
            :src="image"
            alt="Foto de referencia"
          />
        </div>
        <div class="sm:w-1/2 mt-2 sm:mt-0">
          <p class="text-lg font-semibold text-center">
            {{name}} {{lastnamep}} {{lastnamem}}
          </p>
          <p class="font-semibold mt-2">DNI:</p>
          <p>{{dni}}</p>
          <p class="font-semibold mt-2">Domicilio</p>
          <p>{{depa}} - {{prov}} - {{dist}}</p>
          <p class="text-sm">{{address}}</p>
        </div>
      </div>
      <!-- Fin de sección de datos del proveedor trabajador independiente. -->
    </div>

    <!-- Sección de datos del proveedor - empresa.
      Muestra la imagen, nombres, apellidos, DNI, razon social y RUC del proveedor. -->
    <div v-if="acceso == 'enterprise'" class="max-w-4xl mx-auto grid sm:grid-cols-2 gap-5 sm:gap-20">
      <div class="px-4 py-5 sm:p-6 bg-white overflow-hidden shadow rounded-lg">
        <p class="text-lg font-semibold text-center mb-3">EMPRESA</p>
        <div class="sm:flex">
          <div class="sm:w-1/2 text-center">
            <img
              class="inline-block h-40 w-40 sm:h-32 sm:w-32 rounded-full"
              :src="image_enter"
              alt="Foto de referencia"
            />
          </div>
          <div class="sm:w-1/2 mt-2 sm:mt-0">
            <p class="text-base font-semibold text-center">
              {{razon_social}}
            </p>
            <p class="font-semibold mt-2">RUC:</p>
            <p>{{ruc}}</p>
          </div>
        </div>
      </div>
      
      <div class="px-4 py-5 sm:p-6 bg-white overflow-hidden shadow rounded-lg">
        <p class="text-lg font-semibold text-center mb-3">ADMINISTRADOR</p>
        <div class="sm:flex">
          <div class="sm:w-1/2 text-center">
            <img
              class="inline-block h-40 w-40 sm:h-32 sm:w-32 rounded-full"
              :src="image_admi"
              alt="Foto de referencia"
            />
          </div>
          <div class="sm:w-1/2 mt-2 sm:mt-0">
            <p class="text-base font-semibold text-center">
              {{name_admi}} {{lastnamep_admi}} {{lastnamem_admi}}
            </p>
            <p class="font-semibold mt-2">DNI:</p>
            <p>{{dni}}</p>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin de sección de datos del proveedor. -->

    <h2 class="text-xl font-semibold text-gray-900 mt-4">
      RESUMEN ESTADÍSTICO
    </h2>
    <div class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
      
      <!-- Sección de clientes.
      Muestra el número de clientes atendidos por el proveedor. -->
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex items-center">
            <router-link to="#">
              <div class="flex-shrink-0 bg-primary-500 hover:bg-gray-600 rounded-md p-3">
                <IconSvg :solid="false" icon="users" class="h-6 w-6 text-white" />
              </div>
            </router-link>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt
                  class="text-sm leading-5 font-medium text-gray-500 truncate"
                >
                  Clientes
                </dt>
                <dd class="flex items-baseline">
                  <div class="text-2xl leading-8 font-semibold text-gray-900">
                    0
                  </div>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin de sección de clientes. -->

      <!-- Sección de servicios.
      Muestra el número de servicios ofrecidos por el proveedor. -->
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex items-center">
            <router-link to="/supplier/services">
              <div class="flex-shrink-0 bg-primary-500 hover:bg-gray-600 rounded-md p-3">
                <IconSvg :solid="false" icon="briefcase" class="h-6 w-6 text-white" />
              </div>
             </router-link>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt
                  class="text-sm leading-5 font-medium text-gray-500 truncate"
                >
                  Servicios
                </dt>
                <dd class="flex items-baseline">
                  <div class="text-2xl leading-8 font-semibold text-gray-900">
                    {{num_service}}
                  </div>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin de sección de servicios. -->

      <!-- Sección de trabajadores - solo activa para empresas.
      Muestra el número de trabajadores ofrecidos por el proveedor. -->
      <div v-if="acceso == 'enterprise'" class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex items-center">
            <router-link to="#">
              <div class="flex-shrink-0 bg-primary-500 hover:bg-gray-600 rounded-md p-3">
                <IconSvg :solid="false" icon="user-group" class="h-6 w-6 text-white" />
              </div>
             </router-link>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt
                  class="text-sm leading-5 font-medium text-gray-500 truncate"
                >
                  Trabajadores
                </dt>
                <dd class="flex items-baseline">
                  <div class="text-2xl leading-8 font-semibold text-gray-900">
                    {{num_subemployees}}
                  </div>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin de sección de trabajadores. -->

      <!-- Sección de evaluaciones.
      Muestra el promedio de estrellas recibidas del proveedor. -->
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex items-center">
            <router-link to="#">
              <div class="flex-shrink-0 bg-primary-500 hover:bg-gray-600 rounded-md p-3">
                <IconSvg :solid="false" icon="clipboard-check" class="h-6 w-6 text-white" />
              </div>
            </router-link>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt
                  class="text-sm leading-5 font-medium text-gray-500 truncate"
                >
                  Evaluaciones
                </dt>
                <dd class="flex items-baseline">
                  <div class="text-2xl leading-8 font-semibold text-gray-900">
                    0
                  </div>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin de sección de evaluaciones. -->

      <!-- Sección de ganancias.
      Muestra el promedio de venta de servicios del proveedor. -->
      <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
          <div class="flex items-center">
            <router-link to="#">
              <div class="flex-shrink-0 bg-primary-500 hover:bg-gray-600 rounded-md p-3">
                <IconSvg :solid="false" icon="cash" class="h-6 w-6 text-white" />
              </div>
            </router-link>
            <div class="ml-5 w-0 flex-1">
              <dl>
                <dt
                  class="text-sm leading-5 font-medium text-gray-500 truncate"
                >
                  Ganancias
                </dt>
                <dd class="flex items-baseline">
                  <div class="text-2xl leading-8 font-semibold text-gray-900">
                    S/ 00.00
                  </div>
                </dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin de sección de ganancias. -->
      
    </div>
  </SideBar>
</template>

<script>
import api from "../../api";

import SideBar from "../../components/SideBar";
import IconSvg from "../../components/IconSvg";

export default {
  name: "Home",
  components: {
    SideBar,
    IconSvg
  },
  data: () => {
    return {
      id: localStorage.getItem('e_id'),
      //Nivel de acceso a mostrarse
      acceso: localStorage.getItem('e_level'),
      //Datos en comun
      dni: localStorage.getItem('e_DNI'),

      //Datos del propios del trabajador independiente
      name: localStorage.getItem('e_name'),
      lastnamep: localStorage.getItem('e_lastnamep'),
      lastnamem: localStorage.getItem('e_lastnamem'),
      depa: localStorage.getItem('e_depa'),
      prov: localStorage.getItem('e_prov'),
      dist: localStorage.getItem('e_dist'),
      address: localStorage.getItem('e_adress'),
      image: localStorage.getItem('e_file'),
      
      //Datos propios de la empresa
      name_admi: localStorage.getItem('e_name_admi'),
      lastnamep_admi: localStorage.getItem('e_lastnamep_admi'),
      lastnamem_admi: localStorage.getItem('e_lastnamem_admi'),
      image_admi: localStorage.getItem('e_file_admi'),
      image_enter: localStorage.getItem('e_file_enterprise'),
      ruc: localStorage.getItem('e_RUC'),
      razon_social: localStorage.getItem('e_name_enterprise'),

      //Datos estadisticos
      num_service: 0,
      num_subemployees: 0
    }
  },
  async created(){
    let response = await api.get(`/count/${this.id}`)
    this.num_service = response.data.data.servicios;
    //this.num_subemployees = response.data.data.subemployees;
  }
}
</script>