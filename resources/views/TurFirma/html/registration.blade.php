<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Breathtaking</title>
    <link class="logo" rel="icon" href="{{ asset('photos/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('fonts/gothampro.ttf') }}">
    <link rel="stylesheet" href="{{ asset('fonts/Carattere-Regular.ttf') }}">
    <link rel="stylesheet" href="{{ asset('css/registration.css') }}">
</head>
<body>
    @include('TurFirma.includes.navbar')

    @vite('resources/js/registration.js')
 
    <div class="button_back">
        <a href="javascript:history.back()"><img src="{{ asset('photos/back_btn.svg') }}"> Назад</a>
    </div>
    <div id="app">
        <registration-app
        >
        @csrf
    </registration-app>
    </div>

  

    @include('TurFirma.includes.footer')
    @include('TurFirma.includes.popup')

    <script src="{{ asset('js/autorization.js') }}"></script>
</body>
</html>