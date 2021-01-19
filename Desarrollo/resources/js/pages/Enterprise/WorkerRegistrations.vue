<template>

    <SideBar title="LISTA DE TRABAJADORES">
        
        <body class="antialiased font-sans bg-white rounded-lg">
            <div class="container mx-auto px-4 sm:px-8">
                <div class="py-8">
                   <div class="my-2 flex sm:flex-row flex-col space-x-10  justify-between">
                        <div class="inline-flex border rounded w-7/12 px-2 lg:px-6 h-10 bg-transparent sm:mx-3 sm:my-3">
                            <div class="flex flex-wrap items-stretch w-full h-full mb-6 relative ">
                                
                                <input type="text" class=" flex-shrink flex-grow flex-auto leading-normal tracking-wide w-px flex-1 border border-none border-l-0 rounded rounded-l-none px-3 relative focus:outline-none text-xxs lg:text-xs lg:text-base text-gray-500 font-thin" placeholder="Search">
                            </div>
                        </div>
                    
                        <div class="block relative">
                            <button 
                            @click="addOpen=true"
                            type="submit"
                            class="inline-flex items-center px-3 py-3 sm:mx-3 my-3  border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-primary-600 hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary active:bg-primary-700 transition ease-in-out duration-150">
                            <span >
                             <IconSvg :solid="true" icon="user-add" class="h-7 w-7 text-white sm:h-5 sm:w-5  "/>         
                            </span>
                            Añadir Trabajador
                            </button>

                        </div>
                        
                    </div>
                   
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-full leading-normal">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Nombre(s)
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Apellidos
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            DNI
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <WorkerRegistration
                                    /> 
                                    
                                    
                                </tbody>
                            </table>

                            
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
import WorkerRegistration from "../../components/WorkerRegistration";



export default {
  name: "WorkerRegistrations",
  components: {
    SideBar,
    IconSvg,
    WorkerRegistration
  },
  data: () => {
    return {
      addOpen: false,
      updateOpen: false
    }
  }
};
</script>
