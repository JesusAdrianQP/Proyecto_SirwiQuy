<template>
    <Visitor title="Calificar Servicio">
    <main>
        <div class=" mx-auto py-3 sm:px-6 lg:px-8">
            <h3
            class="text-center font-bold pt-10 text-3xl  leading-6 text-gray-900"
          >
            Calificar Servicio
          </h3>
            <div class="bg-white text-center py-8">
            
                <div class="flex justify-center items-center">
                    <div class="flex items-center pt-15 mb-4">
                        <svg @click="rate(star)" v-for="star in 5" :key="star.starts" class="h-15 w-15 text-gray-300 sm:h-20 sm:w-20 hover:text-yellow-300 active:text-yellow-300 fill-current" :class="{'text-yellow-500': (star <= stars), 'text-gray-500':!(star <= stars)}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                       <path d="M6.43 12l-2.36 1.64a1 1 0 0 1-1.53-1.11l.83-2.75a1 1 0 0 0-.35-1.09L.73 6.96a1 1 0 0 1 .59-1.8l2.87-.06a1 1 0 0 0 .92-.67l.95-2.71a1 1 0 0 1 1.88 0l.95 2.71c.13.4.5.66.92.67l2.87.06a1 1 0 0 1 .59 1.8l-2.3 1.73a1 1 0 0 0-.34 1.09l.83 2.75a1 1 0 0 1-1.53 1.1L7.57 12a1 1 0 0 0-1.14 0z" /></svg>                                    
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
                    
                    <label
                        for="input_comment"
                    ></label>
                    <div class="mt-1 rounded-md shadow-sm lg:px-20 sm:px-5">
                        <textarea
                            id="input_comment"
                            v-model="comment"
                            rows="4"
                            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                            placeholder="Comentar..."
                        ></textarea>
                    </div>
                    <small v-if="error_comment" class="text-red-600">{{
                        error_comment
                    }}</small>
                        <small v-if="vacio_comment" class="text-yellow-600">{{
                        vacio_comment
                    }}</small>
    
                </div>

                <div class="mx-auto text-center mt-6">
                
                    <router-link class="inline-flex rounded-md shadow-sm sm:ml-2" to="/">
                    <button type="button" class="inline-flex items-center px-3 py-4 border border-gray-400 text-sm leading-4 font-medium rounded-md text-black bg-gray-200 hover:bg-gray-300 focus:outline-none focus:border-gray-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150">
                        Regresar a Inicio
                    </button>
                    </router-link>
                    
                    <router-link class="inline-flex rounded-md shadow-sm sm:ml-8 mt-2 sm:mt-0" to="#">
                    <button type="button" class="inline-flex items-center px-3 py-4 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150">
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
        stars: this.grade,
        error_comment:" ",
        vacio_comment:" "
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