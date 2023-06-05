@extends('layouts.main')

@section('content')
    <h3 class="mt-5">Создать статью</h3>

    <form class="mt-3" method="POST" action="{{ route('create-article') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Название статьи</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                placeholder="Название статьи" value="{{ old('title') }}">

            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="short">Короткое описание</label>
            <textarea class="form-control @error('short') is-invalid @enderror" rows="3" name="short"
                placeholder="Короткое описание">{{ old('short') }}</textarea>

            @error('short')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <label for="category_id">Тема</label>
        <div class="form-group">
            <select class="form-control" name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="body">Текст статьи</label>
            <textarea class="form-control @error('body') is-invalid @enderror" rows="15" name="body"
                placeholder="Текст статьи">{{ old('body') }}</textarea>

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
