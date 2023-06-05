@extends('layouts.main')

@section('content')
    <h4 align="center" class="mt-4">{{ $article->title }}</h4>
    <hr>

    <div class="one">
        <img src="{{ $article->image }}">
        <p class="name mt-2">Автор: <a href="/profile/{{ $user->id }}">{{ $user->name }}</a></p>
        <p class="name">{{ date('d.m.Y', strtotime($article->created_at)) }}</p>
    </div>
    <hr>

    <p>{{ $article->body }}</p>

    <h4 class="mt-4">Комментарии:</h4>

    @guest
        <p><a href="{{ route('login') }}">Войдите</a> или <a href="{{ route('register') }}">зарегистрируйтесь</a>, чтобы оставлять
            комментарии</p>
    @endguest

    @auth
        <p>Оставьте комментарий:</p>
        <form class="add_comment_form" method="POST" action="{{route("add-comment")}}">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <div class="form-group">
                <label for="body">Текст (<small class="text-muted">максимум 2000 символов</small>)</label>
                <textarea class="form-control @error('body') is-invalid @enderror" rows="3" name="body" placeholder="Текст комментария">{{old('body')}}</textarea>

                @error('body')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    @endauth

    <div class="list-group mt-3">
        @foreach ($comments as $comment)
            <div class="list-group-item flex-column align-items-start mb-3" id="comment">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ App\Models\User::find($comment->user_id)->name }} {{ App\Models\User::find($comment->user_id)->surname }}</h5>
                    <small class="text-muted">{{ date('d.m', strtotime($comment->created_at)) }}</small>
                </div>
                <p class="pt-2 mb-1">{{$comment->body}}</p>
                @auth
                    @if(Auth::user()->id == $comment->user_id)
                        <form method="POST" action="{{route("delete-comment")}}">
                            @csrf
                            <input type="hidden" name="id" value="{{$comment->id}}">
                            <button class="btn btn-link">Удалить</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach
        <div>
            {{$comments->links()}}
        </div>
    </div>
    
    <div class="mb-5"></div>
        @if($articles_category->count() > 1)
            <h4 align="center">Другие статьи на тему &laquo;{{ $category->title }}&raquo;</h4>
            <hr>
            <div class="articles_new mb-5">
                @foreach ($articles_category as $article_category)
                    @if($article_category->id !== $article->id)
                        <div class="article">
                            <img src="{{ $article_category->image }}" align="center" width="300">
                            <h5 class="mt-2">{{ $article_category->title }}</h5>
                            <p class="description mt-2">
                                {{ $article_category->short }}
                            </p>
                            <a href="/article/{{ $article_category->id }}">Читать далее</a>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif 
@endsection
