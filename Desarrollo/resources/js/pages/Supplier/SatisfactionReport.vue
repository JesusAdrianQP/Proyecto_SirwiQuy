<template>
<!--  Vista del registro de reporte de satisfacción del trabajador o empresa.
  Muestra un listado de los reportes de satisfacción por cliente.-->
    <SideBar title="REGISTRO DE REPORTE DE SATISFACCIÓN">
        <body class="antialiased font-sans bg-white rounded-lg">
            <div class="container mx-auto px-4 sm:px-8 ">
                
                <!--Cuando no hay ningun reporte de satisfacción-->
                <!--<div
                    v-show="!loading && reports.length == 0"
                    class="rounded-lg py-3 text-center items-center justify-center"
                >
                    <span class="text-xl text-gray-900 w-full">¡Reporte de Satisfacción vacía!</span>
                    <div class="w-full sm:px-10">
                    <img class="h-56 sm:h-64 w-full object-contain" src="../../../assets/empty_2.png">
                    </div>
                </div>-->

                <div class="py-8">

                    <!--Busqueda por servicio de cliente -->
                    <div class="my-2 flex sm:flex-row flex-col">                        
                        <div class="block relative">
                            <span class="h-full absolute inset-y-0 left-0 flex items-center pl-2">
                                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                                    <path
                                        d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z">
                                    </path>
                                </svg>
                            </span>
                            <input placeholder="Buscar"
                                class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none" />
                        </div>                        
                    </div>

                    <!--Acaba la acción-->
                    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
                        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                            <table class="min-w-0 leading-normal lg:min-w-full">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Fecha y Hora
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Cliente
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Servicio
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Valoración
                                        </th>
                                        <th
                                            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                                
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                  <!--Aquí es el reporte de satisfacción por el cliente-->
                                    <tr>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <div class="flex items-center">
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        26/06/2020
                                                    </p>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-gray-900 whitespace-no-wrap">
                                                        1:45pm
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">Ricardo Navarro Sanchez</p>
                                        </td>
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            <p class="text-gray-900 whitespace-no-wrap">
                                                Cerrajeria Jesus
                                            </p>
                                        </td>
                                        
                                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                            
                                            <p>3</p>
                                        </td>
                                    </tr>                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </body>
    </SideBar>
</template>



<script>


import SideBar from "../../components/SideBar";


export default {
    name: "SatisfactionReport",
    components: {
        SideBar
    },
    data: () => {
        return {
        
        reports: [],//Arreglo de notificaciones totales
        id: localStorage.getItem("e_id"),//Id de la sesión del trabajador independiente
        
        loading: true,
        
        customerId: "",
        dateId: "",

        nreport_id: String,
        lastnamep: String,
        lastnamem: String,
        name: String,
        now: String,
        }
    }, 
    methods: {
        setReports(reports) {
            
            this.loading = false;
        }
    }
};
</script>