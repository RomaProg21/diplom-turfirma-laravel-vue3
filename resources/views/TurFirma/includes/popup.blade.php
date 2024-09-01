 <!-- Всплывающее окно авторизации -->
 <div class="login-popup" id="loginPopup">
    <div class="login_header">
        <h3 class="popup-title">Авторизация</h3>
    </div>
    <div class="popup-content">
        <span class="close" onclick="toggleLoginPopup()"></span>
        <h3 class="string3">Заполните поля</h3>
      @include('auth.login')
        <div class="password_settings">
            {{-- <label for="remember_me" class="label_remember_me">
                <input type="checkbox" id="remember_me" class="remember_me">
                <span class="custom_checkbox"></span>
                <span>Запомнить меня</span>
            </label>
            <span><a href="">Забыли пароль?</a></span> --}}
        </div>
        <button id="formSubmit" type="submit" class="button-log-in">Войти</button>
        <h3 class="maybe_registration"><span>Еще нет аккаунта? <a href="{{route('registration')}}"> Зарегистрируйся!</a></span></h3>
    </div>
</div>
<!-- Затемнение -->
<div class="overlay" id="overlay" onclick="toggleLoginPopup()"></div>
<script src="{{ asset('js/autorization.js') }}"></script>

<script type="text/javascript">
    var myForm = document.forms['myForm'];
    var formSubmit = document.getElementById('formSubmit');

    formSubmit.onclick = function(){
        myForm.submit();
    }
</script>
