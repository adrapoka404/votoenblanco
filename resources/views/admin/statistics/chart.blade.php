<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="w-full container p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div class=" my-5">
            <a href="{{ route('admin.estadisticas.index') }}"
                class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">{{ __('Volver a estadisticas') }}</a>
        </div>
        <div id="chart_div"></div>

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
    @endsection
</x-app-layout>
