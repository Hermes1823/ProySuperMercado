<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Producto;
class ProductController extends Controller
{
    //
    public function index(){
        return view('products.index');
    }

    public function store(Request $request)
    {
         $nombre = $request->input('nombre');
         $stock = $request->input('stock');
         $marca = $request->input('marca');
         $categoria = $request->input('categoria');
       
       
        // Crear un nuevo objeto Producto
        $producto = new Producto();
        $producto->nombre = $nombre;
        $producto->stock = $stock;
        $producto->idMarca = intval($marca);
        $producto->idCategoria = intval($categoria);


        if($imagen = $request->file('img')){
            $rutaGuardarImg= 'imagenes/products/';
            $imagenProducto= date('YmdHis'). "." . $imagen->getClientOriginalExtension();
            $imagen->move($rutaGuardarImg,$imagenProducto);
            $producto->photo =$imagenProducto; 
        }else{
            $producto->photo='producto_default.png';
        }


     // Guardar el producto en la base de datos
    $producto->save();


        // Retornar una respuesta en formato JSON u otro tipo de respuesta
        return json_encode(['mensaje' => "completado"]);
    }

    public function edit(Request $request){
        $id=$request->input('idProducto');
        $producto = Producto::find($id);


        return json_encode(['mensaje' => $producto]);
    }

    public function update(Request $request){

        $nombre = $request->input('nombre');
        $stock = $request->input('stock');
        $marca = $request->input('marca');
        $categoria = $request->input('categoria');
        $existeNuevaImagen= $request->hasFile('img');
        $imagenAntigua= $request->input('lblImg');

        $producto = Producto::findOrFail($request->input('idProducto'));
        $producto->nombre = $nombre;
        $producto->stock = $stock;
        $producto->idMarca = intval($marca);
        $producto->idCategoria = intval($categoria);

        if($existeNuevaImagen){
            $imagenNueva = $request->file('img');
            $rutaGuardarImg= 'images/';
            $imagenProducto= date('YmdHis'). "." . $imagenNueva->getClientOriginalExtension();
            $imagenNueva->move($rutaGuardarImg,$imagenProducto);
            $producto->photo =$imagenProducto; 
            if($imagenAntigua!="producto_default.png"){
                $rutaImagenEliminar=public_path('images/'.$imagenAntigua);
                
                $existe=  File::exists(realpath($rutaImagenEliminar));
                if($existe){
                    File::delete(realpath($rutaImagenEliminar));
                }
              
            }
        }

        $producto->save();
        
        return json_encode(['msg' => $producto , "nuevaImagen" => $existeNuevaImagen]);
    }



}

