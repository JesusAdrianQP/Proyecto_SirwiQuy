<template>
  <div class="text-center pt-4">
    
    <div class="sm:hidden px-2 py-1">
      <select
        @click="Modal"
        v-model="select"
        class="form-select block w-full pl-3 pr-10 py-2 text-base leading-6 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
      >
        <option value="all" selected>Ordenar por</option>
        <option value="calificationOpen">Los mejores evaluados</option>
        <option value="priceOpen">Precios</option>
      </select>
    </div>

    <!--Sección de las categorías - versión app-->
    <div class="sm:hidden px-2 py-1">
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
            @click="Modal"
            v-model="select"
            class="form-select block w-full pl-3 pr-10 py-2 text-base leading-6 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
          >
            <option value="all" selected>Ordenar por</option>
            <option value="calificationOpen">Los mejores evaluados</option>
            <option value="priceOpen">Precios</option>
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
          @click="chosenCategory='Vidrieria';onCategorySelected();"
          :class="chosenCategory=='Vidrieria'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
        >Vidrieria</a>
        <a
          @click="chosenCategory='Jardineria';onCategorySelected();"
          :class="chosenCategory=='Jardineria'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
        >Jardineria</a>
        <a
          @click="chosenCategory='Fumigación';onCategorySelected();"
          :class="chosenCategory=='Fumigación'?'text-primary-700 bg-primary-200 focus:text-primary-800 focus:bg-primary-200':'text-gray-500 hover:text-gray-700 focus:text-primary-600 focus:bg-primary-50'"
          class="cursor-pointer ml-4 px-3 py-2 font-medium text-sm leading-5 rounded-md  focus:outline-none"
        >Fumigación</a>
        <!--Fin de sección-->
      </nav>
    </div>

    <!--Modal de filtro por precio-->
    <div
        v-show="priceOpen"
        class="fixed inset-x-0 z-50 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
    >
      <div @click="priceOpen = false; select = 'all'; 
            hasError = false; error_pmax = '' ;
            vacio_pmax = ''; vacio_pmin = ''; pmin=''; pmax=''"
            class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
    
      <div
        class="fixed bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full sm:p-6"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
      >
        <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
          <button
            @click="priceOpen = false; select = 'all'; 
            hasError = false; error_pmax = '' ;
            vacio_pmax = ''; vacio_pmin = '';  pmin=''; pmax=''"
            type="button"
            class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
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
          
        <div class="sm:flex sm:items-start justify-center">
          <h2
            class="text-lg leading-6 font-medium text-gray-900 "
            id="modal-headline"
          >Rango de precio</h2>
        </div>
        
        <div class="mt-4">
          <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 flex flex-wrap ">
            <div class="mt-1 rounded-md w-full md:w-2/5">
              <div class="shadow-sm">
                <input
                  id="input_pmin"
                  v-model="pmin"
                  min="0"
                  placeholder="Ingrese su precio mínimo"
                  type="number"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_pmin" class="text-yellow-600">{{
                  vacio_pmin
              }}</small>
            </div>

            <div class="w-full py-3 md:w-1/5 justify-center all:justify-center text-center">
              <h3 >a</h3>
            </div>
        
            <div class="mt-1 rounded-md w-full md:w-2/5">
              <div class="shadow-sm">
                <input
                  id="input_pmax"
                  v-model="pmax"
                  min="0"
                  placeholder="Ingrese su precio máximo"
                  type="number"
                  class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                />
              </div>
              <small v-if="vacio_pmax" class="text-yellow-600">{{
                  vacio_pmax
              }}</small>
            </div>           
          </div> 
        </div>
        
        <div class="justify-center mt-6 ">
          
          <button 
            @click="onPriceSelected"
            type="submit"
            class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
          >Buscar</button>
         
          
          <button @click="priceOpen=false" 
              type="button"
            class="inline-flex justify-center border border-gray-300 px-4 py-2 bg-white text-sm leading-5 font-medium rounded-md text-gray-700  hover:text-gray-500 focus:outline-none  focus:border-blue-300 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
              
          >Cancelar</button>
          
      </div>

      </div>
    </div>
    <!--Fin de la seccion-->
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      chosenCategory: 'all',
      chosenCalification: 'all',
      priceOpen: false,
      hasError: false,
      pmin: '',
      pmax: '',

      vacio_pmin: '',
      vacio_pmax: '',

      value: false,
      select: 'all'
    }
  },
  methods: {
    onCategorySelected() {
      this.$emit('onCategorySelected', {
        category: this.chosenCategory
      });
    },
    onPriceSelected(){
      this.validateSubmit();
      if (this.hasError) return;

      this.$emit('onPriceSelected', {
        pmin: this.pmin,
        pmax: this.pmax
      });

      this.select = 'all'; 
      this.priceOpen = false;
      this.hasError = false; 
      this.vacio_pmax = ''; 
      this.vacio_pmin = '';  
      this.pmin=''; 
      this.pmax=''
    },
    onCalificationSelected(){
      this.value = true;

      this.$emit('onCalificationSelected', {
        value: this.value
      })

      this.value = false;
    },
    async Modal(){
      if(this.select == 'priceOpen') this.priceOpen = true;
        else if(this.select == 'calificationOpen') this.onCalificationSelected();
    },
    validateSubmit() {
      this.hasError = false;

      //Validacion de error para el precio minimo
      if(this.pmin == ''){
        this.hasError = true;
        this.vacio_pmin = "Campo Necesario";
      }
      else this.vacio_pmin = "";

      if(this.pmax == ''){
        this.hasError = true;
        this.vacio_pmax = "Campo Necesario";
      }
      else this.vacio_pmax = "";
    }
  }
};
</script>