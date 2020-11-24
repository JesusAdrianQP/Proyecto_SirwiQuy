<template>
  <SideBar title="En Construcción...">
    <div class="text-center py-8 min-h-screen flex items-center justify-center">
      <div>
        <img class="rounded-lg px-4 max-h-96 mx-auto" src="../../../assets/illustrations/under_construction.png" alt />
      </div>
    </div>
  </SideBar>
</template>

<script>
import SideBar from "../../components/SideBar";

export default {
  name: "SuppliersBlank",
  components: {
    SideBar
  }
}
</script>