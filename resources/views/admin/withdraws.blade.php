@extends('layouts.appAdmin')


@section('content')

    <div class="content-wrapper">

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Сумма</th>
                <th>Дата</th>
                <th>Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($withdraws as $withdraw)
                <tr>
                    <td>
                        {{$withdraw->sum}}
                    </td>
                    <td>
                        {{$withdraw->created_at}}
                    </td>
                    <td>
                        {{$withdraw->phone}}
                    </td>
                    <td>
                        @if($withdraw->status == 'waiting')

                            В ожиданий
                        @elseif($withdraw->status == 'ok')

                            Выполнено
                        @endif
                    </td>
                    <td>
                        <a href="{{route('admin.AcceptWithdraw',$withdraw->id)}}" class="btn btn-primary">Принять</a>
                    </td>
                </tr>

            @endforeach

            </tbody>
        </table>
        {{$withdraws->links()}}
    </div>
    <style>
        .content-wrapper{
            padding-left: 15px;
            padding-right: 15px;
        }
    </style>
@endsection
