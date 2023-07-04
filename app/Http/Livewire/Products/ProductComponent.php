<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Categoria;


class ProductComponent extends Component
{
    use WithPagination;

    public $marcas;
    public $categorias;

    public $search;
   
    protected $paginationTheme = 'bootstrap';
    protected $currentPage;

    protected $listeners = ['render' => 'render'];


    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $products = Producto::select('productos.nombre', 'productos.descripcion', 'productos.stock', 'productos.photo', 'marcas.name as marca', 'categorias.name as categoria',
        'productos.id')
        ->join('marcas', 'productos.idMarca', '=', 'marcas.id')
        ->join('categorias', 'productos.idCategoria', '=', 'categorias.id')
        ->orWhere('categorias.name', 'ILIKE', '%' . $this->search . '%')
        ->orWhere('marcas.name', 'ILIKE', '%' . $this->search . '%')
        ->orWhere('productos.nombre', 'ILIKE', '%' . $this->search . '%')
        ->orderBy('productos.id')
        ->paginate(8);

        $this->marcas= Marca::all();
        $this->categorias=Categoria::all();

        return view('livewire.lproducts.product-component',compact('products'));
    }

    public function actualizarTabla()
    {
        $this->currentPage = $this->currentPage ?: 1; // Obtener la página actual o establecerla como 1 por defecto
        $this->gotoPage($this->currentPage);
    }


}
