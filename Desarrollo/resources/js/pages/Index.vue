<template>
  <!-- INDEX: Vista principal de los datos del sistema.
  Muestra todos los servicios publicados en la plataforma. 
  -->
  <Visitor>
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
        :category="category"
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
      username: '',
      file: ' ',
      title: '',
      district: '',
      category: 'all',
      prices: {
        pmin : '',
        pmax : ''
      },
      value: null
    }
  },
  methods: {
    filterBySearch(obj) {
      this.title = obj.search;
      this.district = obj.district;
    },
     filterByCategory(obj){
      this.category=obj.category;
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