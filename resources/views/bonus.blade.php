@extends('layouts.app')

@section('content')

    <div class="content-wrapper pl-5 pr-5">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Сумма</th>
                <th>Причина</th>
            </tr>
            </thead>
            <tbody>
            @foreach($bonuses as $bonus)
            <tr>
                <td>{{$bonus->sum}} тенге</td>
                <td>{{$bonus->text}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {{$bonuses->links()}}
    </div>

@endsection
