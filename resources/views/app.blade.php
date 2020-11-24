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
        <link rel="shortcut icon" href="{{ asset('images/Sirwiyquy_b.ico') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom_app.css') }}">
    </head>

    <body class="contenedor">
        <!--Pre carga de la página-->
        <div id="loader" class="loading1 fixed top-0 right-0 h-screen w-screen z-50 flex justify-center items-center bg-primary-600">
            <svg class="w-40 md:w-64 lg:w-66 overflow-visible" viewBox="0 0 100 100">
                <g class="points"> 
                    <circle class="ciw" cx="50" cy="50" r="50" fill="#fff"  />
                    <circle class="ci2" cx="5" cy="50" r="4" />
                    <circle class="ci1" cx="95" cy="50" r="4" />
                </g>
            </svg>
        </div>
        <!--Contenedor principal del sitio web SPA-->
        <div id="app">
            <router-view></router-view>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/custom_app.js') }}"></script>
    </body>
</html>