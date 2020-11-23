<template>
  <!-- INDEX: Vista principal de los datos del sistema.
  Muestra todos los servicios publicados en la plataforma. 
  -->
  <Visitor
   :isCustom="isCustomer"
   :user="username"
   :photo="file">
    <main>
      <div class="max-w-7xl mx-auto">
        <ServiceList/>
      </div>
    </main>
  </Visitor>
</template>

<script>
import ServiceList from '../containers/ServiceList.vue'
import Visitor from './Layouts/Visitor.vue'

import api from "../api";

export default {
  name: "IndexPage",
  components: {
    ServiceList,
    Visitor
  },
  data: () => {
    return {
      token: localStorage.getItem('token'),
      level: localStorage.getItem('e_level'),
      isCustomer: false,
      username: '',
      file: ' '
    }
  },
  async created() {
    if((this.token == null || this.token == '') && (this.level == '' || this.level == null)){
      this.isCustomer = false;
    }
    else{
      this.isCustomer = true;
      let response = await api.get(`/services/level=${this.level}/token=${this.token}`)
      let customer = response.data.data;

      this.username = customer.username;
      if(customer.file != '' || this.file == null){this.file = customer.file };
    }
  },
}
</script>