<template>
  <div :class="myClass" v-html="require(`!html-loader!../../assets/icons/${solid?'solid':'outline'}/${icon}.svg`)"></div>
</template>

<style module>
.svg {
  fill: currentColor;
}
</style>

<script>
export default {
  name: "IconSvg",
  props: {
    solid: Boolean,
    icon: String,
    myClass: String
  }
}
</script>