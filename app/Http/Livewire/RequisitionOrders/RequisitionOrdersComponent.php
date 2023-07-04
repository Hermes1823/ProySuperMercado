<?php

namespace App\Http\Livewire\RequisitionOrders;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RequisitionOrder;

class RequisitionOrdersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $currentPage;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $requisitionOrders= RequisitionOrder::select('ordenes_requisicion.id', 'ordenes_requisicion.estado', 'ordenes_requisicion.created_at')
        ->selectSub("CONCAT(colaboradores.prenombres, ' ', colaboradores.apellidos)", 'nombreCompleto')
        ->join('colaboradores', 'colaboradores.idColaborador', '=', 'ordenes_requisicion.idColaborador')
        ->orWhere('ordenes_requisicion.id', 'ILIKE', '%' . $this->search . '%')
        ->orWhere('colaboradores.prenombres', 'ILIKE', '%' . $this->search . '%')
        ->orWhere('colaboradores.apellidos', 'ILIKE', '%' . $this->search . '%')
        ->orWhere('ordenes_requisicion.estado', 'ILIKE', '%' . $this->search . '%')
        ->orWhere('ordenes_requisicion.created_at', 'ILIKE', '%' . $this->search . '%')
        ->orderBy('ordenes_requisicion.id')
        ->paginate(8);

        return view('livewire.requisition-orders.requisition-orders-component',compact('requisitionOrders'));
    }
}
