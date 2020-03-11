@extends('layouts.appAdmin')


@section('content')


    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 d-flex pl-5 ">
                <div class="card w-25 mt-5 ml-5 p-3">
                    <h5>Информация об аккаунте</h5>
                    <p>Имя : <b>{{$user->name}}</b></p>
                    <p>Телефон : <b>{{$user->phone}}</b></p>
                    <p>Почта : <b>{{$user->email}}</b></p>
                    <p>Логин : <b> {{$user->login}}</b></p>

                </div>


                <div class="card w-25 mt-5 ml-5 p-3 ">
                    <h5>Купленные аккаунты</h5>
                    @foreach($accounts as $account)
                        <p>Логин : <b>{{$account->login}}</b> <br> Имя : <b>{{$account->name}} </b></p>
                    @endforeach
                </div>
                <div class="card w-25 mt-5 ml-5 p-3">
                    <h5>Реферальные пользователи</h5>
                    @foreach($refers as $refer)
                        <p>
                            Логин : <b><a href="{{route('admin.User',$refer->id)}}">{{$refer->login}}</a></b> <br>
                            Имя : <b>{{$refer->name}}</b>
                        </p>

                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
