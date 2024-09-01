<section class="footer_menu">
    <footer class="footer">
        <div class="end_logo">
            <a href="/html/main.html">
                <img src="{{ asset('photos/logo.png') }}" alt="photos" class="logo">
            </a>
        </div>
        <div class="end_line"></div>
        <div class="end_menu">
            <div class="footer_navigation">
                <h4>Страницы</h4>
                <ul class="footer_navigation_in">
                    <li><a href="{{ route('main') }}">Главная</a></li>
                    <li><a href="#">О нас</a></li>
                    <li><a href="{{ route('turpackeges') }}">Туристические пакеты</a></li>
                    @if(Auth::check())
                    <li><a href="{{ route('registration') }}">Регистрация</a></li>
                    @endif
                </ul>
            </div>
            <div class="footer_navigation">
                <h4>Помощь</h4>
                <ul class="footer_navigation_in">
                    <li><a href="#">Условия использования</a></li>
                    <li><a href="#">Политика предоставления услуг</a></li>
                </ul>
            </div>
            <div class="footer_navigation">
                <h4>Контакты</h4>
                <ul class="footer_navigation_in">
                    <li><a target="_ blank" href="https://yandex.ru/maps/43/kazan/house/ulitsa_tashayak_2a/YEAYdg5nTkUOQFtvfXt4d3tqZA==/?ll=49.102120%2C55.796336&z=16.97">г. Казань, ул. Ташаяк, 2А</a></li>
                    <li>+7 800 500 33 50</li>
                    <li>breathtaking@yandex.ru</li>
                </ul>
            </div>
            <div class="footer_navigation">
                <h4>Социальные сети</h4>
                <div class="social">
                    <a href="#"><img src="{{ asset('photos/Telegram.svg') }}" alt="photos"></a>
                    <a href="#"><img src="{{ asset('photos/VK.svg') }}" alt="photos"></a>
                    <a href="#"><img src="{{ asset('photos/Instagram.svg') }}" alt="photos"></a>
                </div>
            </div>
        </div>
        <div class="end_line"></div>
        <h3>Авторские права © 2024, Все права защищены</h3>
    </footer>
</section>