@extends('layouts.main')

@section('content')
    @if ($articles->count() == 0)
        <p class="mt-5">Статей на эту тему ещё нет</p>
    @endif
    <div class="articles mt-5">
        @foreach ($articles as $article)
            <div class="article">
                <img src="{{$article->image}}"
                    align="center" width="300">
                <h5 class="mt-2">{{$article->title}}</h5>
                <p class="description mt-2">
                    {{$article->short}}
                </p>
                <a href="/article/{{$article->id}}">Читать далее</a>
            </div> 
        @endforeach
    </div>
@endsection
