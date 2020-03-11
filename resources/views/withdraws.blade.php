@extends('layouts.app')


@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h5>Баланс : {{$user->balance}}</h5>
            </div>
            <div class="col-lg-12">
                <button class="btn btn-success mb-5" data-toggle="modal" data-target="#modalOne">
                     Сделать вывод
                </button>
                <div class="modal fade" id="modalOne" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title col-black" id="exampleModalLabel" style="color:black;">Создание вывода</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body " style="color:black;">
                                <div class="text-center mb-3 " >
                                    <h4>
                                        Укажите номер телефона <br> который зарегистрирован на indigo24
                                    </h4>
                                </div>
                                <form action="{{route('WithdrawCreate')}}">
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="phone" value="{{$user->phone}}">


                                    </div>
                                    <div class="form-group">
                                        <input type="number" class="form-control" name="sum">

                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary mt-2">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        @if($withdraw->status == 'waiting')

                            В ожиданий
                            @elseif($withdraw->status == 'ok')

                            Выполнено
                            @endif
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
