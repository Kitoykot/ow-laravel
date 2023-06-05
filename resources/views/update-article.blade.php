@extends('layouts.main')

@section('content')
    <h3 class="mt-5">Обновить статью &laquo;{{$article->title}}&raquo;</h3>

    <form class="mt-3" method="POST" action="{{ route('update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$article->id}}">
        <div class="form-group">
            <label for="title">Название статьи</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                placeholder="Название статьи" value="{{ old('title') ? old('title') : $article->title }}">

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="short">Короткое описание</label>
            <textarea class="form-control @error('short') is-invalid @enderror" rows="3" name="short"
                placeholder="Короткое описание">{{ old('short') ? old('short') : $article->short }}</textarea>

            @error('short')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <label for="category_id">Тема</label>
        <div class="form-group">
            <select class="form-control" name="category_id">
                <option value="{{ $article->category_id }}">{{ $category_find->title }}</option>
                @foreach ($categories as $category)

                    @if($category->title !== $category_find->title)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endif
                    
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="body">Текст статьи</label>
            <textarea class="form-control @error('body') is-invalid @enderror" rows="15" name="body"
                placeholder="Текст статьи">{{ old('body') ? old('body') : $article->body }}</textarea>

            @error('body')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">

            @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-success mb-5" name="submit">Отправить</button>
    </form>
@endsection
