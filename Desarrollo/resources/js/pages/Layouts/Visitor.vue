<template>
  <div id="app" class="bg-white relative min-h-screen">
    <!--
      Se agrega la navbar y el landing footer como denominador comun 
      para todos las interfaces
    -->
    <NavBar @onCustomerId="getCustomerId"/>
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
  methods: {
    getCustomerId(obj) {
      let id = obj._id;

      this.$emit('onCustomerIdForm', {
        idCustomer: id
      });
    },
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
