<template>
    <Visitor title="Calificar Servicio">
    <main>
        <div class=" mx-auto py-3 sm:px-6 lg:px-8">
            <h3
            class="text-center font-bold pt-10 text-3xl  leading-6 text-gray-900"
          >
            Calificar Servicio
          </h3>
            <div class="bg-gray-100 text-center py-8">
            
                <div class="flex justify-center items-center">
                    <div class="flex items-center pt-15 mb-4">
                        
                        <span @click="rate(star)" v-for="star in 5" :key="star.stars">
                            <IconSvg :solid="true" icon="star" class="h-15 w-15 text-gray-300 sm:h-20 sm:w-20 hover:text-yellow-300 active:text-yellow-300  "/>         
                        </span>
                                    
                    </div>
                        
                </div>
                <div  class="mx-auto text-center mt-4">
                    <div class="inline-flex items-center p-2 ">
                        <p class="mt-6 text-center text-3xl font-bold text-gray-900 sm:text-5xl"> 
                            {{ stars }} / 5 </p>
                    </div>
                </div>
                <div  class="mx-auto text-center mt-6">
                    <div class="inline-flex items-center p-4 ">
                        <h2 class="mt-6 text-center  font-bold text-gray-900"> 
                            Usted a valorizado este servicio en {{ stars }} estrella(s) este servicio</h2>
                    </div>
                </div>
                <div class="mx-auto text-center mt-6">
                
                    <router-link class="inline-flex rounded-md shadow-sm sm:ml-2" to="/">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-gray-600 hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150">
                        Regresar a Inicio
                    </button>
                    </router-link>
                    
                    <router-link class="inline-flex rounded-md shadow-sm sm:ml-8 mt-2 sm:mt-0" to="#">
                    <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150">
                        Enviar Valoración
                    </button>
                    </router-link>
                </div>
                
            </div>
        </div>
    </main>
    </Visitor>
</template>

<script>


import IconSvg from "../../components/IconSvg";
import Visitor from "../Layouts/Visitor";

export default {
    name:"RateService",
    components: {
        Visitor,
        IconSvg
    },
    props: {
        
        hascounter: String,
    },
    data() {
        return {
        stars: this.grade
        }
    },
    methods: {
        rate(star) {
            if (typeof star === 'number' && star <= 5 && star >= 0) {
                this.stars = this.stars === star ? star - 1 : star
            }
        }
    },
}
</script>