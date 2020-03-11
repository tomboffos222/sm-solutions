@extends('layouts.app')

@section('content')


    <div class="content-wrapper">
        <div class="row">


            @foreach($courses as $course)
                @if($course['cat_id'] == 5)
                    <div class="col-lg-4 text-center">
                        <iframe  src="{{$course->url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <h5>{{$course->title}}</h5>
                    </div>


                @elseif($course['cat_id'] == 6)
                    <div class="col-lg-4 text-center">
                        <iframe  src="{{$course->url}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <h5>{{$course->title}}</h5>
                    </div>

                @else
                <div class="col-lg-4 " >
                    <video controls controlsList="nodownload">
                        <source  src="{{asset($course->url)}}">
                    </video>
                </div>

                @endif


            @endforeach



            <div class="col-lg-12">
                {{$courses->links()}}
            </div>


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
