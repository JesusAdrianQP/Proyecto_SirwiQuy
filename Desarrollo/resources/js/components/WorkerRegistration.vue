<template>
    <tr>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <div class="flex items-center">
                
                <div class="ml-3">
                    <p class="text-gray-900 whitespace-no-wrap">
                        Adriana
                    </p>
                </div>
            </div>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">Quispe Pinedo</p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <p class="text-gray-900 whitespace-no-wrap">
                70141652
            </p>
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <submit class="flex items-center cursor-pointer"
            @click="modalRemove=true"
            >
                
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                
                    <p class="text-red whitespace-no-wrap">
                        Eliminar
                    </p>
                
            </submit>
            
        </td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            <submit  class="flex items-center cursor-pointer"
            @click="updateOpen=true"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                
                    <p class="text-blue whitespace-no-wrap">
                        Editar
                    </p>
                
            </submit >
        </td>
        <!-- modal de editar  -->
        <div
        v-show="updateOpen"
        class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
            >
            <div @click="updateOpen = false" class="fixed inset-0 transition-opacity">
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
                Actualizar</button>
                </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <button @click="updateOpen=false" 
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                >Cancelar</button>
                </span>
            </div>
            </div>
        </div>
        <!-- modal de eliminar  -->
        <div
        v-show="modalRemove"
        class="fixed inset-x-0 px-4 pb-6 inset-0 p-0 flex items-center justify-center"
        >
            <div @click="modalRemove = false" class="fixed inset-0 transition-opacity">
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
                    >Está seguro que desea eliminar este registro.</p>
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
                <button @click="modalRemove=false" 
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                >Cancelar</button>
                </span>
            </div>
            </div>
        </div>

    </tr>

</template>

<script>


export default {
  name: "WorkerRegistration",
  data: () => {
    return {
      updateOpen: false,
      modalRemove: false
      
    }
  }
  
};
</script>