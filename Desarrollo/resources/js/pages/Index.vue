<template>
  <!-- INDEX: Vista principal de los datos del sistema.
  Muestra todos los servicios publicados en la plataforma. 
  -->
  <Visitor>
    <main>
      <div class="max-w-7xl mx-auto">
        <ServiceList/>
      </div>
    </main>
  </Visitor>
</template>

<script>
import ServiceList from '../containers/ServiceList.vue'
import Visitor from './Layouts/Visitor.vue'

export default {
  name: "IndexPage",
  components: {
    ServiceList,
    Visitor
  },
}
</script>