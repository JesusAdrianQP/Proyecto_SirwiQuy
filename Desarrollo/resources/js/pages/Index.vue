<template>
  <!-- INDEX: Vista principal de los datos del sistema.
  Muestra todos los servicios publicados en la plataforma. 
  -->
  <Visitor>
    <main>
      <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <ServiceList 
          :title="title"
          :district="district"
          :category="category"
          :prices="prices"
          :value="value"
        />
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
  data: () => {
    return {
      title: '',
      district: '',
      category: 'all',
      prices: {
        pmin : '',
        pmax : ''
      },
      value: null
    }
  },
}
</script>