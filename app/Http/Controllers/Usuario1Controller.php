<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Usuario1Controller extends Controller
{
    public function index(){
        return view('index');
    }


    public function update($id, Request $request){
        $usuarioo=User::findOrFail($id);
        if($request->hasFile('file_fotoPerfil')){
            $archivo=$request->file('file_fotoPerfil')->store('archivosFotoPerfil','public');
            $urlFoto = Storage::url($archivo);
            $usuarioo->fotoPerfil=$urlFoto;
        }else{
            $usuarioo->fotoPerfil="../assets/img/profile.jpg";
        }
        $usuarioo->save();
        return redirect()->route('usuarioo.index');
    }


}










