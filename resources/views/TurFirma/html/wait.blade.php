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
    <link rel="stylesheet" href="{{ asset('css/wait.css') }}">
</head>
<body>
    @include('TurFirma.includes.navbar')
    <div class="button_back">
        <a href="javascript:history.back()"><img src="{{ asset('photos/back_btn.svg') }}"> Назад</a>
    </div>
    <div class="tour_title">
        <h1>Спасибо, что выбрали нас</h1>
    </div>
    <section class="notification">
        <div class="img_notification">
            <img src="{{ asset('photos/fireworks_1.svg') }}" alt="photos">
            <img src="{{ asset('photos/good.svg') }}" alt="photos">
            <img src="{{ asset('photos/fireworks_2.svg') }}" alt="photos">
        </div>
        <h1>Бронь прошла успешно</h1>
        <p>Ваша путевка будет готова в течение 3 рабочих дней, а пока мы все проверим.</p>
        <div>
            <button onclick="window.location.href = '/'" class="to_main">Главная</button>
            <button onclick="window.location.href = '/profileUser'" class="to_profile">Профиль</button>
        </div>
    </section>
    @include('TurFirma.includes.footer')

</body>
</html>