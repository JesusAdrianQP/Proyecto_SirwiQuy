<template>
  <!--ESTABLECER PRECIO: aqui se establece la cotización correspondiente al servicio-->
  <SideBar title="Establecer Precio">
    <p class="mx-4 my-4 font-semibold">Opciones de este servicio</p>
    <div class="bg-white mx-4 px-6 py-5 sm:px-6 overflow-hidden shadow rounded-lg">
      
      <!--Si elige solo mano de obra-->
      <div>
        <div class="flex">
          <input
            id="only_workforce"
            name="workforce"
            type="radio"
            class="form-radio h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
            value="only_workforce"
            v-model="includeMaterials1"
          />
          <label for="only_workforce" class="ml-3">
            <span class="block text-sm leading-5 font-medium text-gray-700">Solo mano de obra</span>
          </label>
        </div>
        <div
          v-if="includeMaterials1 == 'only_workforce'"
          class="mt-1 sm:mt-5 sm:ml-8 grid-cols-1 col-gap-8 row-gap-2"
        >
          <LaborPrice @getValues="setValues"
          />  
        
        <small v-if="vacio_1" class="text-yellow-600">
        {{
        vacio_1
        }}
        </small>    
        </div>
      </div>
      <!--Fin de sección-->

      <!--Si elige mano de obra y materiales-->
      <div>
        <div class="flex mt-4">
          <input
            id="include_materials"
            name="workforce"
            type="radio"
            class="form-radio h-4 w-4 text-primary-600 transition duration-150 ease-in-out"
            value="include_materials"
            v-model="includeMaterials1"
          />
          <label for="include_materials" class="ml-3">
            <span
              class="block text-sm leading-5 font-medium text-gray-700"
            >Mano de obra y materiales</span>
          </label>
        </div>
        <div
          v-if="includeMaterials1!='only_workforce'"
          class="mt-1 sm:mt-5 sm:ml-8 grid-cols-1 col-gap-8 row-gap-2"
        >
          <LaborPrice @getValues="setValues"
          /> 
          <MaterialPrice @getMaterials="setMaterials"
            />   
          
          <small v-if="vacio_2" class="text-yellow-600">
          {{
          vacio_2
          }}
          </small>  
        </div>
      </div>
      <!--Fin de la sección-->

      <!--Sección donde recibira todo los datos de los componentes hijos-->
      <div class="mx-auto text-center mt-6">
        <span class="ml-3 inline-flex rounded-md shadow-sm">
              <MyButton
                content="Publicar"
                color="primary"
                @onClick="submitForm()"
                :isLoading="buttonLoading"
              ></MyButton>
            </span>
      </div>
      <!--Fin de la sección-->

    </div>
  </SideBar>
</template>

<script>
import api from "../../api"

import SideBar from "../../components/SideBar";
import LaborPrice from "../../components/LaborPrice";
import MaterialPrice from "../../components/MaterialPrice";
import MyButton from "../../components/MyButton.vue";

export default {
  name: "CreatePrice",
  components: {
    SideBar,
    LaborPrice,
    MaterialPrice,
    MyButton
  },
  data: () => {
    return {
      buttonLoading: false,
      includeMaterials1: 'only_workforce',
      sum: 0,

      //Datos del componente laborprice
      lab_price: '',

      //Datos del componente materialprice
      materials_prices: [],

      vacio_1: '',
      vacio_2: ''
    };
  },
  methods: {
    async submitForm() {
      this.vacio_1 = "";
      this.vacio_2 = "";
      this.buttonLoading = true;

      //Compruebo mi seleccion y valido las entradas:
      if(this.includeMaterials1 == 'only_workforce'){
        if(this.lab_price == "")
        {
          this.vacio_1 = "Campo Obligatorio";
          this.buttonLoading = false;
          return;
        }
      }
      else{
        if(this.lab_price == "" || this.materials_prices.length == 0){
          this.vacio_2 = "Campos Obligatorios";
          this.buttonLoading = false;
          return;
        }
      }

      //Conexión con la lógica de negocio
      let response = await api.post(`/create_service`,{
        level: localStorage.getItem('e_level'),
        id: localStorage.getItem('id'),
        title: localStorage.getItem('e_title'),
        description: localStorage.getItem('e_desc'),
        category: localStorage.getItem('e_cate'),
        district: localStorage.getItem('e_dist'),
        photo: localStorage.getItem('e_file'),
        price: parseInt(this.lab_price),
        materials: this.materials_prices,
      })

      if (!response.ok) {
        this.buttonLoading = false;
        
        return this.$toast.open({
          message: response.error.errors.fail[0],
          type: "error",
          duration: 8000,
          dismissible: true
        });
      }

      this.$toast.open({
        message: response.data.data.success,
        type: "success",
        duration: 8000,
        dismissible: true
      });

      this.$router.push("/supplier");
    },
    setValues(obj){
      this.lab_price = obj.labor_price;
    },
    setMaterials(obj){
      this.materials_prices = obj.material_price;
    }
  }
};
</script>
