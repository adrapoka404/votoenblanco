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
                    class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">{{ __('Menú de estadísticas') }}</a>
            </div>
            <div class="mx-auto my-3">
                <select name="post_id" id="post_id">
                    @foreach ($posts as $post)
                        <option value="{{ $post->id }}">{{ $post->title }}</option>
                    @endforeach
                </select>

            </div>
            <div class="mx-auto my-3">
                <select name="date_range" id="date_range">
                    @foreach ($dates as $i => $date)
                        <option value="{{ $i }}">{{ $date }}</option>
                    @endforeach
                </select>

            </div>

            <div id="line_top_x" class="my-5">

            </div>
            @csrf
        </div>
    </div>
    @section('jqueryui')
        <script type="text/javascript">
            $(document).ready(function() {
                cargando()
                google.charts.load('current', {
                    'packages': ['corechart']
                });

                google.charts.setOnLoadCallback(drawChart);

                $("#post_id, #date_range").on('change', function() {
                    actual = $(this).text();
                    google.charts.setOnLoadCallback(drawChart);
                })

            })

            function cargando(){
                $("#line_top_x").html(
                    `<div class="text-center text-wine animate-pulse">
                        Cargando datos del servidor... el proceso puede tardar algunos minutos
                    </div> `
                )
            }
            function drawChart() {
                $.ajax({
                    url: "{{ route('admin.estadisticas.datamasleidas') }}",
                    type: 'POST',
                    data: {
                        'range': $("#date_range").val(),
                        'post_id': $("#post_id").val(),
                        '_token': "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    beforeSend: function(){
                        cargando()
                    },
                    success: function(datasset) {
                        var data = new google.visualization.DataTable()
                        
                        data.addColumn('date', 'Fecha')
                        data.addColumn('number', $("#post_id  option:selected").text())

                        $.each(datasset, function(i, v) {
                            var date = new Date(v[0])
                            var val = parseInt(v[1])
                            data.addRows([[date, val]])
                        })

                        var options = {
                            title: $("#post_id  option:selected").text() + ' (' +  $("#date_range  option:selected").text() + ')' ,
                            legend: { position: 'none' },
                            vAxis: {
                                minValue: 0
                            },
                            width: 900,
                            height: 500,
                        };

                        var chart = new google.visualization.AreaChart(document.getElementById('line_top_x'));
                        chart.draw(data, options);
                    }
                })


            }
        </script>
    @endsection

</x-app-layout>
