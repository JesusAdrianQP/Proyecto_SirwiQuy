<template>
    <SideBar title="LISTA DE TRABAJADORES">
        
        <body class="antialiased font-sans bg-white rounded-lg">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                    <div class="flex flex-col items-end">
                        <button 
                        @click="addOpen=true"
                        type="submit"
                        class="inline-flex items-center px-3 py-3 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150">
                        <span >
                            <IconSvg :solid="true" icon="user-add" class="h-7 w-7 text-white sm:h-5 sm:w-5  "/>         
                        </span>
                        Añadir Trabajador
                        </button>

                    </div>

                    <div class="mt-4 text-center items-center justify-center">
                        <span class="text-xl text-gray-900 w-full">¡Registre a los trabajadores de su empresa!</span>
                        <div class="mt-4 w-full sm:px-10">
                            <!-- imagen a cambiar
                            <img class="h-66 sm:h-64 w-full object-contain" src="../../../assets/list.jpeg"> -->
                        </div>
                    </div>
                        
                        
                    
                        
                    

                     <!-- modal de agregar trabajador  -->
                    <div
                    v-show="addOpen"
                    class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
                        >
                        <div @click="addlOpen = false" class="fixed inset-0 transition-opacity">
                        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <div
                        class="relative bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-2xl sm:w-full sm:p-6"
                        role="dialog"
                        aria-modal="true"
                        aria-labelledby="modal-headline"
                        >
                        <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                            
                            <div class="sm:col-span-3">
                                <label
                                    for="input_last_name_p"
                                    class="block text-sm font-medium leading-5 text-gray-700"
                                >
                                    DNI:
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input
                                    id="input_last_name_p"
                                    v-model="last_name_p"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                    placeholder="DNI"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                            <label
                                for="input_last_name_m"
                                class="block text-sm font-medium leading-5 text-gray-700"
                            >
                                Nombre(s):
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input
                                id="input_last_name_m"
                                v-model="last_name_m"
                                class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                placeholder="Nombre"
                                />
                            </div>
                        
                            </div>

                            <div class="sm:col-span-3">
                                <label
                                    for="input_last_name_p"
                                    class="block text-sm font-medium leading-5 text-gray-700"
                                >
                                    Apellido Paterno:
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input
                                    id="input_last_name_p"
                                    v-model="last_name_p"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                    placeholder="Apellido Paterno"
                                    />
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label
                                    for="input_last_name_m"
                                    class="block text-sm font-medium leading-5 text-gray-700"
                                >
                                    Apellido Materno:
                                </label>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <input
                                    id="input_last_name_m"
                                    v-model="last_name_m"
                                    class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                    placeholder="Apellido Materno"
                                    />
                                </div>
                            </div>

                        </div>
                        <div class="mt-4">
                            <h1>Sube una foto de perfil: </h1>
                        </div>
                        <div class="mt-4 grid grid-cols-1 row-gap-6 col-gap-4 sm:grid-cols-6">
                            
                            
                            <div class="sm:col-span-3">
                                <div class="mt-2 flex items-center">
                                    <span class="rounded-md shadow-sm">
                                    <button
                                        type="button"
                                        class="py-2 px-3 border border-gray-300 rounded-md text-sm leading-4 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out"
                                    >
                                        Seleccionar archivo
                                    </button>
                                    </span>
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                            <h1>Ningún archivo seleccionado</h1>
                            </div>

                        </div>


                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                            <button 
                                type="button"
                                class="inline-flex items-center px-3 py-3 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150">
                            Agregar</button>
                            </span>
                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                            <button @click="addOpen=false" 
                                type="button"
                                class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                            >Cancelar</button>
                            </span>
                        </div>
                        </div>
                    </div>

                    
                </div>
            </div>
        </body>

    
  </SideBar>
</template> 

<script>
import SideBar from "../../components/SideBar";
import IconSvg from "../../components/IconSvg";


export default {
  name: "ListWorker",
  components: {
    SideBar,
    IconSvg
  },
  data: () => {
    return {
      addOpen: false
    }
  }
};
</script>