<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{route("main")}}"><span id="blue">Our</span><span id="green">World</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Статьи
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php $categories = \App\Models\Category::all()?>
                        @foreach ($categories as $category)
                            <a class="dropdown-item" href="/filter/{{$category->id}}">{{$category->title}}</a>
                        @endforeach
                    </div>
                </li>
                <form method="GET" action="{{route("search")}}" id="nav_search" class="form-inline my-2 my-lg-0">
                    <input name="q" class="form-control mr-sm-2" type="search"aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск</button>
                </form>
            </ul>

            @guest
                <a class="nav-link dropdown" href="{{route("login")}}">
                    Войти
                </a>

                <a class="nav-link dropdown" href="{{route("register")}}">
                    Регистрация
                </a>               
            @endguest
            
            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/profile/{{Auth::user()->id}}">Профиль</a>
                        <a class="dropdown-item" href="{{route("profile-settings")}}">Настройки профиля</a>
                        <hr>
                        <a class="dropdown-item" href="{{route("my-articles")}}">Мои статьи</a>
                        <a class="dropdown-item" href="{{route("add-article")}}">Добавить статью</a>
                        <hr>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Выход
                        </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                    </div>
                </li>   
            @endauth
        </div>
    </div>
</nav>