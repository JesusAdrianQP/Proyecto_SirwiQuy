<template>
  <router-link
    :to="url"
    :class="selected?'text-gray-900 bg-gray-100 hover:bg-gray-100 focus:bg-gray-200':''"
    class="mt-1 group flex items-center px-2 py-2 text-sm leading-5 font-medium text-gray-600 rounded-md hover:text-gray-900 hover:bg-gray-50 focus:outline-none focus:bg-gray-100 transition ease-in-out duration-150"
  >
    <IconSvg :solid="icon.solid" :icon="icon.icon" :myClass="'h-6 w-6 mr-2 mb-1 '+(selected?'text-primary-500':'text-gray-400')"/>
    {{title}}
  </router-link>
</template>

<script>
import IconSvg from "./IconSvg.vue";
export default {
  components: {
    IconSvg
  },
  data: function() {
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