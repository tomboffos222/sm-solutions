@extends('layouts.app')

@section('content')




    <div class="content-wrapper text-center d-flex align-items-center flex-column ">
        <form action="{{route('QuestionCreate')}}" method="get" class="text-center w-50">
                <h2>Письмо тех поддержке</h2>
                <input type="hidden" name="user_id" value="{{$user->id}}">
                <textarea name="question" id="" cols="30" rows="10" class="form-control mt-5"></textarea>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary mt-5">
                </div>
        </form>
        <div class="w-50 ">
            @foreach($messages as $message)
            <div class="card w-100 text-left pl-5 ">
                <h4>Вопрос : {{$message->question}}</h4>
                <h4>Ответ : @if($message['answer'] == null) Ждем ответа @else {{$message->answer}} @endif</h4>
                <h6>Дата вопроса: {{$message->created_at}}</h6>
            </div>
            @endforeach
            {{$messages->links()}}
        </div>
    </div>
@endsection
