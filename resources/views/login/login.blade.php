<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
    <title>UNIKASAS</title>
</head>
<body>
    <div class="loginBox">
        <svg onclick="history.back()" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <circle cx="12" cy="12" r="9" />
            <path d="M10 10l4 4m0 -4l-4 4" />
          </svg>
        <img class="avatar" src="https://scontent.fbog15-1.fna.fbcdn.net/v/t1.6435-9/106006473_102039921569195_4427339924898339768_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=cNpBmAQanLQAX8zZnHO&_nc_ht=scontent.fbog15-1.fna&oh=00_AT-folCaV1unHw4f_UuraBI9j0Xh9_E9SHS1GTXwbRTsSQ&oe=62C2E478">
        <h1>LOGIN</h1>

        <form action="{{ url('login') }}" method="POST">
            @csrf {{-- token de seguridad para el formulario  --}}
            <!--Ingresar nombre de usuario-->
            <label for="Nombre de usuario">Correo electronico</label>
            <input type="email" id="email" placeholder="Ingrese usuario" name="email">

            <!--Ingresar Password-->
            <label for="Contraseña">Contraseña</label>
            <input type="password" placeholder="Ingrese contraseña" name="password" minlength="8" maxlength="30" id="password">

            <input type="checkbox" onclick="myFunction()" style="width: auto;">Show Password

            <button type="submit" id="loginButton">INGRESAR</button>

            <a href="{{ url('/forgotform') }}">Olvidé mi contraseña</a>
        </form>
    </div>
</body>
</html>
<script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
    }
</script>
