<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar correo de notificación</title>
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
    <h2>Notificación a participar en el evento sobre el proyecto</h2>
    <div>
        <p>Codial saludo:<p>
        <p>El motivo del siguiente correo es informarle que falta una hora para que empiece el evento que se tenia propuesto para la fecha: 
            @if(isset($info['fecha_evento']))
                <span>{{  $info['fecha_evento']; }},</span>
            @endif
            @if(isset($info['hora_inicio']))
                <span> en el horario que va desde las {{ $info['hora_inicio']; }}</span>
                @if(isset($info['hora_fin']))
                    <span>hasta las {{ $info['hora_fin']; }}.</span></p>   
                @endif 
            @endif 
        
        @if(isset($info['lugar_evento']))
            <p>Recordarle que el lugar elegido para la realización del evento es: <span>{{ $info['lugar_evento']; }}.</span><p>
        @endif

        @if(isset($info['asunto_evento']))
            <p>Asunto: <span>{{ $info['asunto_evento']; }}.</span><br>
                @if(isset($info['mensaje_evento']))
                    <span>Mensaje: {{ $info['mensaje_evento']; }}.</span><p>
                @endif
        @endif

        <p>Lo esperamos...<p><br>
        
        <p>Para mas información sobre nuestros productos visite nuestro sitio web en el siguiente enlace:</p>
        <a href="https://m.facebook.com/Unikasas-102039611569226/"><span>Ir al sitio</span></a>
    </div>
</body>
</html>