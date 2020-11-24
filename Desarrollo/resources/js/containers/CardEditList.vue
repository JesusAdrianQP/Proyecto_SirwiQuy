<template>
  <div class="bg-white shadow overflow-hidden sm:rounded-md my-10">
     <ul v-for="service in services" v-bind:key="service._id">
        <CardEdit
          :id="service.id"
          :title="service.title"
          :description="service.description"
          :address="service.distrito"
          :price="service.precio"
          :imageUrl="service.file"
        />
    </ul>
  </div>
</template>

<script>
import api from "../api";

import CardEdit from "../components/CardEdit.vue";
import IconSvg from "../components/IconSvg";

export default {
  name: "CardEditList",
  components: {
    CardEdit,
    IconSvg
  },
  props: {
    category: String,
  },
  data: () => {
    return {
      services: [],
      ide: localStorage.getItem('id'),
      modalRemove: false,
      submitDelete: false
    };
  },
  async created(){
    //Se llama a toda la lista de servicios
      let response = await api.get(`/services/id=${this.ide}`)
      this.services = response.data.data.servicios;

      this.$emit('getLoading', {})
  }
};
</script>