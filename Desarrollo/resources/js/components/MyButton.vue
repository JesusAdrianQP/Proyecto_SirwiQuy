<template>
  <span class="block w-full rounded-md shadow-sm">
    <button
      @click="onTap()"
      v-bind:class="colorClasses()"
      class="w-full flex justify-center py-2 px-4 border border-transparent text-base font-medium rounded-md text-white focus:outline-none transition duration-150 ease-in-out"
      :disabled="isLoading"
    >
      <span v-show="isLoading" class="mr-4">
        Cargando ...
      </span>
      <span v-show="!isLoading">
        {{content}}
      </span>
    </button>
  </span>
</template>


<script>
export default {
  props: {
    content: String,
    color: String,
    isLoading: Boolean
  },
  methods: {
    colorClasses() {
      if (this.isLoading)
        return {
          "bg-gray-400": true
        };
      switch (this.color) {
        case "red":
          return {
            "bg-red-600": true,
            "hover:bg-red-500": true,
            "focus:border-red-700": true,
            "focus:shadow-outline-red": true,
            "active:bg-red-700": true
          };
        default:
          return {
            "bg-primary-600": true,
            "hover:bg-primary-500": true,
            "focus:border-primary-700": true,
            "focus:shadow-outline-primary": true,
            "active:bg-primary-700": true
          };
      }
    },
    onTap() {
      this.$emit("onClick");
    }
  }
}
</script>