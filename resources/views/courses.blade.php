@extends('layouts.app')

@section('content')


    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <button  class="btn-primary btn courses_free" >
                    Бесплатные курсы
                </button>
                <button  class="btn-danger btn courses_private">
                    Платные курсы
                </button>
            </div>
            <div class="col-lg-4 free active">
                <iframe width="85%" height="250px" src="https://www.youtube.com/embed/iR9WzyX37Vw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-4 free active">
                <iframe width="85%" height="250px" src="https://www.youtube.com/embed/i2bFAA9_X4k" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-4 free active">
                <iframe width="85%" height="250px"  src="https://www.youtube.com/embed/nMgWS45EWek" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-4 free active mt-5">
                <iframe width="85%" height="250px" src="https://www.youtube.com/embed/zGl3UoR-D20" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="col-lg-4 free active mt-5">
                <iframe width="85%" height="250px" src="https://www.youtube.com/embed/xdKDfiRvEW0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-lg-4 free active mt-5">

                <iframe width="85%" height="250px" src="https://www.youtube.com/embed/62c1OtJlrQo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            </div>
            <div class="col-lg-4 free active mt-5">
                <iframe width="85%" height="250px" src="https://www.youtube.com/embed/8-kHwARWwu4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            @foreach($cats as $cat)
                @if($cat['type'] == 'free')
                    @if($cat['id'] != 7)
                    <div class="col-lg-4 free active mb-5 text-center">
                        <a href="" class="btn btn-success">
                            {{$cat->name}}
                        </a>
                    </div>
                        @endif

                @endif

            @endforeach
            @if($cat['id'] == 7)
                <div class="col-lg-4 private text-left " style="text-align:left;">
                    <a href="{{route('InstaDesign')}}" class="btn btn-success">
                        {{$cat->name}}
                    </a>
                </div>
            @endif
            @foreach($cats as $cat)
                @if($cat['type'] == 'paid')
                    <div class="col-lg-4 private mb-5">
                        <a href="{{route('Course',$cat->id)}}" class="btn btn-success">
                            {{$cat->name}}
                        </a>
                    </div>

                @endif

            @endforeach



            {{$cats->links()}}


        </div>

    </div>
    <style>
        .container{
            padding-left: 150px;

        }
        .col-lg-12 button{
            margin-right: 20px;
            margin-bottom: 20px;

        }
        .content-wrapper{
            padding-left: 50px;
        }
        .private.active{
            display: block;
        }
        .free.active{
            display: block;
        }
        .free, .private{
            display: none;
        }
        video{
            width: 100%;
            height: 300px;
        }

    </style>
    @endsection
