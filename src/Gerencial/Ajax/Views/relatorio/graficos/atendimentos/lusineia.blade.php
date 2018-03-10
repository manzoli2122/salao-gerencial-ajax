<script>  

  var label_diario_atendimento_lu = [], dados_diario_atendimento_lu = [] 


  $(function () {

    var luChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 2,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 5,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }





    @for ($i = 0 ; $i < $dia ; $i++ )
    label_diario_atendimento_lu.push(["{{$data->addDays($i)->format('d/m')}} " ])    
    dados_diario_atendimento_lu.push([ {{ Manzoli2122\Salao\Atendimento\Models\AtendimentoFuncionario::whereDate('created_at',$data->format('Y-m-d') )->where('funcionario_id', 4 )->sum('valor') }}   ])
    <?php $data->subDays($i); ?>
  @endfor
  
  var area_diario_atendimento_lu = {    
     
        labels  : label_diario_atendimento_lu ,
        datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(255, 100, 110, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : dados_diario_atendimento_lu
        } 
      ]
    }


    //-------------
    //- diario atendimento CHART -
    //--------------
    var diario_atendimento_luCanvas          = $('#diario_atendimento_lu').get(0).getContext('2d')
    var diario_atendimento_luChart                = new Chart(diario_atendimento_luCanvas)
    var diario_atendimento_luChartOptions         = luChartOptions
    diario_atendimento_luChartOptions.datasetFill = false
    diario_atendimento_luChart.Line(area_diario_atendimento_lu, diario_atendimento_luChartOptions)
   










  })
 
</script>