<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="w-full container p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div class=" my-5">
            <a href="{{ route('admin.estadisticas.index') }}"
                class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">{{ __('Volver a estadisticas') }}</a>
                <a href="{{route('admin.estadisticas.historicoleidas', 0)}}"
              class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">{{ __('Ver historico') }}</a>
        </div>
        <div id="chart_div"></div>
        <div class="flex my-5">
            <div id="chartFroms" class=" w-1/3"></div>
            <div id="chartReferers" class=" w-1/3"></div>
            <div id="chartAgents" class=" w-1/3"></div>
        </div>
        <div class="text-white opacity-0">
            @foreach ($posts as $post)
                {{ $post->title }}
            @endforeach
        </div>
        <div class="my-5">
            {{ $posts->links() }}
        </div>
    </div>
    @section('jqueryui')
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() { //981c3e

                var data = google.visualization.arrayToDataTable([
                    ['Notas', 'Cant. vistas', {
                        role: 'style'
                    }],
                    @foreach ($posts as $post)
                        ['{{ $post->title }}', {{ $post->views }}, '#981c3e'],
                    @endforeach
                ]);

                var options = {
                    chart: {
                        title: 'Notas más leidas',
                        subtitle: 'Aqui podrá ver las notas mas leidas ordenadas de mayor a menor de diez en diez',
                    },
                    bars: 'vertical',
                    vAxis: {
                        format: 'short'
                    },
                    height: 400,
                    colors: ['#981c3e']
                };

                var chart = new google.charts.Bar(document.getElementById('chart_div'));

                chart.draw(data, google.charts.Bar.convertOptions(options));

                var btns = document.getElementById('btn-group');

                btns.onclick = function(e) {

                    if (e.target.tagName === 'BUTTON') {
                        options.vAxis.format = e.target.id === 'none' ? '' : e.target.id;
                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                }
            }
        </script>

        <script type="text/javascript">
            google.charts.load("current", {
                packages: ["corechart"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var dataFroms = google.visualization.arrayToDataTable([
                    ['Desde', 'Visitas'],
                    @foreach ($froms as $from => $cant)
                        ['{{ $from }}', {{ $cant }}],
                    @endforeach

                ]);

                var dataReferer = google.visualization.arrayToDataTable([
                    ['Desde', 'Visitas'],
                    @foreach ($referers as $referer => $cant)
                        ['{{ $referer }}', {{ $cant }}],
                    @endforeach

                ]);

                var dataAgents = google.visualization.arrayToDataTable([
                    ['Desde', 'Visitas'],
                    @foreach ($agents as $agent => $cant)
                        ['{{ $agent }}', {{ $cant }}],
                    @endforeach

                ]);

                var chart = new google.visualization.PieChart(document.getElementById('chartFroms'));
                chart.draw(dataFroms, {
                    title: 'Sitios de procedencia',
                    is3D: true
                });

                var chart = new google.visualization.PieChart(document.getElementById('chartReferers'));
                chart.draw(dataReferer, {
                    title: 'Ruta de procedencia',
                    is3D: true
                });

                var chart = new google.visualization.PieChart(document.getElementById('chartAgents'));
                chart.draw(dataAgents, {
                    title: 'Explorador de procedencia',
                    is3D: true
                });
            }
        </script>
    @endsection
</x-app-layout>
