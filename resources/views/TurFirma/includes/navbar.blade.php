<link rel="stylesheet" href="{{ asset('css/popup.css') }}">

<div class="wallpaper-header">
    <header class="header">
        <a href="{{ route('main') }}">
            <img class="logo" src="{{ asset('photos/logo.png') }}">
        </a>
        <nav>
            <ul class="menu-header">
                <li><a   href="{{ route('main') }}">Главная</a></li>
                <li><a href="">О нас</a></li>
               
                <li><a href="{{ route('turpackeges') }}">Туристические пакеты</a></li>
             
                <li><a href="">Контакты</a></li>
            </ul>
        </nav>
        <nav>
            <ul class="menu-header header-register">
                <li class="last"><a href="{{ route('main') }}">Рус &blacktriangledown;</a>
                    <ul>
                        <li class="last"><a href="maineng.html">Eng</a></li>  
                    </ul>
                </li>
                @if(Auth::check()==false)
                <li><a href="#" onclick="toggleLoginPopup()">Войти</a></li>
                <li class="background-register"><div class="epr"><a href="{{ route('registration') }}" class="button-register">Регистрация</a></div></li>
                @endif
                @if(Auth::check())
                    <li><a href="{{ route('profileUser') }}">{{Auth::user()->name}}</a></li>
                 

                <li><a>
                    <form method="POST" action="{{route('logout')}}">
                        @csrf
                        @method('post')
                        <button class="button-register" type="submit">Выйти</button>
                        
                    </form>
                    </a></li>

                @endif
            </ul>
        </nav>
    </header>
</div>

@include('TurFirma.includes.popup')

