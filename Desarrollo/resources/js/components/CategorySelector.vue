<template>
  <div class="px-6">
    
    <div class="sm:hidden pb-2">
      <select
        @click="controlOption()"
        v-model="select"
        class="form-select block w-full pl-3 pr-10 py-2 text-base leading-6 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
      >
        <option value='all' selected>Ordenar por</option>
        <option v-if="isCustomer" value='favoriteOpen'>Mis favoritos</option>
        <option value='calificationOpen'>Los mejores evaluados</option>
        <option value='priceOpen'>Precios</option>
      </select>
    </div>

    <!--Sección de las categorías - versión app-->
    <div class="sm:hidden">
      <select aria-label="Selected tab" class="form-select block w-full" v-model="chosenCategory" @change="onCategorySelected()">
        <option value="all" selected>Todos</option>
        <option value="Gasfitero">Gasfitero</option>
        <option value="Electricista">Electricista</option>
        <option value="Carpintero">Carpintero</option>
        <option value="Cerrajero">Cerrajero</option>
        <option value="Vidriero">Vidriero</option>
        <option value="Jardinero">Jardinero</option>
        <option value="Fumigador">Fumigador</option>
      </select>
    </div>
    <!--Fin de sección-->

    <div class="hidden sm:block">
      <nav class="flex justify-center">
        <div>
          <select
            @click="controlOption()"
            v-model="select"
            class="form-select block w-full pl-3 pr-10 py-2 text-base leading-6 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
          >
            <option value='all' selected>Ordenar por</option>
            <option v-if="isCustomer" value='favoriteOpen'>Mis favoritos</option>
            <option value='calificationOpen'>Los mejores evaluados</option>
            <option value='priceOpen'>Precios</option>
          </select>
        </div>

        <!--Sección de las categorías - versión web-->
        <a
          @click="chosenCategory='all';onCategorySelected();"
          :class="chosenCategory=='all'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md focus:outline-none"
        >Todos</a>
        <a
          @click="chosenCategory='Gasfitero';onCategorySelected();"
          :class="chosenCategory=='Gasfitero'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
        >Gasfitero</a>
        <a
          @click="chosenCategory='Electricista';onCategorySelected();"
          :class="chosenCategory=='Electricista'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
          aria-current="page"
        >Electricista</a>
        <a
          @click="chosenCategory='Carpintero';onCategorySelected();"
          :class="chosenCategory=='Carpintero'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
        >Carpintero</a>
        <a
          @click="chosenCategory='Cerrajero';onCategorySelected();"
          :class="chosenCategory=='Cerrajero'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
        >Cerrajero</a>
        <a
          @click="chosenCategory='Vidriero';onCategorySelected();"
          :class="chosenCategory=='Vidriero'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
        >Vidrieria</a>
        <a
          @click="chosenCategory='Jardinero';onCategorySelected();"
          :class="chosenCategory=='Jardinero'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
        >Jardineria</a>
        <a
          @click="chosenCategory='Fumiguero';onCategorySelected();"
          :class="chosenCategory=='Fumiguero'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
        >Fumigación</a>
        <!--Fin de sección-->
      </nav>
    </div>

    <!--Modal de filtro por precio-->
    <div v-show="priceOpen" class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center">
      <div @click="priceOpen = false; select = 'all'; error_pmin= ''; error_pmax = ''; vacio_pmax = ''; vacio_pmin = ''; pmin=''; pmax=''"
      class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
    
      <div
        class="w-68 fixed bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-xl sm:w-full sm:p-6"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
      >
        <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
          <button @click="priceOpen = false; select = 'all'; error_pmin= ''; error_pmax = '' ; vacio_pmax = ''; vacio_pmin = '';  pmin=''; pmax=''"
            type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
            aria-label="Close"
          >
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
              />
            </svg>  
          </button>  
        </div>
          
        <div class="sm:flex sm:items-start">
          <h2 class="text-lg leading-6 font-medium text-gray-900 " id="modal-headline">Rango de precio</h2>
        </div>
        
        <div class="mt-3">
          <div class="grid grid-cols-4 sm:gap-8 col-span-4 -my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="col-span-4 sm:col-span-2 mt-1 rounded-md w-full">
              <div>
                <label for="input_pmin" class="block text-sm font-medium leading-5 text-gray-700">Precio mínimo:</label>
                <input
                    id="input_pmin"
                    v-model="pmin"
                    min="0"
                    placeholder="Ingrese su precio mínimo"
                    type="text"
                    inputmode="numeric"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                    pattern="[0-9]*"
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
              </div>
              <small v-if="error_pmin" class="text-red-600"> {{error_pmin}} </small>
              <small v-if="vacio_pmin" class="text-yellow-600"> {{vacio_pmin}} </small>
            </div>
        
            <div class="col-span-4 sm:col-span-2 mt-3 md:mt-1 rounded-md w-full">
              <div>
                <label for="input_pmax" class="block text-sm font-medium leading-5 text-gray-700">Precio máximo:</label>
                <input
                    id="input_pmax"
                    v-model="pmax"
                    min="0"
                    placeholder="Ingrese su precio máximo"
                    type="text"
                    inputmode="numeric"
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                    pattern="[0-9]*"
                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                  />
              </div>
              <small v-if="error_pmax" class="text-red-600"> {{error_pmax}} </small>
              <small v-if="vacio_pmax" class="text-yellow-600">{{vacio_pmax}}</small>
            </div>           
          </div> 
        </div>
        
        <div class="text-center mt-6 ">
          <button 
            @click="onPriceSelected()"
            type="submit"
            class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
          >Buscar</button>          
        </div>

      </div>
    </div>
    <!--Fin de la seccion-->
  </div>
