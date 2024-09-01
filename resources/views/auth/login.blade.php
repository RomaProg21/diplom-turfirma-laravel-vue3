<form method="POST" name="myForm" class="login_form" action="{{ route('login') }}">
    @csrf
    <input type="email" name="email" id="login" placeholder="Логин" required class="login_input">
    @error('login')
    <p class="text-danger">{{$message}}</p>
    @enderror  
    <input type="password" name="password"  placeholder="Пароль" required class="password_input">
    @error('password')
    <p class="text-danger">{{$message}}</p>
    @enderror  
</form>
