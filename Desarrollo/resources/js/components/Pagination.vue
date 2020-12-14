<template>
  <nav class="relative z-0 inline-flex shadow-sm">
    <a
      v-if="pagination.current_page > 1"
      href="page_previous" @click.prevent="changePage(pagination.current_page - 1)"
      class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
      aria-label="Previous"
    >
      <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path
          fill-rule="evenodd"
          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
          clip-rule="evenodd"
        />
      </svg>
    </a>
    
    <a
      v-show="pagination.last_page != 1"
      :href="'/page='+page"
      @click.prevent="changePage(page)"
      v-for="page in pagesNumber"
      v-bind:key="page"
      v-bind:class="[ page == isActived ? 'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-primary-700 transition ease-in-out duration-150' : '']"
      class="-ml-px relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm leading-5 font-bold text-primary-700"
    > {{ page }}
    </a>

    <a
      v-if="pagination.current_page < pagination.last_page"
      href="page_next" @click.prevent="changePage(pagination.current_page + 1)"
      class="-ml-px relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm leading-5 font-medium text-gray-500 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150"
      aria-label="Next"
    >
      <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
        <path
          fill-rule="evenodd"
          d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
          clip-rule="evenodd"
        />
      </svg>
    </a>
  </nav>
</template>

<script>
import api from "../api";

export default {
  props: {
    type_pag: String,
    category: String,
    /* category: String, */
    prices: Object,
    calification: Boolean,
    title: String,
    district: String,
  },
  data: () => {
    return {
      pagination: {
        'total': 0,
        'current_page': 0,
        'per_page': 0,
        'last_page': 0,
        'from': 0,
        'to': 0
      },
      services: [],
      offset: 3,
      loading: true,
      pmin: '',
      pmax: '',
      value: 0
    }
  },
  async mounted() {
    if(this.type_pag == 'index')
      this.getPagesIndex(1, 'all', 'all', 0, 'all', 'all');
  },
  watch: {
    title: function(newVal, oldVal) {
      this.getPagesIndex(1, this.pmin, this.pmax, this.value, newVal, this.district)
    },
    district: function(newVal, oldVal) {
      this.getPagesIndex(1, this.pmin, this.pmax, this.value, this.title, newVal)
    },
    'prices.pmin': function(newVal, oldVal) {
      this.pmin = newVal;
    },
    'prices.pmax': function(newVal, oldVal){
      this.pmax = newVal;
      this.getPagesIndex(1, this.pmin, this.pmax, this.value, this.title, this.district)
    },
    calification: function(newVal, oldVal){
      if(newVal == true) this.value = 1;
        else this.value = 0;

      this.getPagesIndex(1, this.pmin, this.pmax, this.value, this.title, this.district)
    },
  },
  computed: {
    //Lógica de la paginación
    isActived: function() {
      return this.pagination.current_page;
    },
    pagesNumber:function() {
      if(!this.pagination.to) return [];

      var from = this.pagination.current_page - this.offset;
      if(from < 1) from = 1;

      var to = from + (this.offset * 2);
      if(to >= this.pagination.last_page) to = this.pagination.last_page;

      var pagesArray = [];
      while(from <= to){
        pagesArray.push(from);
        from++;
      }
      return pagesArray;
    }
  },
  methods: {
    async getPagesIndex(page, pmin, pmax, value, title, district){
      if(title == '') title = 'all';
      if(district == '') district = 'all';
      if(pmin == '') pmin = 'all';
      if(pmax == '') pmax = 'all';
      
      //Se llama a toda la lista de servicios
      let response = await api.get(`/services/page=${page}/pmin=${pmin}&pmax=${pmax}/OrderByvalue=${value}/title=${title}/district=${district}`)
       
      this.services = response.data.data.paginate.data || []
      this.pagination = response.data.data.paginate //Se extrae los datos paginados 

      //Evento que el componente padre oira para obtener valores
      this.$emit('getServices', {
        services_paginate: this.services,
      })
    },
    async changePage(page){
      this.pagination.current_page = page;

      if(this.type_pag == 'index') {
        this.getPagesIndex(page, this.pmin, this.pmax, this.value, this.title, this.district);
      }
    },
  }
};
</script>
  