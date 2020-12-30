<template>
  <div class="py-4">
    <!--NOTIFICATION LIST: Aqui se genera la iteraccion de las notificaciones con sus respectivos datos-->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
      <div
        v-show="loading && notifications.length == 0"
        class="h-56 rounded-lg p-6 flex items-center justify-center"
      >
        <span class="text-xl text-gray-900">Cargando contenido...</span>
        <svg
          class="animate-spin ml-6 h-6 w-6 text-primary-800"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
        >
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
          <path
            class="opacity-75"
            fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
          />
        </svg>
      </div>
      
      <div
        v-show="!loading && notifications.length == 0"
        class="rounded-lg py-3 text-center items-center justify-center"
      >
        <span class="text-xl text-gray-900 w-full">¡Bandeja de Notificaciones vacía!</span>
        <div class="w-full sm:px-10">
          <img class="h-56 sm:h-64 w-full object-contain" src="../../assets/empty_2.png">
        </div>
      </div>

      <ul v-for="notification in notifications" v-bind:key="notification._id">
        <!--Aquí es una tarjeta de notificación simplificada
        Se muestra los elementos que heredaran al componente hijo Notification-->
        <Notification
          @onDelete="openModal"
          :notification_id="notification._id"
          :lastnamep="notification.lastnamep"
          :lastnamem="notification.lastnamem"
          :name="notification.name"
          :now="notification.created_at"
          :status="notification.status"
          :message="notification.message"
        />
      </ul>
    
      <div
        v-show="modalOpen"
        class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
      >
        <div @click="modalOpen = false" class="fixed inset-0 transition-opacity">
          <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
          class="relative bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full sm:p-6"
          role="dialog"
          aria-modal="true"
          aria-labelledby="modal-headline"
        >
          <div class="sm:flex sm:items-start">
            <div
              class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10"
            >
              <!-- Heroicon name: exclamation -->
              <svg
                class="h-6 w-6 text-red-600"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
                />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3
                class="text-lg leading-6 font-medium text-gray-900"
                id="modal-headline"
              >¿Desea eliminar?</h3>
              <div class="mt-2">
                <p
                  class="text-sm leading-5 text-gray-500"
                >Está seguro que desea eliminar esta notificación.</p>
              </div>
            </div>
          </div>
          <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
              <button @click="submitDelete"
                type="button"
                class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
              >Eliminar</button>
            </span>
            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
              <button @click="modalOpen=false" 
                type="button"
                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
              >Cancelar</button>
            </span>
          </div>
        </div>
      </div>
    </div>
  
    <!--Lógica de la paginación y de los filtros-->
    <div class="w-full text-center mt-4">
      <Pagination
        :type_pag="type_pagination"
        :filter="select"
        :id_notification="id"
        @getNotifications="setNotifications"
        @setLoading="loading=true"
      />
    </div>
    <!--Fin de la sección-->
  </div>
</template>

<script>
import api from "../api"

import Pagination from "../components/Pagination.vue"
import Notification from "../components/Notification.vue";

export default {
  name: "NotificationList",
  components: {
    Notification,
    Pagination
  },
  props: {
    select: String
  },
  data: () => {
    return {
      type_pagination: "notifications",
      notifications: [],//Arreglo de notificaciones totales
      id: localStorage.getItem("e_id"),//Id de la sesión del trabajador independiente
      
      loading: true,
      modalOpen: false,
      deleteNotificationId: "",
      statusId: "",
      customerId: "",
      dateId: ""
    };
  },
  methods: {
    openModal(obj) {
      this.modalOpen = true;
      this.deleteNotificationId = obj.notification;
      this.statusId = obj.status;
      this.dateId = obj.fecha_service;
    },
    async submitDelete(){
      //Conexión con la lógica de negocio
      let response = await api.post(`/delete/notification`,{
        id: this.deleteNotificationId,
        status: this.statusId,
        date: this.dateId
      })
      
      if (!response.ok) {
        this.$toast.open({
          message: response.error.errors.fail[0],
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      this.$toast.open({
        message: response.data.data.info,
        type: "info",
        duration: 8000,
        dismissible: true
      });

      this.modalOpen = false;
      location.reload();
    },
    setNotifications(notifications) {
      this.notifications = notifications.notification_paginate;
      this.loading = false;
    }
  }
};
</script>