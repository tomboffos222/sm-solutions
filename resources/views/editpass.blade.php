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
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="title-text"><h1>Изменение пароль</h1></div>

            <form method="get" action="{{route('PassConfirm')}}" class="forma">
                <div class="">
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <input type="password" name="password" class="form-control"  placeholder="Ваш пароль" class="zapol">

                </div>


                <div class="login-help">


                    <input type="submit"  class="mybtn btn btn-primary form-control"  value="Отправить">

                </div>
            </form>
        </div>
    </section>
</div>

</body>

</html>

