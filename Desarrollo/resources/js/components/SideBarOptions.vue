<template>
  <div>
    <SideBarOption
      title="Inicio"
      url="/supplier"
      :icon="{ icon: 'home', solid: false }"
    />
    <SideBarOption
      title="Notificaciones"
      url="/supplier/notifications"
      :icon="{ icon: 'bell', solid: false }"
    />
    <SideBarOption
      title="Publicar Servicio"
      url="/supplier/service/create"
      :icon="{ icon: 'pencil', solid: false }"
    />
    <SideBarOption
      title="Servicios"
      url="/supplier/services"
      :icon="{ icon: 'pencil-alt', solid: false }"
    />
    <SideBarOption
      title="Clientes"
      url="/supplier/list/service/status"
      :icon="{ icon: 'users', solid: false }"
    />    
    <SideBarOption
      title="Reporte de Satisfacción"
      url="/supplier/satisfaction/report"
      :icon="{ icon: 'thumb-up', solid: false }"
    />
    <a
      @click="logout"
      class="mt-1 group cursor-pointer flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-100 transition ease-in-out duration-150"
    >
      <IconSvg :solid="false" icon="logout" class="h-6 w-6 mr-2 mb-1 text-gray-400"/>
      Cerrar sesión
    </a>
  </div>
</template>

<script>
import api from "../api";

import SideBarOption from "./SideBarOption";
import IconSvg from "./IconSvg"

export default {
  components: {
    SideBarOption,
    IconSvg
  },
  methods: {
    async logout() {
      
      if(localStorage.getItem('e_id_service') == '' || 
      localStorage.getItem('e_id_service') == null) this.remove();
      else{
        //Conexión con la lógica de negocio
        let response = await api.post(`/delete/service`,{
          id: localStorage.getItem('e_id_service'),
          form: 1
        })
        
        localStorage.removeItem('e_id_service');
        this.remove();

        if (!response.ok) {
          this.$toast.open({
            message: response.error.errors.fail[0],
            type: "error",
            duration: 8000,
            dismissible: true
          });
        }

        this.$toast.open({
          message: response.data.data.info,
          type: "info",
          duration: 8000,
          dismissible: true
        });
      }
    },
    async remove(){
      //Condiciona que cuando salga, entre al login de trabajador o empresa
      if(localStorage.getItem('e_level') == "employee")
      {
        localStorage.removeItem('e_id');
        localStorage.removeItem('e_username');
        localStorage.removeItem('e_DNI');
        localStorage.removeItem('e_edad');
        localStorage.removeItem('e_file');
        localStorage.removeItem('e_name');
        localStorage.removeItem('e_lastnamep');
        localStorage.removeItem('e_lastnamem');
        localStorage.removeItem('e_email');
        localStorage.removeItem('e_depa');
        localStorage.removeItem('e_prov');
        localStorage.removeItem('e_dist');
        localStorage.removeItem('e_adress');
        localStorage.removeItem('e_cuenta');
        localStorage.removeItem('e_level');

        this.$router.push("/login/employee")
      }
      else
      {
        localStorage.removeItem('e_id');
        localStorage.removeItem('e_username');
        localStorage.removeItem('e_name_enterprise');
        localStorage.removeItem('e_RUC');
        localStorage.removeItem('e_file_enterprise');
        localStorage.removeItem('e_cuenta_enterprise');
        localStorage.removeItem('e_file_admi');
        localStorage.removeItem('e_name_admi');
        localStorage.removeItem('e_lastnamep_admi');
        localStorage.removeItem('e_lastnamem_admi');
        localStorage.removeItem('e_DNI');
        localStorage.removeItem('e_email');
        localStorage.removeItem('e_depa');
        localStorage.removeItem('e_prov');
        localStorage.removeItem('e_dist');
        localStorage.removeItem('e_adress');
        localStorage.removeItem('e_level');
      
        this.$router.push("/login/enterprise");
      }
    }
  }
}
</script>