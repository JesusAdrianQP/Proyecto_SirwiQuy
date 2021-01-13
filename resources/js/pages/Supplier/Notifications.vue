<template>
  <!-- NOTIFICATIONS: Vista de notificaciones del trabajador.
  Muestra un listado de notificaciones del trabajador independiente.-->
  <SideBar title="Notificaciones">
    <div class="flex flex-col items-end">
      <div class=" my-2">
        <label for="option" class="block text-sm leading-5 font-medium text-gray-700">Filtrar</label>
        <select
          id="option"
          v-model="select"
          class="mt-1 form-select block pl-3 pr-10 py-2 text-base leading-6 border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5"
        >
          <option value="Respondido">Respondido</option>
          <option value="No respondido">No respondido</option>
          <option value="all" selected>Todo</option>
        </select>
      </div>
    </div>

    <!--Sección de la lista de notificaciones-->
    <NotificationList
      :select="select"
    />
  </SideBar>
</template>

<script>
import SideBar from "../../components/SideBar";
import NotificationList from "../../containers/NotificationList";

export default {
  name: "Notifications",
  components: {
    SideBar,
    NotificationList,
  },
  data() {
    return {
      select: 'all'
    };
  },
};
</script>