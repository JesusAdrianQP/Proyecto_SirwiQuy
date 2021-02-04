<template>
  <div id="app" class="bg-white relative min-h-screen">
    <NavBar/>
    <slot></slot>
    <LandingFooter/>
  </div>
</template>

<script>
import NavBar from "../../components/NavBar.vue";
import LandingFooter from "../../containers/LandingFooter.vue";

export default {
  name: "App",
  components: 
  {
    NavBar,
    LandingFooter
  }
}
</script>

<style>
#app 
{
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
</style>
