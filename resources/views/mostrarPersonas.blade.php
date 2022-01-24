@if(!Session::get('email'))
        <?php
            //Si la session no esta definida te redirige al login.
            return redirect()->to('/')->send();
        ?>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personas</title>
</head>
<body>
    <div>
        <form action="{{url('crear')}}" method="GET">
            <button class= "" type="submit" name="Crear" value="Crear">Crear</button>
        </form>
        <form action="{{url('logout')}}" method="GET">
            <input class="btn btn-warning" type="submit" value="LogOut" name="logout">
        </form>
    </div>
    <div>
        <table>
            <tr>
                <th>ID</th>
                <th>FOTO</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>DNI</th>
                <th>EDAD</th>
                <th>TELEFONO</th>
                <th>CORREO</th>
                <th>ELIMINAR</th>
                <th>MODIFICAR</th>
                <th>CORREO</th>
            </tr>
            @foreach($listaPersonas as $persona)
                <tr>
                    <td>{{$persona->id}}</td>
                    <td><img src="{{asset('storage').'/'.$persona->foto_persona}}"></td>
                    <td>{{$persona->nombre_persona}}</td>
                    <td>{{$persona->apellido_persona}}</td>
                    <td>{{$persona->dni_persona}}</td>
                    <td>{{$persona->edad_persona}}</td>
                    <td>{{$persona->correo_persona}}</td>
                    <td>{{$persona->num_telf}}</td>
                    <td><form action="{{url('eliminarPersona/'.$persona->id)}}" method="POST">
                        @csrf
                        {{method_field('DELETE')}}
                        <button class= "" type="submit" name="Eliminar" value="Eliminar">Eliminar</button>
                    </form></td>
                    <td><form action="{{url('modificarPersona/'.$persona->id)}}" method="GET">
                        <button class= "" type="submit" name="Modificar" value="Modificar">Modificar</button>
                    </form></td>
                    <td><form action="{{url('correoPersona/'.$persona->correo_persona)}}" method="GET">
                        <button class= "" type="submit" name="Correo" value="Correo">Correo</button>
                    </form></td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>