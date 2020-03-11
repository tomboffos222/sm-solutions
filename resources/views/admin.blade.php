@extends('layouts.homepage')


@section('content')
    <div class="container d-flex justify-content-center mt-5 mb-5">
    <form action="{{route('AdminLogin')}}" method="get" class="text-center w-50">
        <div class="form-group">

                <input type="text" name="login" placeholder="Логин" class="form-control">

        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="пароль" name="password">
        </div>
        <input type="submit" class="btn btn-danger">
    </form>
    </div>
    <style>
        .row.banner{
            display: none;
        }
    </style>



    @endsection
