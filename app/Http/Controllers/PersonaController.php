<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Telefono;
//use App\Http\Controllers\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\MAIL;
use App\Mail\EnviarMensaje;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostrarPersonas(){
        $listaPersonas = DB::table('tbl_persona')->join('tbl_telef','tbl_persona.id','=','tbl_telef.id_persona')->select('*')->get();
        //return $listaPersonas;
        return view('mostrarPersonas', compact('listaPersonas'));
    }
    public function crearPersonas(){
        return view('crear');
    }
    public function crearPersonasPost(Request $request){
        $datos = $request->except('_token');
        $request->validate([
            'nombre_persona'=>'required|string|max:30',
            'apellido_persona'=>'required|string|max:30',
            'dni_persona'=>'required|string|max:10|min:10',
            'edad_persona'=>'required|int|min:18|max:130',
            'num_telf'=>'required|string|min:9|max:9',
            'foto_persona'=>'required|mimes:jpg,png,jpeg,webp,svg'
        ]);
        if ($request->hasFile('foto_persona')) {
            $datos['foto_persona'] = $request->file('foto_persona')->store('uploads','public');
        }else{
            $datos['foto_persona'] = null;
        }         
        try {
            DB::beginTransaction();
            $id = DB::table('tbl_persona')->insertGetId(["foto_persona"=>$datos['foto_persona'],"nombre_persona"=>$datos['nombre_persona'],"apellido_persona"=>$datos['apellido_persona'],"dni_persona"=>$datos['dni_persona'],"edad_persona"=>$datos['edad_persona']]);
            //return $id;
            DB::table("tbl_telef")->insert(["num_telf"=>$datos['num_telf'],"id_persona"=>$id]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        return redirect('mostrar');
    }
    public function eliminarPersona($id){
        try {
            DB::beginTransaction();
            DB::table('tbl_telef')->where('id_persona','=',$id)->delete();
            DB::table('tbl_persona')->where('id','=',$id)->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
        //return $coche;
        return redirect('mostrar');
    }
    public function modificarPersonas($id){
        $persona = DB::table('tbl_persona')->join('tbl_telef','tbl_persona.id','=','tbl_telef.id_persona')->select('*')->where('id','=',$id)->first();
        return view('modificar',compact('persona'));
    }
    public function modificarPersonasPut(Request $request){
        $datos=$request->except('_token','_method','num_telf','id_telf');
        if ($request->hasFile('foto_persona')) {
            $foto = DB::table('tbl_persona')->select('foto_persona')->where('id','=',$request['id'])->first();          
            if ($foto->foto_persona != null) {
                Storage::delete('public/'.$foto->foto_persona); 
            }
            $datos['foto_persona'] = $request->file('foto_persona')->store('uploads','public');
        }else{
            $foto = DB::table('tbl_persona')->select('foto_persona')->where('id','=',$request['id'])->first();
            $datos['foto_persona'] = $foto->foto_persona;
        }
        $datostelf=$request->except('_token','_method','nombre_persona','apellido_persona','dni_persona','edad_persona','id','foto_persona');
        try {
            DB::beginTransaction();
            DB::table('tbl_telef')->where('id_telf','=',$datostelf['id_telf'])->update($datostelf);
            DB::table('tbl_persona')->where('id','=',$datos['id'])->update($datos);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('mostrar');
    }
    public function login(){
        return view('login');
    }
    public function loginPost(Request $request){
        $datos_frm = $request->except('_token','_method');
        $email=$datos_frm['correo_emp'];
        $password=$datos_frm['pass_emp'];
        //$password=sha1($password);
        $users = DB::table("tbl_emp")->where('correo_emp','=',$email)->where('pass_emp','=',$password)->count();
        if($users == 1){
            //Establecer la sesion
            $request->session()->put('email',$request->correo_emp);
            return redirect('mostrar');
        }else{
            //Redirigir al login
            return redirect('');
        }
    }
    public function logout(Request $request){
        //Olvidas la sesion
        $request->session()->forget('email');
        //Eliminar todo
        $request->session()->flush();
        return redirect('/');
    }
    /*ENVIAR CORREO*/
    public function correoPersona(Request $request){
        $form = $request->except('_token');
        $sub = $form['sub'];
        $msj = $form['mensaje'];
        $datos = array('message'=>$msj);
        $enviar = new EnviarMensaje($datos);
        $enviar->sub = $sub;
        Mail::to($form['correo_persona'])->send($enviar);
        return redirect('/mostrar');
    }
    public function correoPersona2($correo_persona){
        return view('mostrarCorreo',compact('correo_persona'));
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit(Persona $persona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Persona $persona)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        //
    }
}
