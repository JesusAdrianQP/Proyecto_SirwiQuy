<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; ISO-8859-1" />
        <meta name="DC.language" content="es-ES" />
        <meta name="description" content="Plataforma webapp de servicios de asistencia al hogar. Brindamos la tecnología para facilitar la comunicación entre un cliente y un proveedor de servicios." />
        <meta name="keywords" content="SirwiyQuy, servicios al hogar, Cuidado del medio ambiente">
        <meta name="DC.creator" content="Oficina de Desarrollo SirwiyQuy" />
        <meta name="copyright" content="SirwiyQuy S.A.C" />
        <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
        
        <!---Etiquetas open graph añadidas para mostrar en redes sociales-->
        <meta property="og:locale" content="es_ES" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="SirwiyQuy | Hogar de Servicios" />
        <meta property="og:description" content="Plataforma webapp de servicios de asistencia al hogar. Brindamos la tecnología para facilitar la comunicación entre un cliente y un proveedor de servicios." />
        <meta property="og:url" content="https://"/>
        <meta property="og:site_name" content="SirwiyQuy"/>
    
        <title>SirwiyQuy | Hogar de Servicios</title>

        <!--Estilos provistos por el framework Tailwindcss-->
        <link rel="stylesheet" href="css/style.css">

        <!--JQuery-->
        <script src="js/jquery.min.js"></script>

        <!--Estilos personalizados-->
        <link rel="stylesheet" href="css/style-sirwiyquy.css">
        
        <!--Estilos de letras-->
        <link href="https://fonts.googleapis.com/css2?family=Domine:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;1,100&display=swap" rel="stylesheet">

    </head>

    <body class="contenedor">
    <!-- 
    NAVBAR: Cabecera principal del sistema
    Aquí se encuentra todos los datos principales del sistema
  -->
  <nav class="bg-white border-b border-gray-400">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-6">
      <div class="flex justify-between h-16">
        <!--Navbar en vista de laptop-->
        <div class="flex">
          <div class="flex-shrink-0 flex items-center">
            <a href="/">
              <img
                class="hidden lg:block h-16 w-auto"
                src="images/Logo_Sirwi_b.png"
                alt="logo"
              />
              <img
                class="block lg:hidden h-12 w-auto"
                src="images/Sirwiyquy_b_house.png"
                alt="logo"
              />
            </a>
          </div>

          <div class="hidden sm:-my-px sm:ml-4 lg:flex">
            <NavBarOption title="Inicio" url="/" :icon="{ icon: 'home', solid: true }" />
            <NavBarOption title="Ayuda" url="/customer/blank" :icon="{ icon: 'question-mark-circle', solid: true }"/>
          </div>
        </div>

        <div class="hidden sm:ml-4 lg:flex sm:items-center">
          <a       
            v-if="!isCustomer"     
            href="http://127.0.0.1:8000/#/login/customer"
            class="flex w-full rounded-md shadow-sm sm:w-auto"
          >
            <button
              type="button"
              class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-primary-500 text-base leading-6 font-medium text-white shadow-sm hover:bg-primary-500 focus:outline-none focus:border-primary-700 focus:shadow-outline-primary transition ease-in-out duration-150 sm:text-sm sm:leading-5"
            >Ingresar</button>
          </a>

          <a            
            v-if="!isCustomer"
            href="http://127.0.0.1:8000/#/signup/indie/customer"
            class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:ml-2 sm:w-auto"
          >
            <button
              type="button"
              class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
            >Crear Cuenta</button>
          </a>

        </div>
        <!------------ Fin de la seccion ----------------->

        <!--Icono de la navbar con menu movil-->
        <div class="-mr-2 flex items-center lg:hidden">
          <button
            @click="isMenu()"
            class="inline-flex items-center justify-center p-2 rounded-md text-primary-500 hover:text-primary-300 hover:bg-primary-100 focus:outline-none focus:bg-primary-100 focus:text-primary-500 transition duration-1000 ease-in-out"
          >
            <div class="wrapper-menu">
              <div class="line-menu half start"></div>
              <div class="line-menu"></div>
              <div class="line-menu half end"></div>
            </div> 
          </button>
        </div>
      </div>
    </div>
    
    <!--
      Menu mobil | Open: "block", closed: "hidden"
    -->
    <div :class="isOpen ? 'block' : 'hidden'" class="lg:hidden ">
      <div class="pt-2 pb-3">
        <a
          href="/"
          class="block pl-3 pr-4 py-2 border-l-4 border-primary-500 text-md font-medium text-primary-700 bg-primary-50 focus:outline-none focus:text-primary-800 focus:bg-primary-100 focus:border-primary-700 transition duration-150 ease-in-out"
        >Inicio</a>

        <a
            v-if="!isCustomer"
          href="http://127.0.0.1:8000/#/join_us"
          class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-md font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
        >Trabaja con Nosotros</a>

        <a
          v-if="isCustomer"
          href="http://127.0.0.1:8000/#/customer/blank"
          class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-md font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
        >Mis servicios</a>
        
        <a
          href="http://127.0.0.1:8000/#/customer/blank"
          class="mt-1 block pl-3 pr-4 py-2 border-l-4 border-transparent text-md font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out"
        >Ayuda</a>
      </div>

      <div class="pt-4 pb-3 border-t border-gray-300">
        <div class="mt-3" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
          <a
            v-if="!isCustomer"
            href="http://127.0.0.1:8000/#/login/customer"
            class="mt-1 block px-4 py-2 text-lg font-bold text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            role="menuitem"
          >Ingresar</a>
          <a
              v-if="!isCustomer"
            href="http://127.0.0.1:8000/#/signup/indie/customer"
            class="mt-1 block px-4 py-2 text-lg font-bold text-gray-600 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            role="menuitem"
          >Crear cuenta</a>
        </div>
        

          <div class="mt-3">
            <a
              href="http://127.0.0.1:8000/#/customer/blank"
              class="block px-4 py-2 text-md font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            >Ver perfil</a>

            <a
              href="http://127.0.0.1:8000/#/customer/blank"
              class="block px-4 py-2 text-md font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            >Cuenta</a>

            <a
              @click="logout"
              class="mt-1 block px-4 py-2 text-md font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100 focus:outline-none focus:text-gray-800 focus:bg-gray-100 transition duration-150 ease-in-out"
            >Cerrar sesión</a>
          </div>
        </div>
      </div>
    </div>
  </nav>

    <!--Portada-->
        <header id="cover-responsive" class="bg-center bg-fixed bg-no-repeat bg-cover h-screen">
            <div class="overlay">
                <div class="h-screen items-center justify-center flex" >
                    <div class="rounded-lg mx-6 sm:mx-16 md:mx-20 w-full p-4 text-center">
                

                        <h2 class="mt-8 lg:mt-5 xl:mt-10 font-black text-3xl sm:text-3xl lg:text-5.5xl xl:text-6xl" >
                            <span class="text-primary-900 w-full" style="font-family: 'Domine', serif;" >MANTEN TU CASA EN PERFECTAS CONDICIONES</span>
                        </h2>

                        <div class="mt-2 justify-center w-full h-6 text-base sm:text-sm lg:h-12 text-white lg:text-3xl inline-flex overflow-hidden" >
                            <p class="m-0 text-gray-900 font-light" style="font-family: 'Roboto', sans-serif;">Encuentra los servicios ideales para el mantenimiento de tu hogar</p>
                            
                        </div>

                        <button
                            class="mt-20 inline-flex justify-center w-auto  border-solid border-2 rounded-full py-3 px-10 border-gray-800 lg:text-xl leading-6 font-medium text-white shadow-sm  bg-primary-800 hover:text-black hover:bg-white focus:outline-none focus:border-primary-300 focus:shadow-outline-primary transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                            >COMENZAR
                        </button>
                    </div>
                </div>
            </div>
        </header>
