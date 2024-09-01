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
    <link rel="stylesheet" href="{{ asset('css/turpackeges.css') }}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
   @include('TurFirma.includes.navbar')
   @vite('resources/js/turpackeges.js')
    <div class="button_back">
        <a href="javascript:history.back()"><img src="{{ asset('photos/back_btn.svg') }}"> Назад</a>
    </div>
    <div class="profile_title">
        <h1>Найдите тур по душе</h1>
        <h3>Выберите понравившийся тур.</h3>
    </div>

    <div id="app">
        <turpackeges-app
        :turs= "{{ json_encode($turs)  }}"
        >
        @csrf
        </turpackeges-app>
    </div>

  
    @include('TurFirma.includes.footer')
    <script src="{{ asset('js/search.js') }}"></script>
    
</body>
</html>