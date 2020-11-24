<template>
  <span class="block w-full rounded-md shadow-sm">
    <button
      @click="onTap()"
      v-bind:class="colorClasses()"
      class="w-full flex justify-center py-2 px-4 border border-transparent text-base font-medium rounded-md text-white focus:outline-none transition duration-150 ease-in-out"
      :disabled="isLoading"
    >
      <span v-show="isLoading">Cargando</span>
      <span v-show="!isLoading">{{content}}</span>
      <transition
        enter-active-class="transform ease-out duration-500 transition"
        enter-class="translate-y-8 opacity-0 sm:translate-y-0 sm:translate-x-8"
        enter-to-class="translate-y-0 opacity-100 sm:translate-x-0"
        leave-active-class="transition ease-in duration-200"
        leave-class="opacity-100"
        leave-to-class="opacity-0"
      >
        <svg
          v-show="isLoading"
          class="animate-spin ml-3 h-5 w-5 text-white"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
        >
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
          <path
            class="opacity-75"
            fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
          />
        </svg>
      </transition>
    </button>
  </span>
</template>

<style lang="css" scoped>
.spinner_dots {
  display: block;
  position: relative;
}

.spinner_dots span {
  position: absolute;
  width: 8px;
  height: 8px;
  background: rgba(0, 0, 0, 0.25);
  border-radius: 50%;
  -webkit-animation: spinner_dots 1s infinite ease-in-out;
  animation: spinner_dots 1s infinite ease-in-out;
}

.spinner_dots span:nth-child(1) {
  left: 0px;
  -webkit-animation-delay: 0.2s;
  animation-delay: 0.2s;
}

.spinner_dots span:nth-child(2) {
  left: 15px;
  -webkit-animation-delay: 0.3s;
  animation-delay: 0.3s;
}

.spinner_dots span:nth-child(3) {
  left: 30px;
  -webkit-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.spinner_dots span:nth-child(4) {
  left: 45px;
  -webkit-animation-delay: 0.5s;
  animation-delay: 0.5s;
}

@keyframes spinner_dots {
  0% {
    -webkit-transform: translateY(0px);
    transform: translateY(0px);
    -webkit-transform: translateY(0px);
    transform: translateY(0px);
    background: rgba(0, 0, 0, 0.25);
  }

  50% {
    -webkit-transform: translateY(10px);
    transform: translateY(10px);
    -webkit-transform: translateY(10px);
    transform: translateY(10px);
    background: #000000;
  }

  100% {
    -webkit-transform: translateY(0px);
    transform: translateY(0px);
    -webkit-transform: translateY(0px);
    transform: translateY(0px);
    background: rgba(0, 0, 0, 0.25);
  }
}

@keyframes spinner_dots {
  0% {
    -webkit-transform: translateY(0px);
    transform: translateY(0px);
    background: rgba(0, 0, 0, 0.25);
  }

  50% {
    -webkit-transform: translateY(10px);
    transform: translateY(10px);
    background: #000000;
  }

  100% {
    -webkit-transform: translateY(0px);
    transform: translateY(0px);
    background: rgba(0, 0, 0, 0.25);
  }
}
</style>

<script>
export default {
  props: {
    content: String,
    color: String,
    isLoading: Boolean,
  },
  methods: {
    colorClasses() {
      if (this.isLoading)
        return {
          "bg-gray-400": true,
        };
      switch (this.color) {
        case "red":
          return {
            "bg-red-600": true,
            "hover:bg-red-500": true,
            "focus:border-red-700": true,
            "focus:shadow-outline-red": true,
            "active:bg-red-700": true,
          };
        case "gradiente":
          return {
            "bg-gradient-to-r": true,
            "from-teal-400": true,
            "to-blue-500": true,
          };
        default:
          return {
            "bg-primary-600": true,
            "hover:bg-primary-500": true,
            "focus:border-primary-700": true,
            "focus:shadow-outline-primary": true,
            "active:bg-primary-700": true,
          };
      }
    },
    onTap() {
      this.$emit("onClick");
    },
  },
};
</script>