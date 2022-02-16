<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>@yield('title')</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}" >
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>

<body>
    <header>
        <div class="menubar">
            <div class="container">
                <div class="logo">
                    <h1><a href="/home" class="linkhome" >Flavour Cafe</h1>
                </div>
                <div class="action">
                    <ul class="menu">
                        <li>
                            <a href="/home">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('product-list')}}">Product</a>
                        </li>
                        <li>
                            <a href="{{ route('category-list')}}">Category</a>
                        </li>
                        <li>
                        <a href="{{ route('location-list')}}">Location</a>
                            </a>
                        </li>
                    </ul>
                    <ul class="login">
                         <button class="button1"><li><a href="auth/login">Login</a></li></button>
                    @auth
                        <button class="button2"><li><a href="{{ route('logout')}}">Logout</a></li></button>
                        <span>{{ \Auth::user()->name}}</span>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main>
            @yield('content')
    </main>
</body>
</html>


