<template>
  <SideBar title="Editar Publicación">

    <!-- <button class="mt-3 text-lg font-semibold bg-blue-600 w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:bg-gray-700" @click.prevent="modal()" > -->
    <button class="mt-3 text-lg font-semibold bg-gray-700 bg-opacity-50 w-full text-white rounded-lg px-6 py-3 block shadow-xl hover:bg-gray-700" @click.prevent="modal()" >
      Consigue publicar más servicios desde solo S/ 50.00 | Las rebajas terminan el 03 de febrero. <br>
      ¡Quedan pocos días!
    </button>

    <Loader class="min-h-screen"
            :load="loading"
      />

    <CardEditList v-show="!loading" :category="category" :ide="id" 
     @getLoading="setLoading"/>


     <!--Objeto Modal-->
      <!--Modal de filtro por precio-->
    <div
        v-show="modalOpen"
        class="fixed inset-x-0 z-50 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
    >
      <div  @click="modalOpen=false;" class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>
    
      <div
        class=" bg-white rounded-lg px-4 pt-2 pb-1 overflow-hidden shadow-xl transform transition-all sm:max-w-5xl sm:w-full "
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
      >
        <div class="hidden sm:block absolute top-0 right-0 pt-4 pr-4">
          <button
             @click="modalOpen=false;"
            type="button"
            class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150"
            aria-label="Close"
          >
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
              />
            </svg>  
          </button>  
        </div>
        <PricingPlan/>
      </div>
    </div>
  </SideBar>
</template>


<script>
import api from "../../api";

import Loader from "../../components/Loader";
import SideBar from "../../components/SideBar";
import PricingPlan from "../../components/PricingPlan";
import CardEditList from "../../containers/CardEditList.vue";

export default {
  name: "ServiceList",
  components: {
    SideBar,
    CardEditList,
    Loader,
    PricingPlan
  },
  data: () => {
    return { 
      acceso: localStorage.getItem('e_level'),
      token: localStorage.getItem('token'),
      loading: false,
      username: '',
      img: '',
      id: '212121valor por defectoosflke',
      category: "" ,
      modalOpen: false
    };
  },
   methods: {
    setLoading() {
      this.loading = false;
    },
    modal() {
      this.modalOpen = true;
    }
  },
};
</script>