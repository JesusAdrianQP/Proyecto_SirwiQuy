<template>
  <div id="app" class="bg-white relative min-h-screen">
    <!--
      Se agrega la navbar y el landing footer como denominador comun 
      para todos las interfaces
    -->
    <NavBar
      :isCustomer="isCustom"
      :usuario="user"
      :foto="photo" />
    <slot></slot>
    <LandingFooter/>
  </div>
</template>

<script>
import NavBar from "../../components/NavBar.vue";
import LandingFooter from "../../containers/LandingFooter.vue";

export default {
  name: "App",
  components: {
    NavBar,
    LandingFooter
  },
  props: {
    isCustom: Boolean,
    user: String,
    photo: String
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
</style>
