
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
  <div class="col-7">
    <figure class="highcharts-figure">
      <div id="container1"></div>
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
    



const chart = new Highcharts.Chart({
    chart: {
        renderTo: 'container1',
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 15,
            beta: 15,
            depth: 50,
            viewDistance: 25
        }
    },
    xAxis: {
        categories: <?= $data2 ?>
    },
    yAxis: {
        title: {
            enabled: false
        }
    },
    tooltip: {
        headerFormat: '<b>{point.key}</b><br>',
        pointFormat: 'Cars sold: {point.y}'
    },
    title: {
        text: 'Cantidad de productos por marca',
        align: 'left'
    },
    subtitle: {
        text: 'Reporte detallado',
        align: 'left'
    },
    legend: {
        enabled: false
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    series: [{
        data: <?= $data1?>,
        colorByPoint: true
    }]
});

function showValues() {
    document.getElementById('alpha-value').innerHTML = chart.options.chart.options3d.alpha;
    document.getElementById('beta-value').innerHTML = chart.options.chart.options3d.beta;
    document.getElementById('depth-value').innerHTML = chart.options.chart.options3d.depth;
}

// Activate the sliders
document.querySelectorAll('#sliders input').forEach(input => input.addEventListener('input', e => {
    chart.options.chart.options3d[e.target.id] = parseFloat(e.target.value);
    showValues();
    chart.redraw(false);
}));

showValues();





  
</script>
@endsection