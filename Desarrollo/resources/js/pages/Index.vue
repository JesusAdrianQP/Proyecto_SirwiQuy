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
        <CategorySelector @onCategorySelected="filterByCategory"
        @onPriceSelected="filterByPrice" 
        @onCalificationSelected="orderByCalification"/>
        <ServiceList
        :value="value"
        />
      </div>
    </main>
  </Visitor>
</template>

<script>
import ServiceList from '../containers/ServiceList.vue'
import Visitor from './Layouts/Visitor.vue'
import CategorySelector from "../components/CategorySelector.vue";

import api from "../api";

export default {
  name: "IndexPage",
  components: {
    ServiceList,
    CategorySelector,
    Visitor
  },
  data: () => {
    return {
      token: localStorage.getItem('token'),
      level: localStorage.getItem('e_level'),
      isCustomer: false,
      username: '',
      file: ' ',
      value: null
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
  methods: {
    orderByCalification(obj){
      this.value = obj.value;
    }
  }
}
</script>