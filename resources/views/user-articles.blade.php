@extends('layouts.main')

@section('content')
    <div class="mt-5">
        @foreach ($articles as $article)
            <ul class="list-group mb-3">
                <a href="/article/{{$article->id}}" class="list-group-item list-group-item-action">
                    <b>{{$article->title}}</b>
                </a>
            </ul>   
        @endforeach
    </div>
@endsection
