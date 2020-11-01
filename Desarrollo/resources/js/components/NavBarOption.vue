<template>
  <router-link
    :to="url"
    :class="selected?'border-primary-500 border-b-2':''"
    class="ml-6 inline-flex items-center px-1 pt-1 text-base font-medium leading-5 text-gray-900 focus:outline-none focus:border-primary-700 transition duration-150 ease-in-out"
  >
  <IconSvg :solid="icon.solid" :icon="icon.icon" :myClass="'h-5 w-5 mr-2 mb-1 '+(selected?'text-primary-500':'text-gray-500')"/>
  {{title}}</router-link>
</template>

<script>
import IconSvg from "./IconSvg.vue";
export default {
  components: {
    IconSvg
  },
  data: function (){
    return {
      selected: this.$route.path == this.url
    }
  },
  props: {
    title: String,
    url: String,
    icon: Object
  }
}
</script>