@extends('layouts.homepage')



@section('content')

    <div class="container  mt-5 mb-5">
        <div class="">
            <h4 class="text-center">
                Чтобы стать нашим партнером и пополнить баланс в размере 12000 тг.<br>
                нажмите на кнопку
            </h4>
        </div>

        <div class="mt-5">
            <form action="{{route('Test')}}" class="" method="get">
                <div class="form-group">
                    <input type="hidden" name="user_id" value="{{$user->id}}">

                    <input type="submit" class="btn btn-danger mt-4" value="оплатить">
                </div>

            </form>
        </div>
    </div>
    <style>
        .row.banner{
            display: none;
        }
    </style>



@endsection
