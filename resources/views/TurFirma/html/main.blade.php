@include('TurFirma.includes.header')
    <section class="main-menu">
        @include('TurFirma.includes.navbar')
        <div class="wallpaper-heading">
            <h1 class="string1">Engoy in the best way!</h1>
            <h3 class="string2">Наслаждайтесь путешествием!</h3>
        </div>
        @vite('resources/js/searchMain.js')
        <div class="wallpaper-workplace">
            <div class="in-wallpaper-workplace" id="app">
                <form class="forma">
                    <label for="guests" class="form_label_guest">
                        <span>Количество человек</span>
                        <select id="guests" class="guests_input">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>                
                    </label>
                    <label for="departure-date" class="form_label_date">
                        <span>Дата отъезда</span>
                        <input type="date" id="departure-date">
                    </label>
                    <label for="duration" class="form_label_duration">
                        <span>Продолжительность</span>
                        <input type="number" id="duration" min="1" value="1" placeholder="Выберите время"> 
                    </label>
                    <search-main
                    :all-city = "{{ json_encode($allCity) }}"
                    ></search-main>
                
                    <button type="button" class="search" onclick="saveLocalStorage()">
                        <img class="search_button" src="/photos/search.svg" alt="search">
                    </button>
                    {{-- @if(Auth::check()==false)
                    <button type="button" class="search" onclick="alert('Сначала нужно авторизоваться или зарегестрироваться.')">
                        <img class="search_button" src="/photos/search.svg" alt="search">
                    </button>
                    @endif --}}
                </form>
            </div>
        </div>
        <div class="space"></div>
    </section>
    <section class="popular_blog">
        <div class="popular_conteiner">
            <div class="popular_top">
                <div class="popular_top_in">
                    <h2 class="pupular_title">Посмотрите на наши популярные направления</h2>
                </div>
                <div class="popular_controls">
                    <button id="sliderPrev">
                        <img src="{{ asset('photos/button_left.svg') }}">
                    </button>
                    <button id="sliderNext">
                        <img src="{{ asset('photos/button_right.svg') }}">
                    </button>
                </div>
            </div>
            <div class="popular_content">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        
                        @foreach($popular as $tur)
                        <div class="swiper-slide">
                            <div class="popular_card">
                                <a href="#">
                                    <img style="min-width:300px;min-height:370px;max-width:300px;max-height:500px" src="{{ asset($tur['tur']->photo) }}" alt="photos">
                                    <h3 class="card_title">{{$tur['tur']->name}}</h3>
                                    <h3 class="card_title">{{ $tur['country']->name }}</h3>
                                    <h3 class="card_price">от {{ $tur['tur']->price }} рублей</h3>
                                    <div class="card_description">{{ $tur['tur']->descr }}</div>
                                </a>
                            </div>
                        </div>
                        @endforeach
                       
                       
                    </div>
                </div>
            </div>
        </div>
    </section>
   @include('TurFirma.includes.footer')
   @include('TurFirma.includes.script')
   <script>
    function saveLocalStorage(){

        localStorage.setItem('num_people', document.getElementById('guests').value)
        localStorage.setItem('date', document.getElementById('departure-date').value)
        localStorage.setItem('duration', document.getElementById('duration').value)
        localStorage.setItem('destination', document.getElementById('destination').value)
        localStorage.setItem('where', document.getElementById('where').value);
        window.location.href = 'turpackeges';

    }
   </script>
  