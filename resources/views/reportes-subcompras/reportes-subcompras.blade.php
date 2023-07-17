
@extends('dashboard')

@section('titulo', 'Zona de Reportes')



@section('contenido') 

<div class="row">

  <div class="col-5">
    <figure class="highcharts-figure">
      <div id="container"></div>
      <p class="highcharts-description">
         
      </p>
    </figure>
    
  </div>
</div>


@endsection

@section('js')
<script>
   
  
    Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: " Solicitudes de cotización",
        align: 'left'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
            }
        }
    },
    series: [{
        name: 'cantidad',
        data: <?= $data ?>
    }] 
});
    


  
</script>
@endsection