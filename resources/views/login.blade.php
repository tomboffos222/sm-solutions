<!DOCTYPE html>

<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->

<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->

<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->

<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Вход в личный кабинет</title>

    <link rel="stylesheet" href="{{asset('css/cabinet.css')}}">
    <link rel="stylesheet" href="{{asset('css/registration.css')}}">

    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>

<body>
<div class="kuylover">


<!-- vladmaxi top bar -->

<div class="vladmaxi-top">



    <span class="left">

            <a href="{{route('Welcome')}}" class="text-decoration-none" style="text-decoration: none;">

                <strong class="text-decoration-none" style="text-decoration: none;">Вернуться назад</strong>

            </a>

        </span>

    <div class="clr"></div>

</div>

<!--/ vladmaxi top bar -->



<section class="container">
    <div class="xromo"> <img src="{{asset('images/sm-solutions-bel.png')}}" alt=""> </div>
    <div class="login">

        <div class="title-text"><h1>Личный кабинет</h1></div>

        <form method="get" action="{{route('Login')}}" class="forma">
            <div class="">
                <input type="text" name="login" class="form-control" value="" placeholder="Логин" class="zapol">
            </div>

            <div class="">
                <input type="password" name="password" value="" placeholder="Введите пароль" class="form-control">
            </div>
            <div class="login-help">


                <input type="submit" class="mybtn btn btn-primary form-control"  value="Войти">

            </div>
        </form>
        <a href="{{route('ResetPass')}}">
            Забыли пароль?
        </a>
    </div>
</section>

</body>

</html>

