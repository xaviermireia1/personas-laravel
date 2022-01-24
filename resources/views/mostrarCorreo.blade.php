<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mandar Correo</title>
</head>
<body>
    <form action="{{url('recibirCorreo')}}" method="POST">
        @csrf
        <p>Para</p>
        <input type="text" name="correo_persona" value="{{$correo_persona}}">
        <p>Asunto:</p>
        <input type="text" name="sub">
        <p>Mensaje:</p>
        <textArea name="mensaje" rows="4" cols="50"></textArea>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>