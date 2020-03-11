@extends('layouts.appAdmin')


@section('content')




    <div class="content-wrapper">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Имя</th>
                <th>Телефон</th>

                <th>Почта</th>
                <th>Статус</th>
                <th>Дата регистрации</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                <tr>
                    <td>
                        <a href="{{route('admin.User',$user->id)}}">
                            {{$user->login}}
                        </a>
                    </td>
                    <td>{{$user->phone}}</td>

                    <td>{{$user->status}}</td>
                    <td>{{$user->email}}</td>

                    <td>{{$user->created_at}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{$users->links()}}
    </div>
@endsection
