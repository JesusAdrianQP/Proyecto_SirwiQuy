<template>
  <div class="lg:flex">
    <div class="lg:w-1/5">
      <label
        for="input_max_price"
        class="py-1 sm:py-2 block text-sm font-medium leading-5 text-gray-700"
      >Precio de mano de obra</label>
    </div>

    <div class="lg:w-3/5 mt-1 rounded-md shadow-sm">
      <input
        placeholder="Ingrese el precio de la mano de obra"
        id="input_labor_price"
        type="number"
        v-model="labor_price"
        @change="getValue_labprice"
        class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
      />

      <small v-if="error_lab" class="text-red-600">{{
        error_lab
      }}</small>
      <small v-if="vacio_lab" class="text-yellow-600">{{
        vacio_lab
      }}</small>
    </div>
  </div>
</template>

<script>
export default {
  name: "LaborPrice",
  props: {
    identifier: String
  },
  data: () => {
    return {
      hasError: false,
      labor_price: '',
      
      error_lab: '',
      vacio_lab: ''
    };
  },
  methods: {
    async getValue_labprice(){
      this.validateSubmit();
      if (this.hasError) return;
    
      //Evento que el componente padre oira para obtener estos dos valores
      this.$emit('getValues', {
        labor_price: parseFloat(this.labor_price),
      })
    },
    validateSubmit() {
        this.hasError = false;

       if(this.labor_price == ""){
          this.hasError = true;
          this.error_lab = "";
          this.vacio_lab = "Campo Necesario";
        }
        else{  
          this.error_lab = "";
          this.vacio_lab = "";
        }
    }
  }
};
</script>