<template>
  <tr>
    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">{{date}}</td>
    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">{{title}}</td>
    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
      <span
        v-show="status=='pendiente'"
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800"
      >Pendiente</span>
      <span
        v-show="status=='completado'"
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"
      >Completado</span>
      <span
        v-show="status=='noCompletado'"
        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800"
      >No Completado</span>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap text-left text-sm leading-5 font-medium">
      <button
        @click="onServiceCompletedTap"
        v-show="status=='pendiente'"
        class="cursor-pointer underline text-primary-500 hover:text-primary-800"
      >Completado</button>
      <button
        @click="onServiceIncompleteTap"
        v-show="status=='pendiente'"
        class="cursor-pointer underline text-orange-500 hover:text-orange-800 mx-4"
      >No completado</button>
    </td>
    <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
      <button
        @click="onGenerateIDTap"
        v-show="bill_status=='comprobanteID'"
        class="cursor-pointer underline text-indigo-600 hover:text-indigo-900"
      >Generar ID</button>
    </td>
  </tr>
  <!--FIN DE LA SECCIÓN-->
</template>
<script>
export default {
  name: "ServiceItem",
  props: {
    service_id: String,
    title: String,
    status: String,
    date: String,
    bill_status: String,
  },
  methods: {
    onServiceCompletedTap() {
      this.$emit("onServiceCompleted", { service: this.service_id });
    },
    onServiceIncompleteTap() {
      this.$emit("onServiceIncomplete", { service: this.service_id });
    },
    onGenerateIDTap() {
      this.$emit("onGenerateID", { service: this.service_id });
    },
    onGenerateBillTap() {
      this.$emit("onGenerateBill", { service: this.service_id });
    },
  },
};
</script>