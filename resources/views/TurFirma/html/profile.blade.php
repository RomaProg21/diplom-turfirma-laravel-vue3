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
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    @include('TurFirma.includes.navbar')
        <script src="{{ asset('js/script.js') }}/"></script>

    @vite('resources/js/profile.js')
    <div class="button_back">
        <a href="javascript:history.back()"><img src="{{ asset('photos/back_btn.svg') }}"> Назад</a>
    </div>
    <div class="profile_title">
        <h1>Добро пожаловать!</h1>
        <h3>Выберите нужный для вас пункт меню</h3>
    </div>
    <section id="app" class="profile_data">
        <profile-app
        :user = "{{ json_encode($auth) }}"
        :reservation = "{{ json_encode($reservation) }}"
        :csrf = "{{ json_encode(csrf_token()) }}"
        :favorite-all = "{{ json_encode($favoriteAll) }}" 
        >
        @csrf
        </profile-app>
    </section>
   @include('TurFirma.includes.footer')
</body>
</html>
