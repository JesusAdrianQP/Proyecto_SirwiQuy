<template>
  <div>
    
    <div class="sm:flex items-center rounded-lg border-2 border-primary-500 p-2">
      <div class="sm:flex flex-1">
        <!--label for="email" class='block text-xl font-medium leading-5 text-gray-700 py-1'>Qué Buscas?</label-->
        <input
          class="flex-1 appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-3 leading-tight focus:outline-none"
          v-model="search"
          placeholder="¿Qué Buscas?"
          type="text"
          onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 241)"
          autofocus="autofocus"
          aria-label
          @change="searchService()"
        />
      </div>
      
      <div class="sm:flex flex-1 sm:border-l-2 border-primary-500 sm:pl-3 mt-2 sm:mt-0">
        <!--label for="email" class='block text-xl font-medium leading-5 text-gray-700 py-1'>Dónde?</label-->
        <select
          class="form-select appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-3 leading-tight focus:outline-none"
          placeholder="¿Dónde?"
          required="required"
          autofocus="autofocus"
          aria-label
          v-model="district"
          @change="searchService()"
        >
        <option value="all">¿Dónde?</option>
        <option 
          v-for="district in districts" 
          v-bind:key="district.id"
          >{{district.name}}
        </option>
        </select>
      </div>
      <button
        class="cursor-pointer flex-shrink-0 w-full sm:w-auto bg-primary-500 hover:bg-primary-700 border-primary-500 hover:border-primary-700 text-sm border-4 text-white py-1 px-1 mt-2 sm:mt-0 rounded sm:rounded-full"
        type="submit"
      >
        <span class="block sm:hidden">Buscar</span>
        <svg
          class="hidden sm:block h-5 w-5 text-white group-hover:text-white transition ease-in-out duration-150"
          fill="none"
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </button>
    </div>
  </div>
</template>

<script>
import api from "../api";

export default {
  data: () => 
  {
    return {
      district: 'all',
      districts: [],
      search: '',
    }
  },
  async mounted()
  {
    let response = await api.post(`/dist`, {id: '1501'})
    this.districts = response.data.data.districts;
  },
  methods: 
  {
    //Busco segun los filtros correspondientes 
    searchService() 
    {
      this.$emit('searchService', {
        search: this.search,
        district: this.district,
      });
    }
  }
}
</script>