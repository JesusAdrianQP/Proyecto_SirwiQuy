<!DOCTYPE html>
<html lang="es">

<head>
    <script src="https://www.paypal.com/sdk/js?client-id=AR8v8RBDfb3jJaWNmQf9llXOAAlSmwaAGB3HrLca3PrV7Z6RNDaZPL6oT16zyp-as52Z347ge7XWeSwM"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kusawasi</title>
    <link rel="shortcut icon" href="{{ asset('images/logo_circulo_2.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div id="app">
        <router-view></router-view>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>