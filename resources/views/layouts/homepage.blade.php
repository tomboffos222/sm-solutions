<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
<div class="overflow">
    <header>
        <div class="container">
            <div class="row">
                <div class="header__body">
                    <a href="#" class="header__logo">
                        <img src="images/sm-solutions.png" >
                    </a>
                    <div class="header__burger">
                        <span></span>
                    </div>
                    <nav class="header__menu" >
                        <ul class="header__list">
                            <li>
                                <a href="#" class="header__link">Главная</a>
                            </li>
                            <li>
                                <a href="#first" class="header__link">Что предлогаем</a>
                            </li>
                            <li>
                                <a href="#lessons" class="header__link">Уроки</a>
                            </li>
                            <li>
                                <a href="#third" class="header__link">Отзывы</a>
                            </li>
                            @php
                                use App\User;$user = session()->get('user');
                                $user = User::find($user['id']);
                            @endphp
                            @if($user==null)
                                <li>
                                    <a href="{{route('LoginPage')}}" class="kriks" onclick="">Войти</a>
                                </li>
                                <li>
                                    <a href="{{route('RegisterPage')}}" class="ganik" onclick="">Регистрация</a>
                                </li>
                            @else
                                @if($user->status == 'registered')
                                    <li>
                                        <a href="{{route('Partner')}}">
                                            Стать партнером
                                        </a>
                                    </li>
                                @elseif($user->status == 'partner')
                                    <li>
                                        <a href="{{route('home')}}">Личный кабинет</a>
                                    </li>
                                @endif

                                <li>
                                   {{$user->name}}
                                </li>
                            @endif

                        </ul>
                    </nav>
                </div>
            </div>
            <div class="row banner">
                <div class="col-lg-5">
                    <h1>
                        Зарабатывай не выходя из дома <br> в месте с нами
                    </h1>
                    <p>
                        Работаем на международном рынке, по новым технологиям: удаленно, через интернет из любой точки мира.


                    </p>
                    <a href="{{route('RegisterPage')}}" class="btn btn-primary">
                        Записаться
                    </a>
                </div>
                <div class="col-lg-7">
                    <img src="https://weboth.us/preview/fluxo-v1.0.0/html/images/hero_image@2x.png" alt="">
                </div>

            </div>
        </div>
    </header>
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
    @yield('content')
    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-7" class="logo">
                    <img src="images/sm-solutions-bel.png" alt="" class="logo" style="height: 100px !important;">

                </div>
                <div class="col-lg-5">
                    <div class="menu">
                        <nav>
                            <ul>
                                <li><a href="">Главная</a></li>
                                <li><a href="">О нас</a></li>
                                <li><a href="">Регистрация</a></li>
                                <li><a href="">Войти</a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-12" style="text-align: center; padding-top: 38px;">
                    <img src="images/mastercard1.png" alt="">
                </div>

                <div class="col-lg-12 mb-5" style="margin-top:60px;">
                    <hr>
                </div>
                <div class="col-lg-8">
                    ©2020 - SM-Solutions. Все права защищены.<a>Сайт был разработан в NEXT IN</a>


                </div>
                <div class="col-lg-4 ">
                    <div class="menu social_icons">
                        <ul>
                            <li><a href="https://wa.me/77781912201"><i class="fab fa-whatsapp"></i></a></li>
                            <li><a href=""><i class="fab fa-instagram"></i></a></li>
                            <li><a href=""><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
<script src="https://kit.fontawesome.com/79acc08bd7.js" crossorigin="anonymous"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script>
    $(document).ready(function(){
        // Add smooth scrolling to all links
        $("a").on('click', function(event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });
</script>
<script src="https://apps.elfsight.com/p/platform.js" defer></script>

</body>

</html>
