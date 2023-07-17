<?php

namespace App\Http\Livewire\Cotizacion;

use App\Models\SolicitudCotizacion;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Dompdf\Dompdf;
class CotizacionComponent extends Component
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
        $solicitudesCotizacion = SolicitudCotizacion::select('solicitudes_cotizacion.id','solicitudes_cotizacion.estado', 'pro.nombre as proveedor', 'solicitudes_cotizacion.idOrdenRequisicion as requisicion', 'solicitudes_cotizacion.created_at as fechaSolicitud')
        ->join('proveedores as pro', 'pro.id', '=', 'solicitudes_cotizacion.idProveedor')
        ->where(function ($query) {
            // Group the search conditions using a closure
            $query->where('solicitudes_cotizacion.idOrdenRequisicion', 'ILIKE', '%' . $this->search . '%')
            ->orWhere('pro.nombre', 'ILIKE', '%' . $this->search . '%');
           
         
        })
        ->orderBy('solicitudes_cotizacion.id')
        ->paginate(8);



        return view('livewire.cotizacion.cotizacion-component',compact('solicitudesCotizacion'));
    }

    public function actualizarTabla()
    {
        $this->currentPage = $this->currentPage ?: 1; // Obtener la página actual o establecerla como 1 por defecto
        $this->gotoPage($this->currentPage);
    }

    public function verSolicitud($id)
    {
        return redirect()->route('solicitud-cotizacion.pdf', ['id' => $id]);
    }
    public function actualizarEstado($nuevoEstado,$idCotizacion){
        $solicitudCotizacion = SolicitudCotizacion::find($idCotizacion);
        $solicitudCotizacion->estado = $nuevoEstado;
        $solicitudCotizacion->save();

        
        
    }
 
}
