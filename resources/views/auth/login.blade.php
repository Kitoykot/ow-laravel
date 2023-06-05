@extends('layouts.main')

@section('content')
    <h3 class="mt-5">Войти в аккаунт</h3>

    <form class="mt-5" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control @error('login') is-invalid @enderror" name="login"
                value="{{ old('login') }}">

            @error('login')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div>
            <button name="submit" type="submit" class="btn btn-primary">Войти</button>
            <a href="{{ route('register') }}" class="pl-3">Регистрация</a>
        </div>
    </form>
@endsection
