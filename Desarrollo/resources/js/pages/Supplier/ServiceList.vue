<template>
  <SideBar title="Editar Publicación"
    :user="username"
    :image="img">

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
      id: '',
      category: "" 
    };
  },
  async created(){
    let response = await api.get(`/services/level=${this.acceso}/token=${this.token}`)
    let supplier = response.data.data;
    
    this.username = supplier.username;
    this.img = supplier.file;
    this.id = supplier._id;

    localStorage.setItem('id', this.id);
  },
   methods: {
    setLoading() {
      this.loading = false;
    }
  },
};
</script>