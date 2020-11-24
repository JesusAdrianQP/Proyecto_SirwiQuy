<template>
  <!-- NOT FOUND: Vista de página no encontrada.
  Se muestra cuando se ingresa a una ruta desconocida de la página. -->
  <div class="text-center py-8 min-h-screen flex justify-center items-center">
    <div>
      <img class="max-h-90" src="../../assets/illustrations/404.png" alt />
      <h1 class="text-xl font-semibold text-gray-900">¡Oh no!</h1>
      <h1 class="text-xl font-semibold text-gray-900">No se encontró lo que estaba buscando.</h1>
      <button
        @click="submit"
        type="submit"
        class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-teal-700 transition duration-150 ease-in-out"
      >
        Regresar a la página de inicio
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      url: localStorage.getItem('e_level')
    }
  }, 
  methods: {
    async submit() {
      if(this.url == "employee" || this.url == "enterprise") this.$router.push("/supplier");
        else this.$router.push("/");
    }
  }
}
</script>