</template>

<script>
export default {
  data: () => 
  {
    return {
      token: localStorage.getItem('token'),
      level: localStorage.getItem('e_level'),
      chosenCategory: 'all',
      chosenCalification: 'all',
      priceOpen: false,
      isCustomer: false,

      pmin: '',
      pmax: '',
      
      error_pmin: '',
      error_pmax: '',
      vacio_pmin: '',
      vacio_pmax: '',

      select: 'all'
    }
  },
  async created() 
  {
    if((this.token == null) && (this.level == null)) { this.isCustomer = false; return; }
    else { this.isCustomer = true; }
  },
  methods:
  {
    onCategorySelected() 
    {
      this.$emit('onCategorySelected', {
        category: this.chosenCategory
      });
    },
    onPriceSelected()
    {
      if(parseInt(this.pmin) > parseInt(this.pmax))
      { 
        this.vacio_pmin = '';
        this.vacio_pmax = '';
        this.error_pmax = '';
        this.error_pmin = 'Precio mínimo mayor al precio máximo';
        return;
      }
      else if(parseInt(this.pmin) == parseInt(this.pmax))
      {
        this.vacio_pmin = '';
        this.vacio_pmax = '';
        this.error_pmax = 'Precios iguales';
        this.error_pmin = 'Precios iguales';
        return;
      }
      else
      {
        this.vacio_pmin = '';
        this.vacio_pmax = '';
        this.error_pmax = '';
        this.error_pmin = '';
      }

      var boolean = false;
      if((this.pmin == '' && this.error_pmin == '') || (this.pmin == '' && this.error_pmin != ''))
      {
        this.vacio_pmin = 'Campo necesario';
        this.error_pmin = '';
        boolean = true;
      }
      else if(this.pmin != '' && this.error_pmin != ''){ this.vacio_pmin = ''; boolean = true; }
      else if(this.pmin != '' && this.error_pmin == '')
      {
        this.vacio_pmin = '';
        this.error_pmin = '';
      }

      if((this.pmax == '' && this.error_pmax == '') || (this.pmax == '' && this.error_pmax != ''))
      {
        this.vacio_pmax = 'Campo necesario';
        this.error_pmax = '';
        boolean = true;
      }
      else if(this.pmax != '' && this.error_pmax != ''){ this.vacio_pmax = ''; boolean = true; }
      else if(this.pmax != '' && this.error_pmax == '')
      {
        this.vacio_pmax = '';
        this.error_pmax = '';
      }

      if(boolean) return;
      
      this.$emit('onPriceSelected', {
        pmin: this.pmin,
        pmax: this.pmax
      });

      this.select = 'all'; 
      this.priceOpen = false;
      this.error_pmax = '';
      this.error_pmin = '';
      this.vacio_pmax = ''; 
      this.vacio_pmin = '';  
      this.pmin=''; 
      this.pmax=''
    },
    onCalificationSelected()
    {
      var bandera = true;
      this.$emit('onCalificationSelected', {
        value: bandera
      })
    },
    onFavoriteSelected()
    {
      // this.value = true;

      // this.$emit('onCalificationSelected', {
      //   value: this.value
      // })

      // this.value = false;
    },
    controlOption()
    {
      if(this.select == 'priceOpen') this.priceOpen = true;
      else if(this.select == 'calificationOpen') this.onCalificationSelected();
      else if(this.select == 'favoriteOpen') this.onFavoriteSelected();
    }
  }
};
</script>