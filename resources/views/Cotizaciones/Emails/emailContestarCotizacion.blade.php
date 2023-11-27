<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar correo de respuesta</title>
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
    <h2>Respuesta de la cotización realizada</h2>
    <div>
        <p>Codial saludo:<p>
        <p><span>Señor(a),
            @if(isset($info['nombres_cotizante']))
            </span><span>{{ $info['nombres_cotizante'];}}
                @if(isset($info['apellidos_cotizante']))
            </span>{{ $info['apellidos_cotizante']; }}</p>
                @endif
            @endif
        <p>{{ $info['respuesta_cotizacion'] }}<p><br>

        <p>Para mas información sobre nuestros productos visite nuestro sitio web en el siguiente enlace:</p>
        <a href="https://m.facebook.com/Unikasas-102039611569226/"><span>Ir al sitio</span></a>
    </div>
</body>
</html>
