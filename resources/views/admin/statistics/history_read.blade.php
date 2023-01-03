<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="w-full container p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div>

            <div>
                <a href="{{ $back }}"
                    class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">{{ __('Volver') }}</a>
                <a href="{{ route('admin.estadisticas.index') }}"
                    class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">{{ __('Ir a estadísticas') }}</a>
            </div>

            <div id="line_top_x" class="my-5">

                <div class="text-center text-wine animate-pulse">

                    Cargando datos del servidor... el proceso puede tardar algunos minutos
                </div>
            </div>
            <div id="links">
                {{$posts->links()}}
            </div>
            
        </div>
    </div>
    @section('jqueryui')
        <script type="text/javascript">
            $(document).ready(function() {
                google.charts.load('current', {
                    'packages': ['line']
                });
                google.charts.setOnLoadCallback(drawChart);
            })

            function drawChart() {

                $.ajax({
                    url: "{{ route('admin.estadisticas.datamasleidas') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(datasset) {
                        console.log(datasset);

                        var data = new google.visualization.DataTable();
                        data.addColumn('string', 'Ultimos 5 dias');
                        $.each(datasset['culumns'], function(i,v){
                            data.addColumn('number', v);    
                        })
                       
                        $.each(datasset['seteados'], function(i, v){
                            data.addRow(v);
                        })

                        var options = {
                            chart: {
                                title: 'Historico de las más leidas',
                                subtitle: 'Comportamiento de las 10 notas más leidas en los ultimos 30 dias'
                            },
                            width: 900,
                            height: 500,
                            vAxis: {
                                format: 'short'
                            }
                        };

                        var chart = new google.charts.Line(document.getElementById('line_top_x'));

                        chart.draw(data, google.charts.Line.convertOptions(options));
                    }
                })


            }
        </script>
    @endsection

</x-app-layout>
