<?php

namespace App\Http\Livewire\RequisitionOrders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Producto;

class RequisitionOrdersCreateComponent extends Component
{
    use WithPagination;

    public $search;
   
    protected $paginationTheme = 'bootstrap';
    protected $currentPage;


    public function updatingSearch()
    {
        $this->resetPage();
    }

    

    public function render()
    {
        $products = Producto::select('productos.nombre', 'productos.descripcion', 'productos.stock', 'productos.photo', 'marcas.name as marca', 'categorias.name as categoria', 'productos.id')
            ->join('marcas', 'productos.idMarca', '=', 'marcas.id')
            ->join('categorias', 'productos.idCategoria', '=', 'categorias.id')
            ->where(function ($query) {
                $query->where('categorias.name', 'ILIKE', '%' . $this->search . '%')
                    ->orWhere('marcas.name', 'ILIKE', '%' . $this->search . '%')
                    ->orWhere('productos.nombre', 'ILIKE', '%' . $this->search . '%');
            })
            ->orderBy('productos.id')
            ->paginate(8);
    
        return view('livewire.requisition-orders.requisition-orders-create-component', compact('products'));
    }
    

    
    
   
    

    


}
