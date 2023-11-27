<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar correo Cotización</title>
    <style>
        h2, p, span{
            color: black;
        }
        a span{
            padding: 5px 30px;
            color: black;
            font-size: 20px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            background-color: #ffa500;
            text-align: center;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>Contraseña restaurada</h2>
    <div>
        <p>Codial saludo:<p>
        <p><span>Señor(a),
            @if(isset($info['primer_nombre']))
            </span><span>{{ $info['primer_nombre']; }}
                @if(isset($info['primer_apellido']))
            </span>{{ $info['primer_apellido'] }}</p>
                @endif
            @endif
        <p>Su contraseña ha sido restaurada, para ingresar a nuestro sistema debe usar esta contraseña: <b>{{ $info['passwordUser'] }}</b></p>
        <p>Para ingresar a nuestro sistema usted debe dirigirse a unikasas.com y acceder mediante la opción de login donde debe escribir su correo electronico y su numero de documento ('password').</p>
        <br>

        <p>Dentro del modulo usuarios usted podra editar su contraseña por una de su preferencia.</p>

        <p>Unikasas Ltda</p>
    </div>
</body>
</html>
