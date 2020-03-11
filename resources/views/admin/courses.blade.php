@extends('layouts.appAdmin')



@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 d-flex" >
                <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#exampleModal">
                    Добавить курс
                </button>
                <button type="button" class="btn btn-success ml-5 mb-5 " data-toggle="modal" data-target="#addCat">
                    Добавить категорию

                </button>
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Добавление курса</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.CreateCourse')}}" enctype="multipart/form-data" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group"><input type="file" name="video" class="form-control" id="video"></div>
                                    <div class="form-group"><input name="title" type="text" placeholder="Название видео " class="form-control"></div>
                                    <div class="form-group">
                                        <textarea name="description" placeholder="Описание"  class="form-control"  id="" cols="30" rows="5"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <select name="cat" class="form-control" id="">
                                            @foreach($cats as $cat)
                                            <option value="{{$cat->id}}">
                                                {{$cat->name}}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group"><input type="submit" class="bg-blue form-control"></div>
                                </form>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="addCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Добавление категорий</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.CreateCat')}}" enctype="multipart/form-data" method="get">
                                    {{ csrf_field() }}

                                    <div class="form-group"><input name="title" type="text" placeholder="Название видео " class="form-control"></div>

                                    <div class="form-group">
                                        <select name="type" id="" class="form-control">
                                            <option value="free">
                                                Бесплатная категория
                                            </option>
                                            <option value="paid">
                                                Платная категория
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group"><input type="submit" class="bg-blue form-control"></div>
                                </form>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
            <div class="col-lg-4 text-center">
                <video controls>
                    <source  src="{{asset($course->url)}}">
                </video>
                <h4>{{$course->title}}</h4>

            </div>
                @endif
        @endforeach
            <div class="col-lg-12">
                {{$courses->links()}}
            </div>

        </div>

    </div>
    <style>

        .content-wrapper{
            padding: 0px 20px;
        }
        video{
            width: 100%;
            height: 300px;
        }
    </style>


@endsection
