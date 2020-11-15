<template>
  <SideBar title="Editar Publicación">
    <CardEditList :category="category" />
  </SideBar>
</template>


<script>
import SideBar from "../../components/SideBar";
import CardEditList from "../../containers/CardEditList.vue";

export default {
  name: "ServiceList",
  components: {
    SideBar,
    CardEditList,
  },
  data: () => {
    return { category: "" };
  },
};
</script>