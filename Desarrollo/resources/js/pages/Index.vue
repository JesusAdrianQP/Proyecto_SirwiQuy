<template>
  <!-- INDEX: Vista principal de los datos del sistema.
  Muestra todos los servicios publicados en la plataforma. 
  -->
  <Visitor
   :isCustom="isCustomer"
   :user="username"
   :photo="file">
    <main>
      <div class="max-w-5xl mx-auto py-4 px-4 sm:px-6 lg:px-10 rounded-b-lg">
        <SearchBar 
        @searchService="filterBySearch"/>
      </div>
      <div class="max-w-7xl mx-auto">
        <CategorySelector @onCategorySelected="filterByCategory"
        @onPriceSelected="filterByPrice" 
        @onCalificationSelected="orderByCalification"/>
        <ServiceList
        :prices="prices"
        :value="value"
        :title="title"
        :district="district"
        />
      </div>
    </main>
  </Visitor>
</template>

<script>
import SearchBar from "../components/SearchBar.vue";
import ServiceList from '../containers/ServiceList.vue'
import Visitor from './Layouts/Visitor.vue'
import CategorySelector from "../components/CategorySelector.vue";

import api from "../api";

export default {
  name: "IndexPage",
  components: {
    SearchBar,
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
      title: '',
      district: '',
      prices: {
        pmin : '',
        pmax : ''
      },
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
    filterBySearch(obj) {
      this.title = obj.search;
      this.district = obj.district;
    },
    filterByPrice(obj){
      this.prices.pmin = obj.pmin;
      this.prices.pmax = obj.pmax;
    },
    orderByCalification(obj){
      this.value = obj.value;
    }
  }
}
</script>