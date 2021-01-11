<template>
  <SideBar title="Editar Publicación">

    <Loader class="min-h-screen"
            :load="loading"
      />

    <CardEditList v-show="!loading" :category="category" :ide="id" 
     @getLoading="setLoading"/>
  </SideBar>
</template>


<script>
import api from "../../api";

import Loader from "../../components/Loader";
import SideBar from "../../components/SideBar";
import CardEditList from "../../containers/CardEditList.vue";

export default {
  name: "ServiceList",
  components: {
    SideBar,
    CardEditList,
    Loader
  },
  data: () => {
    return { 
      acceso: localStorage.getItem('e_level'),
      token: localStorage.getItem('token'),
      loading: true,
      username: '',
      img: '',
      id: '212121valor por defectoosflke',
      category: "" 
    };
  },
   methods: {
    setLoading() {
      this.loading = false;
    }
  },
};
</script>