<!--Nosotros-->
        <section>
            <div class="flex justify-center items-center bg-gray-200">
                <h2 class="subtitulo pb-0 pt-20 text-center text-3xl font-semibold lg:text-4xl" style="font-family: 'Domine', serif;"  >Nosotros</h2>
            </div>
            <div class="p-8 lg:p-10 md:p-10 bg-gray-200 ">
                <div class="grid grid-row-2 max-h-full bg-white rounded-lg p-4 ">
                    <div class=" w-full bg-white">
                        
                        <div class="flex justify-center items-center ">
                            <p class="text-base font-light flex flex-wrap content-center lg:py-10 md:py-10 md:text-lg lg:text-2xl text-center">Somos una empresa que considera al cliente como el eje de sus operaciones brindándole servicios de calidad al precio justo.
                            </p>
                        </div>
                    </div>
                    <div class="">
                        <center>
                            <img class=" md:flex md:w-50 lg:w-50 content-center"  width="600px" src="images/business.png"  alt="nosotros-sirwiyquy">
                        </center>
                    </div>
                    
                </div>
            </div>
        </section>
    <!--Objetivos-->
        <section>
            <div class="flex justify-center items-center bg-gray-200">
                <h2 class="subtitulo pb-0 pt-20 text-center text-3xl font-semibold lg:text-4xl" style="font-family: 'Domine', serif;"  >Objetivos</h2>
            </div>
            <div class="flex justify-center items-center lg:p-10 md:p-10 bg-gray-200 ">
                <div class="grid grid-cols-1 lg:grid-cols-3 max-h-full bg-gray-200 rounded-lg p-4 mx-4 ">
                    <div class=" w-full bg-gray-200 py-4 md:mx-2">
                        
                        <div class="flex justify-center items-center ">
                            <p class="text-base font-light flex flex-wrap content-center py-4 lg:py-10 md:py-10 md:text-lg lg:text-2xl text-center">Acercar a clientes y proveedores
                            </p>
                        </div>

                        <center>
                            <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center "  width="400px" src="images/transaction.png"  alt="nosotros-sirwiyquy">
                        </center>
                    </div>
                    <div class=" w-full bg-gray-200 py-4 md:mx-2">
                        
                        <div class="flex justify-center items-center ">
                            <p class="text-base font-light flex flex-wrap content-center py-4 lg:py-10 md:py-10 md:text-lg lg:text-2xl text-center">Brindar los mejores servicios cerca de ti
                            </p>
                        </div>

                        <center>
                            <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center"  width="400px" src="images/cart.png"  alt="nosotros-sirwiyquy">
                        </center>
                    </div>
                    <div class=" w-full bg-gray-200  py-4 md:mx-2">
                        
                        <div class="flex justify-center items-center ">
                            <p class="text-base font-light flex flex-wrap content-center py-4 lg:py-10 md:py-10 md:text-lg lg:text-2xl text-center">Plataforma sencilla y amigable
                            </p>
                        </div>

                        <center>
                            <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center"  width="400px" src="images/finance.png"  alt="nosotros-sirwiyquy">
                        </center>
                    </div>
                </div>
            </div>
        </section>
    <!--Servicios-->
        <section>
            <div class="flex justify-center items-center bg-gray-200">
                <h2 class="subtitulo pb-0 pt-20 text-center text-3xl font-semibold lg:text-4xl" style="font-family: 'Domine', serif;"  >Servicios</h2>
            </div>
            <div class="flex justify-center items-center lg:p-10 md:p-10 bg-gray-200 ">
                <div class="grid grid-cols-1 sm:grid-cols-1 lg:grid-cols-3 max-h-full bg-gray-200 rounded-lg p-4 mx-4 ">
                    <div class=" w-full bg-gray-200 py-4 md:mx-2 ">
                        <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center "  width="400px" src="images/carpinteria.jpg"  alt="carpinteria">
                        <div class="text-center">
                            <h2>Carpinteria</h2>
                        </div>
                    </div>
                    <div class=" w-full bg-gray-200 py-4 md:mx-2">
                        <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center "  width="400px" src="images/cerrajeria.jpg"  alt="cerrajeria">
                        <div class="text-center">
                            <h2>Cerrajeria</h2>
                        </div>
                    </div>
                    <div class=" w-full bg-gray-200 py-4 md:mx-2">
                        <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center "  width="400px" src="images/electricidad.png"  alt="electricidad">
                        <div class="text-center">
                            <h2>Electricidad</h2>
                        </div>
                    </div>
                    <div class=" w-full bg-gray-200 py-4 md:mx-2">
                        <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center "  width="400px" src="images/gasfiteria.jpg"  alt="gasfiteria">
                        <div class="text-center">
                            <h2>Gasfiteria</h2>
                        </div>
                    </div>
                    <div class=" w-full bg-gray-200 py-4 md:mx-2">
                        <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center "  width="400px" src="images/vidrieria.jpg"  alt="gasfiteria">
                        <div class="text-center">
                            <h2>Vidrieria</h2>
                        </div>
                    </div>
                    <div class=" w-full bg-gray-200 py-4 md:mx-2">
                        <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center "  width="400px" src="images/jardineria.jpg"  alt="gasfiteria">
                        <div class="text-center">
                            <h2>Jardineria</h2>
                        </div>
                    </div>
                    <div class=" col-start-2 col-end-3 w-full bg-gray-200 py-4 md:mx-2">
                        <img class=" md:flex md:w-50 lg:w-50 bg-auto content-center "  width="400px" src="images/fumigacion.jpg"  alt="gasfiteria">
                        <div class="text-center">
                            <h2>Fumigación</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-center items-center lg:pb-10 md:pb-10 bg-gray-200">
                <a href="" class="mt-0 mb-2 inline-flex items-center py-3 px-10  lg:text-xl leading-5 font-medium text-primary-500 shadow-sm  hover:underline hover:text-black sm:text-sm " >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    VER SERVICIOS
                </a>
            </div>
        </section>

        <!--Footer-->
        <footer class="inset-x-0 bottom-0 bg-primary-500 text-white pt-6 pb-4 px-4">
    <div class="mx-auto md:px-2 container overflow-hidden flex flex-col md:flex-row justify-between">
      <!--Logotipo-->
      <a href="/" class="md:mt-8 lg:mt-1 lg:ml-1 md:ml-4 block mr-4 w-full lg:w-1/3">
        <img src="images/Logo_Sirwi_w.png" class="h-15 lg:h-24 w-auto" alt="logo">
        <p class="font-semibold italic ml-2 text-md">Protección y cuidado al hogar</p>
      </a>

      <!--Información respectiva con enlaces-->
      <div class="w-full lg:w-2/3 text-base mt-8 lg:mt-0 lg:flex lg:flex-row lg:justify-center">
        <ul class="text-gray-700 list-none font-thin flex flex-col text-left lg:pt-6">
          <li class="flex pt-2 lg:pt-1 pb-1 px-3 text-md lg:text-lg text-white uppercase no-underline font-semibold tracking-wide">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
              ><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path
            ></svg>Trabaja con nosotros</li>
          <li><a href="http://127.0.0.1:8000/#/join_us" class="inline-block ml-6 px-3 text-gray-300 hover:text-gray-400 no-underline">Únete</a></li>
          <li><a href="http://127.0.0.1:8000/#/login/employee" class="inline-block ml-6 px-3 text-gray-300 hover:text-gray-400 no-underline">Inicia sesión</a></li>
        </ul>

        <ul class="text-gray-700 list-none pt-6 font-thin flex flex-col text-left lg:ml-10">
          <li class="flex py-1 px-3 text-md lg:text-lg text-white uppercase no-underline font-semibold tracking-wide">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
              ><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path
            ></svg>Link útiles</li>
          <li><a href="http://127.0.0.1:8000/#" class="inline-block ml-6 px-3 text-gray-300 hover:text-gray-400 no-underline">Sobre Nosotros</a></li>
          <li><a href="http://127.0.0.1:8000/#" class="inline-block ml-6 px-3 text-gray-300 hover:text-gray-400 no-underline">Contáctanos</a></li>
          <li><a href="http://127.0.0.1:8000/#" class="inline-block ml-6 px-3 text-gray-300 hover:text-gray-400 no-underline">Politicas</a></li>
          <li><a href="http://127.0.0.1:8000/#" class="inline-block ml-6 px-3 text-gray-300 hover:text-gray-400 no-underline">Términos y condiciones</a></li>
          <li><a href="http://127.0.0.1:8000/#" class="inline-block ml-6 px-3 text-gray-300 hover:text-gray-400 no-underline">Ayuda</a></li>
        </ul>
      </div>
    </div>

    <!--Información final y redes sociales-->
    <div class="mt-8 pt-2 text-white">
      <div class="flex m-auto pt-5 border-t text-sm lg:text-base flex-col max-w-6xl">
        <div class="text-center">SirwiyQuy &copy; 2020 | Todos los derechos reservados.</div>

        <div class="md:flex-auto md:flex-row-reverse mt-2 justify-center flex-row flex">
          <a href="/#" class="w-6 lg:w-8 mx-1">
            <svg class="fill-current cursor-pointer" width="100%" height="100%" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
            <path id="Twitter" d="M24,12c0,6.627 -5.373,12 -12,12c-6.627,0 -12,-5.373 -12,-12c0,-6.627
                  5.373,-12 12,-12c6.627,0 12,5.373 12,12Zm-6.465,-3.192c-0.379,0.168
                  -0.786,0.281 -1.213,0.333c0.436,-0.262 0.771,-0.676
                  0.929,-1.169c-0.408,0.242 -0.86,0.418 -1.341,0.513c-0.385,-0.411
                  -0.934,-0.667 -1.541,-0.667c-1.167,0 -2.112,0.945 -2.112,2.111c0,0.166
                  0.018,0.327 0.054,0.482c-1.754,-0.088 -3.31,-0.929
                  -4.352,-2.206c-0.181,0.311 -0.286,0.674 -0.286,1.061c0,0.733 0.373,1.379
                  0.94,1.757c-0.346,-0.01 -0.672,-0.106 -0.956,-0.264c-0.001,0.009
                  -0.001,0.018 -0.001,0.027c0,1.023 0.728,1.877 1.694,2.07c-0.177,0.049
                  -0.364,0.075 -0.556,0.075c-0.137,0 -0.269,-0.014 -0.397,-0.038c0.268,0.838
                  1.048,1.449 1.972,1.466c-0.723,0.566 -1.633,0.904 -2.622,0.904c-0.171,0
                  -0.339,-0.01 -0.504,-0.03c0.934,0.599 2.044,0.949 3.237,0.949c3.883,0
                  6.007,-3.217 6.007,-6.008c0,-0.091 -0.002,-0.183 -0.006,-0.273c0.413,-0.298
                  0.771,-0.67 1.054,-1.093Z"></path>
            </svg>
          </a>
            
          <a href="/#" class="w-6 lg:w-8 mx-1">
            <svg class="fill-current cursor-pointer" width="100%" height="100%" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
              <path id="Facebook" d="M24,12c0,6.627 -5.373,12 -12,12c-6.627,0 -12,-5.373 -12,-12c0,-6.627
                    5.373,-12 12,-12c6.627,0 12,5.373
                    12,12Zm-11.278,0l1.294,0l0.172,-1.617l-1.466,0l0.002,-0.808c0,-0.422
                    0.04,-0.648 0.646,-0.648l0.809,0l0,-1.616l-1.295,0c-1.555,0 -2.103,0.784
                    -2.103,2.102l0,0.97l-0.969,0l0,1.617l0.969,0l0,4.689l1.941,0l0,-4.689Z"></path>
            </svg>
          </a>

          <a href="/#" class="w-6 lg:w-8 mx-1">
            <svg class="fill-current cursor-pointer" width="100%" height="100%" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
              <path id="Shape" d="M7.3,0.9c1.5,-0.6 3.1,-0.9 4.7,-0.9c1.6,0 3.2,0.3 4.7,0.9c1.5,0.6 2.8,1.5
                  3.8,2.6c1,1.1 1.9,2.3 2.6,3.8c0.7,1.5 0.9,3 0.9,4.7c0,1.7 -0.3,3.2
                   -0.9,4.7c-0.6,1.5 -1.5,2.8 -2.6,3.8c-1.1,1 -2.3,1.9 -3.8,2.6c-1.5,0.7
                  -3.1,0.9 -4.7,0.9c-1.6,0 -3.2,-0.3 -4.7,-0.9c-1.5,-0.6 -2.8,-1.5
                  -3.8,-2.6c-1,-1.1 -1.9,-2.3 -2.6,-3.8c-0.7,-1.5 -0.9,-3.1 -0.9,-4.7c0,-1.6
                  0.3,-3.2 0.9,-4.7c0.6,-1.5 1.5,-2.8 2.6,-3.8c1.1,-1 2.3,-1.9
                  3.8,-2.6Zm-0.3,7.1c0.6,0 1.1,-0.2 1.5,-0.5c0.4,-0.3 0.5,-0.8 0.5,-1.3c0,-0.5
                  -0.2,-0.9 -0.6,-1.2c-0.4,-0.3 -0.8,-0.5 -1.4,-0.5c-0.6,0 -1.1,0.2
                  -1.4,0.5c-0.3,0.3 -0.6,0.7 -0.6,1.2c0,0.5 0.2,0.9 0.5,1.3c0.3,0.4 0.9,0.5
                  1.5,0.5Zm1.5,10l0,-8.5l-3,0l0,8.5l3,0Zm11,0l0,-4.5c0,-1.4 -0.3,-2.5
                  -0.9,-3.3c-0.6,-0.8 -1.5,-1.2 -2.6,-1.2c-0.6,0 -1.1,0.2 -1.5,0.5c-0.4,0.3
                  -0.8,0.8 -0.9,1.3l-0.1,-1.3l-3,0l0.1,2l0,6.5l3,0l0,-4.5c0,-0.6 0.1,-1.1
                  0.4,-1.5c0.3,-0.4 0.6,-0.5 1.1,-0.5c0.5,0 0.9,0.2 1.1,0.5c0.2,0.3 0.4,0.8
                   0.4,1.5l0,4.5l2.9,0Z"></path>
            </svg>
            </a>
            </div>
        </div>
        </div>
    </footer> 
    </body>
</html>
