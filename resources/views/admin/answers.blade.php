@extends('layouts.appAdmin')



@section('content')

    <div class="content-wrapper pl-5 pr-5">
        <div class="row">
            <div class="col-lg-12 d-flex">
                <button class="mb-5 btn btn-danger mr-5 courses_free">
                    Неотвеченные сообщения
                </button>
                <button class="mb-5 btn btn-success mr-5 courses_private">
                    Отвеченные сообщения
                </button>

            </div>
            @foreach($questions as $question)
                <div class="col-lg-4 free active card p-2">
                    <h4>
                        Вопрос : <b>{{$question->question}} </b>
                    </h4>
                    <h6>
                        Дата вопроса : <b>{{$question->created_at}}</b>
                    </h6>
                    <button class="btn btn-outline-danger w-50 mt-2 ml-auto" data-toggle="modal" data-target="#modal_free_{{$question->id}}">

                        Ответить
                    </button>
                    <div class="modal fade" id="modal_free_{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Добавление ответа</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.AnswerCreate')}}" enctype="multipart/form-data" method="get">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="question_id"  value="{{$question->id}}">
                                        <textarea name="answer" class="mb-5 form-control" id=""  >

                                        </textarea>


                                        <div class="form-group"><input type="submit" class="bg-blue form-control"></div>
                                    </form>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-12 free">
                {{$questions->links()}}
            </div>
            @foreach($answered as $answer)
                <div class="col-lg-4 private card p-2 pl-2 pr-2">
                    <h4>
                        Вопрос : <b>{{$answer->question}} </b>
                    </h4>
                    <h6>
                        Дата ответа : <b>{{$answer->updated_at}}</b>
                    </h6>
                    <h6>
                        Ответ : <b>{{$answer->answer}}</b>
                    </h6>
                    <button class="btn btn-outline-danger w-50 mt-2 ml-auto" data-toggle="modal" data-target="#modal_paid_{{$answer->id}}">

                        Редактировать
                    </button>
                    <div class="modal fade" id="modal_paid_{{$answer->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Добавление ответа</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.AnswerCreate')}}" enctype="multipart/form-data" method="get">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="question_id"  value="{{$answer->id}}">
                                        <textarea name="answer" class="mb-5 form-control" id=""  >

                                        </textarea>


                                        <div class="form-group"><input type="submit" class="bg-blue form-control"></div>
                                    </form>
                                </div>
                                <div class="modal-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
            <div class="col-lg-12 private">
                {{$answered->links()}}
            </div>
        </div>
    </div>
    <style>

        .free , .private{
            display: none;

        }
        .free.active , .private.active{
            display: block;
        }
        textarea{
            width: 100%;
        }

    </style>
@endsection
