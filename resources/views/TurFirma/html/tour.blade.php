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
    <link rel="stylesheet" href="{{ asset('css/tour.css') }}">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>
<body>
    @include('TurFirma.includes.navbar')
    @vite('resources/js/tour.js')
    <div class="button_back">
        <a href="javascript:history.back()"><img src="{{ asset('photos/back_btn.svg') }}"> Назад</a>
    </div>
    <div class="tour_title">
        <h1>Хороший выбор!</h1>
        <h3>Настройте тур под себя.</h3>
    </div>
    <section class="tour_edition" id="app">
      <tour-app
      :tour = "{{ json_encode($tur) }}"
      :city = "{{ json_encode($city) }}"
      :country = "{{ json_encode($country) }}"
      :hotel = "{{ json_encode($hotel) }}"
      :rooms = "{{ json_encode($rooms) }}"
      :dop-services = "{{ json_encode($dopServices) }}"
      :transport = "{{ json_encode($transport) }}"
      :num-people = "{{ json_encode($numPeople) }}"
      :auth-check = "{!! json_encode(Auth::check()) !!}"
      
      ></tour-app>
    </section>
    @include('TurFirma.includes.footer')
</body>
</html>