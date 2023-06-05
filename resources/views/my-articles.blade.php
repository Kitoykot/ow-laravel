@extends('layouts.main')

@section('content')
    <div class="mt-5 mb-2">
        <a href="{{route("add-article")}}">Добавить статью</a>
    </div>

    @foreach ($articles as $article)
        <ul class="list-group mb-3">

            <a href="/article/{{$article->id}}" class="list-group-item list-group-item-action">
                <b>{{$article->title}}</b>

                <form method="POST" action="{{route("delete-article")}}" style="float: right;">
                    @csrf
                    <input type="hidden" name="id" value="{{$article->id}}">
                    <button class="btn btn-danger" type="submit">Удалить</button>
                </form>

                <form style="float: right; padding-right: 10px;" action="/update-article/{{$article->id}}">
                    <input type="hidden" name="id" value="{{$article->id}}">
                    <button class="btn btn-success" type="submit">Изменить</button>
                </form>

                <form method="POST" action="{{route("public-article")}}" style="float: right; padding-right: 10px;">
                    @csrf
                    <input type="hidden" name="id" value="{{$article->id}}">
                    <button class="btn btn-{{(int)$article->public == 1 ? "warning" : "info"}}" type="submit">
                        {{(int)$article->public == 1 ? "Снять с публикации" : "Опубликовать"}}
                    </button>
                </form>
            </a>
        </ul>   
    @endforeach
@endsection
