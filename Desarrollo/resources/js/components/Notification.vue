<template>
  <!--NOTIFICATION: Notificacion simplificada heredando los parametros del componente padre-->
  <li class="border-t border-gray-200">
    <!--La ruta se redirige a la url mas la id correspondiente de la notificación seleccionada-->
    <div 
      @click="$router.push('/supplier/notifications/details/'+notification_id)"
      class="cursor-pointer block hover:bg-gray-50 focus:outline-none focus:bg-gray-50 transition duration-150 ease-in-out"
    >
      <div class="px-4 py-4 sm:px-6">
        <div class="items-center justify-between xl:flex">
          <div
            class="text-sm flex leading-5 font-medium"
          >Mensaje de: <p class="pl-2 text-sm text-indigo-600"> 
            {{name}} {{lastnamep}} {{lastnamem}}</p>
          </div>
          
          <div class="mt-2 flex items-center text-sm leading-5 text-gray-500 xl:mt-0">
            <svg
              class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                clip-rule="evenodd"
              />
            </svg>
            <span>
              <time>Recibido el: {{date_act}}</time>
            </span>
          </div>
        </div>
        
        <div class="mt-3 flex justify-between">
          <p style="overflow: hidden; 
                  text-overflow: ellipsis;  
                  display: -webkit-box;
                    -webkit-line-clamp: 3;
                    -webkit-box-orient: vertical;" 
              class="whitespace-pre-line text-gray-700 text-sm max-w-xl leading-5"
          >{{message}}
          </p>
        </div>

        <div class="mt-2 flex justify-between">
          <div>
            <span
              v-bind:class="status == 'Respondido' ? 'bg-green-100 text-green-800' : 'bg-red-100'"
              class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full"
            >{{status}}</span>
          </div>
          <!--Sección del botón eliminar - elimina notificación-->
          <div class="mt-2 flex items-center text-sm leading-5 text-gray-500 sm:mt-0">
            <span class="ml-3 inline-flex rounded-md shadow-sm">
              <button
                @click.stop="onDeleteTap()"
                type="submit"
                class="inline-flex justify-center py-1 px-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-teal-700 transition duration-150 ease-in-out"
              >Eliminar</button>
            </span>
          </div>
        </div>

      </div>
    </div>
  </li>
</template>

<script>
export default {
  name: "Notification",
  data: () => {
    return {
      isOpen: false,
      date_act: ''
    }
  }, props: {
    //Parametros heredados del componente padre para detallar
    notification_id: String,
    lastnamep: String,
    lastnamem: String,
    name: String,
    now: String,
    status: String,
    message: String
  },
  async created(){
    var date = this.now.slice(0,-9).split('-').reverse().join('/');
    this.date_act = date;
  },
  methods:{
    onDeleteTap(){
      this.$emit('onDelete', {
        notification: this.notification_id,
        status: this.status,
        fecha_service: this.date_act
      })
    }
  },
};
</script>