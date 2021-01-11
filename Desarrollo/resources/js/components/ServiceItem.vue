<template>
  <tr>
    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">{{date}}</td>
    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-900">{{id_service}}</td>
    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
      <span
        v-show="status=='Por pagar'"
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800"
      >Por Pagar</span>
      <span
        v-show="status=='Pendiente'"
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800"
      >Pendiente</span>
      <span
        v-show="status=='Completado'"
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
      >Completado</span>
      <span
        v-show="status=='No completado'"
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
      >No Completado</span>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap text-left text-sm leading-5 font-medium">
      <button
        @click="onServiceCompletedTap"
        v-show="status=='Pendiente'"
        class="cursor-pointer underline text-primary-500 hover:text-primary-800"
      >Completado</button>
      <button
        @click="onServiceIncompleteTap"
        v-show="status=='Pendiente'"
        class="cursor-pointer underline text-orange-500 hover:text-orange-800 mx-4"
      >No completado</button>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">S/. {{sumTotal.toFixed(2)}}</td>
  </tr>
  <!--FIN DE LA SECCIÓN-->
</template>

<script>
import api from "../api";

export default {
  name: "ServiceItem",
  props: {
    id_response: String,
    date: String,
    id_service: String,
    status: String,
    sumTotal: Number,
  },
  methods: {
    async onServiceCompletedTap() {
      let response = await api.post(`/updatestatus`, {
        typeNot: 'response',
        id: this.id_response,
        status: 'Completado'
      })

      if (!response.ok) {
        this.buttonLoading = false;

        let er = response.error.errors;
        let mensaje = "Error desconocido";

        if(er.hasOwnProperty('fail')){
          mensaje = er.fail[0];
        }

        return this.$toast.open({
          message: mensaje,
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      this.$toast.open({
        message: response.data.data.success[0],
        type: "success",
        duration: 8000,
        dismissible: true
      });

      this.$router.push("/customer/rate/service");
    },
    async onServiceIncompleteTap() {
      let response = await api.post(`/updatestatus`, {
        typeNot: 'response',
        id: this.id_response,
        status: 'No completado'
      })

      if (!response.ok) {
        this.buttonLoading = false;

        let er = response.error.errors;
        let mensaje = "Error desconocido";

        if(er.hasOwnProperty('fail')){
          mensaje = er.fail[0];
        }

        return this.$toast.open({
          message: mensaje,
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      this.$toast.open({
        message: response.data.data.success[0],
        type: "success",
        duration: 8000,
        dismissible: true
      });

      this.$router.push("/");
    }
  },
};
</script>