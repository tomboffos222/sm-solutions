@extends('layouts.app')



@section('content')


    <div class="content-wrapper p-l-20 p-r-20 d-flex justify-content-center flex-column align-items-center " style="padding-top:10px;">
        <div class="card text-center d-flex justify-content-center flex-row w-50">
            <img src="{{asset('images/sm-solutions.png')}}" alt="" class="w-100 ">
        </div>
        <div class="card text-center m-l-20 m-r-20 w-50 ">
            <form action="" class=" p-l-20 p-r-20">
                <div class="form-group">
                    <label for="">Логин</label><input type="text" class="form-control"  value="{{$user->login}}">
                </div>
                <div class="form-group">

                    <label for="">Имя</label>
                    <input type="text" class="form-control" placeholder="" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="">Номер телефона</label>
                    <div class="form-control text-left">
                        {{$user->phone}}
                    </div>


                </div>
                <div class="form-group">
                    <label for="">Пароль</label>
                    <input type="password" class="form-control" value="{{$user->password}}">
                </div>
                <div class="form-group">
                    <label for="">Почта</label>
                    <input type="text" class="form-control" value="{{$user->email}}">
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Изменить">
                </div>
            </form>

        </div>
    </div>
    <style>
        @media (max-width: 720px) {
            .w-50{
                width: 80% !important;
            }


        }
    </style>


    @endsection
