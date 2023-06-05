@extends('layouts.main')

@section('content')
        @if($new_articles->count() > 0)
            <h4 align="center" class="mt-4">Новые статьи</h4>
            <hr>
            <div class="articles_new mt-4">
                @foreach ($new_articles as $new_article)
                    <div class="article">
                        <img src="{{$new_article->image}}"
                            align="center" width="300">
                        <h5 class="mt-2">{{$new_article->title}}</h5>
                        <p class="description mt-2">
                            {{$new_article->short}}
                        </p>
                        <a href="/article/{{$new_article->id}}">Читать далее</a>
                    </div> 
                @endforeach
            </div>
            <hr>
        @endif

        @if($articles->count() > 0)

            <h4 align="center" class="mt-4">Ранее опубликованные</h4>
            
            <div class="articles mt-4 mb-5">
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
        @endif
@endsection
