@extends('layouts.main')

@section('content')
    <h3 class="mt-5">Создать учётную запись</h3>

    <form class="mt-5" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}">

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="surname">Фамилия</label>
            <input type="text" class="form-control @error('surname') is-invalid @enderror" name="surname"
                value="{{ old('surname') }}">

            @error('surname')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Электронная почта</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

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

        <div class="form-group">
            <label for="password-confirm">Подтверждение пароля</label>
            <input type="password" class="form-control" name="password_confirmation">
        </div>

        <div>
            <button name="submit" type="submit" class="btn btn-primary">Создать аккаунт</button>
            <a href="{{route("login")}}" class="pl-3">Войти</a>
        </div>
    </form>
@endsection
