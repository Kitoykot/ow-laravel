@extends('layouts.main')

@section('content')
    <div class="profile_settings">
        <p class="mt-5">Настройки профиля</p>
        
        @foreach ($users as $user)
                @if(is_null($user->avatar))

                    <img src="{{ asset('assets/images/avatar.png') }}" width="230">

                @else
                    <img src="{{ $user->avatar }}" width="230">
                @endif
            <hr>

            <form method="POST" action="{{ route('update-profile') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <div class="form-group">
                    <label for="description">Небольшое описание</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" rows="3" name="description">{{ old('description') ? old('description') : $user->description }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <p class="link_show_settings">
                    Настройки фотографии
                </p>

                <div class="settings_avatar">
                    <p class="link_hide_settings">
                        Скрыть настройки
                    </p>

                    <div class="form-group">
                        <label for="avatar">Прикрепите фото</label>
                        <input type="file" class="form-control-file @error('avatar') is-invalid @enderror"
                            name="avatar">

                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-success">
                    Обновить
                </button>
            </form>

    
            @if(!is_null($user->avatar))

                <div class="settings_avatar">
                    <form method="POST" action="{{ route('delete-avatar') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button class="btn btn-link mt-1">Удалить фотографию</button>
                    </form>
                </div>
            @endif
            
        @endforeach
        <hr>
    </div>
@endsection
