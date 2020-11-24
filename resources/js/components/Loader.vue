<template>
    <!--Carga de componente - loader-->
    <div
      v-show="load"
      class="rounded-lg p-6 flex items-center justify-center w-full"
    >
        <div class="bg-white border py-2 px-5 rounded-lg flex items-center w-full flex-col">
            <div class="loader-dots block relative w-20 h-5 mt-2">
                <div class="absolute top-0 mt-1 w-4 h-4 rounded-full bg-primary-500"></div>
                <div class="absolute top-0 mt-1 w-4 h-4 rounded-full bg-primary-500"></div>
                <div class="absolute top-0 mt-1 w-4 h-4 rounded-full bg-primary-500"></div>
                <div class="absolute top-0 mt-1 w-4 h-4 rounded-full bg-primary-500"></div>
            </div>
            <div class="text-gray-700 text-lg font-light mt-2 text-center">
            Cargando datos ...
            </div>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    load: Boolean,
  },
}
</script>