<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Actualizar Personas</title>
</head>
<body>
    <form action="{{url('modificarPersona')}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{method_field('PUT')}}
        <p>Nombre</p>
        <input type="text" name="nombre_persona" id="" value="{{$persona->nombre_persona}}">
        <p>Apellido</p>
        <input type="text" name="apellido_persona" id="" value="{{$persona->apellido_persona}}">
        <p>Dni</p>
        <input type="text" name="dni_persona" id="" value="{{$persona->dni_persona}}">
        <p>Edad</p>
        <input type="text" name="edad_persona" id="" value="{{$persona->edad_persona}}">
        <p>Telefono</p>
        <input type="number" name="num_telf" id="" value="{{$persona->num_telf}}">
        <p>Foto</p>
        <input type="file" name="foto_persona" value="{{$persona->foto_persona}}">
        <input type="hidden" name="id" value="{{$persona->id}}">
        <input type="hidden" name="id_telf" value="{{$persona->id_telf}}">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>