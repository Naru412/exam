<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>    
    <link href="{{ asset('css/sanitize.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/common.css') }}" rel="stylesheet" />
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1 class="header__logo">FashionablyLate</h1>
            @yield('login-button')
            @yield('register-button')
            @yield('logout-button')
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>