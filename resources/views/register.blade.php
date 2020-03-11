<!DOCTYPE html>

<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->

<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->

<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->

<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Регистрация на сайте</title>

    <link rel="stylesheet" href="{{asset('css/registration.css')}}">


    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

</head>

<body style="background-image:url({{asset('images/303.jpg')}})">
<div class="kuylover" >



    <!-- vladmaxi top bar -->

    <div class="vladmaxi-top">

        <a href="{{route('Welcome')}}"  class="left"> <strong>Главная</strong> </a>

        <span class="right">



        </span>

        <div class="clr"></div>

    </div>

    <!--/ vladmaxi top bar -->



    <section class="container">

        <div class="xromo"> <img src="{{asset('images/sm-solutions-bel.png')}}" alt=""> </div>
        <div class="login">
            @if ($errors->any())
                <div class="alert alert-danger text-center" >
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session()->has('message'))
                <div class="alert alert-success text-center ">
                    {{ session()->get('message') }}
                </div>
            @endif

            <div class="title-text"><h1>Регистрация</h1></div>

            <form method="get" action="{{route('Create')}}" class="forma">
                <div class="">
                    <input type="text" name="name" value="" placeholder="Ф.И.О" class="zapol">
                </div>
                <div class="">
                    <input type="tel" name="phone" value="" placeholder="Номер телефона">
                </div>
                <div class="">
                    <input type="text" name="email"  placeholder="Ваша почта">
                </div>
                <div class="">
                    <input type="text" name="login" placeholder="Ваш логин">
                </div>
                <div class="">
                    <input type="number" name="referBy" value="" placeholder="ID Консультанта">
                </div>
                <div class="">
                    <input type="password" name="password" id="myInput" value="" placeholder="Придумайте пароль">
                    <input type="checkbox" id="check" onclick="myFunction()">
                    <label for="#check">Показать пароль</label>
                </div>

                <div class="cool" style="position:relative;top:15px;">
                    <p> <input type="checkbox" name="sogl" required value="yes">Согласен с <a href="{{asset('uploads/dogovor.pdf')}}" id="pravila">правилами</a> </p>
                    <button class="btn btn-primary position-relative " >Зарегистрироваться</button>
                </div>
            </form>

        </div>


        <script>
            function myFunction() {
                var x = document.getElementById("myInput");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
        </script>

    </section>

</div>
</body>

</html>

