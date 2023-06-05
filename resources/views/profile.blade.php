@extends('layouts.main')

@section('content')
    <div class="profile mt-5">
        <h5>{{$user->name}} {{$user->surname}}</h5>

            @if(is_null($user->avatar))

                <img src="{{asset("assets/images/avatar.png")}}" width="230">
            @else
                <img src="{{$user->avatar}}" width="230">
            @endif
        <br><br>
        <hr>

        @auth
            @if($user->id == Auth::user()->id)

                <a href="{{route("my-articles")}}">Мои статьи ({{$articles_count}})</a>
                <hr>
            @else
            
                <a href="/user-articles/{{$user->id}}">Статьи ({{$articles_count}})</a>
                <hr>
            @endif
        @endauth

        @guest
            <a href="/user-articles/{{$user->id}}">Статьи ({{$articles_count}})</a>
            <hr>
        @endguest

        <p>{{is_null($user->description) ? "Автор и читатель на Our World!" : $user->description}}</p>
        <hr>
        <p>{{$user->email}}</p>
    </div>
@endsection
