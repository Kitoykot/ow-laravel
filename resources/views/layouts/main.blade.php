<!DOCTYPE html>
<html lang="en">
@include('layouts.components.head')

<body>
    @include('layouts.components.header')
    <main>

        <div class="container">
            @yield('content')
        </div>
        
    </main>
</body>

</html>
