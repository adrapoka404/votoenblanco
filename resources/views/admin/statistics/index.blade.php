<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div>
            En esta sección podras observar de forma general las estadisticas del sitios como son: Las diez notas mas leidas. Las notas con mas reacciones y los editores mas leidos.
            <small class=" text-blue">Para ver mas detalles de las estadisticas de manera independiente, puede dar click en los detalles de cada sección</small>
        </div>
          
        <div class="grid grid-cols-2">
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas leidas
                </div>
                <div id="donutchart" ></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.masleidas')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Mas leidas</a>
                </div>
            </div>
            <div class="p-2 border-2 border-wine m-2">
              <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                  Sitios de procedencia
              </div>
              <div id="donutchartSitiosDeProcedencia" ></div>
              <div class="w-full">
                  <a href="{{route('admin.estadisticas.referentes')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Detalles</a>
              </div>
          </div>
            @if (!empty($massuperlikeadas))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Super likeadas
                </div>
                <div id="donutchartMasSuperLikeadas" ></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.masslikeadas')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Mas super likeadas</a>
                </div>
            </div>
                
            @endif
            @if (!empty($maslikeadas))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Likeadas
                </div>
                <div id="donutchartMasLikeadas" ></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.maslikeadas')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Mas likeadas</a>
                </div>
            </div>
            @endif
            @if(!empty($masnolikeadas))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas me emperra
                </div>
                <div id="donutchartMasNoLikeadas" ></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.masnlikeadas')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Mas no likeadas</a>
                </div>
            </div>
            @endif
            @if(!empty($masshare))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas compartida
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masshare->shareds}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masshare->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$masshare->image_principal) }})"></div>
                <div class="w-full">
                    <a href="#" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Mas compartidas</a>
                </div>
            </div>
            @endif
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Los más leidos
                </div>
                <div id="donutchartMasLeidos" ></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.losmasleidos')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Los mas leidos</a>
                </div>
            </div>
            
        </div>
    </div>
@section('jqueryui')
<script type="text/javascript">
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawChartMasLeidos);
    google.charts.setOnLoadCallback(drawChartMasSuperLikeadas);
    google.charts.setOnLoadCallback(drawChartMasLikeadas);
    google.charts.setOnLoadCallback(drawChartMasNoLikeadas);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Notas', 'Vistas'],
        @foreach ($masleidas as $masleida)
            ['{{ $masleida->title }}', {{ $masleida->views }}],
        @endforeach
      ]);

      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
      chart.draw(data, options);
    }

    function drawChartMasLeidos() {
      var data = google.visualization.arrayToDataTable([
        ['Editor', 'Vistas'],
        @foreach ($masleidos as $masleido)
            ['{{ $masleido->user->name }}', {{ $masleido->vistas }}],
        @endforeach
      ]);
      
      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchartMasLeidos'));
      chart.draw(data, options);
    }

    function drawChartMasSuperLikeadas() {
      var data = google.visualization.arrayToDataTable([
        ['Nota', 'Likes'],
        @foreach ($massuperlikeadas as $massuperlikeada)
            ['{{ $massuperlikeada->post }}', {{ $massuperlikeada->reactions }}],
        @endforeach
      ]);
      
      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchartMasSuperLikeadas'));
      chart.draw(data, options);
    }

    function drawChartMasLikeadas() {
      var data = google.visualization.arrayToDataTable([
        ['Nota', 'Likes'],
        @foreach ($maslikeadas as $maslikeada)
            ['{{ $maslikeada->post }}', {{ $maslikeada->reactions }}],
        @endforeach
      ]);
      
      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchartMasLikeadas'));
      chart.draw(data, options);
    }

    function drawChartMasNoLikeadas() {
      var data = google.visualization.arrayToDataTable([
        ['Nota', 'Me molesta'],
        @foreach ($masnolikeadas as $masnolikeada)
            ['{{ $masnolikeada->post }}', {{ $masnolikeada->reactions }}],
        @endforeach
      ]);
      
      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchartMasNoLikeadas'));
      chart.draw(data, options);
    }

    function drawChartMasNoLikeadas() {
      var data = google.visualization.arrayToDataTable([
        ['Referente', 'Referentes'],
        @foreach ($referentes as $referente => $conteo)
            ['{{ $referente }}', {{ $conteo }}],
        @endforeach
      ]);
      
      var options = {
        pieHole: 0.4,
      };

      var chart = new google.visualization.PieChart(document.getElementById('donutchartSitiosDeProcedencia'));
      chart.draw(data, options);
    }
  </script>
@endsection
</x-app-layout>