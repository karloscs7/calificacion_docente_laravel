<?php

namespace App\Http\Controllers;

use App\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller{

    public function index(){
        $datos=Departamento::all();
        return view('departamento.index',compact('datos'));
    }

    public function create(){
    	return view('departamento.create');
    }

    public function store(Request $request){
    	$campos=[
            'nombre' => 'required|string|min:2',
            'facultad' => 'required|string|max:100'
        ];
        $Mensaje=["required"=>'El :attribute es requerido'];
        $this->validate($request,$campos,$Mensaje);
        $datosDepartamento=request()->except('_token');
        Departamento::insert($datosDepartamento);
        return redirect('admin/departamentos')->with('Mensaje','Departamento agregado correctamente');
    }

    public function edit($cod_departamento){
    	$departamento=Departamento::findOrFail($cod_departamento);
    	return view('departamento.edit',compact('departamento'));
    }

    public function update(Request $request, $cod_departamento){
    	$datosDepartamento=request()->except('_token');
    	Departamento::where('cod_departamento','=',$cod_departamento)->update($datosDepartamento);
    	return redirect('admin/departamentos')->with('Mensaje','Departamento actualizado correctamente');
    }

    public function buscar(Request $request){
    	$cod_departamento=request()->input('cod_departamento');
    	$datos=Departamento::where('cod_departamento','=',$cod_departamento)->get();
    	return view('departamento.buscar',compact('datos'));
    }

}