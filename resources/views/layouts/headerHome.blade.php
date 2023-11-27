<link rel="stylesheet" href="{{ asset('css/home/header.css') }}">
<header class="header">
    <img src="https://scontent.fbog15-1.fna.fbcdn.net/v/t1.6435-9/106006473_102039921569195_4427339924898339768_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=cNpBmAQanLQAX8zZnHO&_nc_ht=scontent.fbog15-1.fna&oh=00_AT_bdm1zoETugOQhFNc8XKd9glwVYzE_d4AmzLyD5jKtFw&oe=62C6D8F8" alt="unikasas" class="logo">
    <h1>UNIKASAS</h1>
    <div class="info">
        <a href="{{ url('nosotros') }}">Nosotros</a>
        <a href="{{ url('index') }}">Login</a>
    </div>
</header>
@yield('content')

