<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Persona</title>
</head>
<body>
    <form action="{{url('crear')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <p>Nombre</p>
        <input type="text" name="nombre_persona">
        @error('nombre_persona')
        <br>
        {{$message}}
        @enderror
        <p>Apellido</p>
        <input type="text" name="apellido_persona">
        @error('apellido_persona')
        <br>
        {{$message}}
        @enderror
        <p>Dni</p>
        <input type="text" name="dni_persona">
        @error('dni_persona')
        <br>
        {{$message}}
        @enderror
        <p>Edad</p>
        <input type="text" name="edad_persona">
        @error('edad_persona')
        <br>
        {{$message}}
        @enderror
        <p>Telefono</p>
        <input type="text" name="num_telf">
        @error('num_telf')
        <br>
        {{$message}}
        @enderror
        <p>Foto</p>
        <input type="file" name="foto_persona">
        @error('foto_persona')
        <br>
        {{$message}}
        @enderror
        <input type="submit" value="Enviar">
    </form>
</body>
</html>