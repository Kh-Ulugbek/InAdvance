<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>In Advance</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="stylesheet" href="./assets/css/login.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="container">
    <div class="screen">
        <div class="screen__content">
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif
            <form method="post" class="login" action="{{ route('postLogin') }}">
                @csrf
                <div class="login__field">
                    <i class="login__icon fas fa-user"></i>
                    <input name="login" type="text" class="login__input" value="{{ old('login') }}" placeholder="User name / Email">
                </div>
                <div class="login__field">
                    <i class="login__icon fas fa-lock"></i>
                    <input name="password" type="password" class="login__input" placeholder="Password">
                </div>
                <button class="button login__submit">
                    <span class="button__text">Log In Now</span>
                    <i class="button__icon fas fa-chevron-right"></i>
                </button>
            </form>
        </div>
        <div class="screen__background">
            <span class="screen__background__shape screen__background__shape4"></span>
            <span class="screen__background__shape screen__background__shape3"></span>
            <span class="screen__background__shape screen__background__shape2"></span>
            <span class="screen__background__shape screen__background__shape1"></span>
        </div>
    </div>
</div>
<!-- partial -->

</body>
</html>
