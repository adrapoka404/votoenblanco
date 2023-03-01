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
                <div class=" text-sm text-blue my-5 ">En esta sección pordras observar de forma general las estadisticas
                    para las notas mas vistas. Con
                    ayuda de los campos de abajo puedes filtrar las busquedas por una fecha especifica o por un rango de
                    fechas. tambien puedes obtener el top 10,15,20 y 30 de las busquedas que realices.</div>
                <input type="text" name="datepicker" id="datepicker">

                <select name="date_range" id="date_range">
                    <option value="0">Selecciona un rango</option>
                    @foreach ($dates as $i => $date)
                        <option value="{{ $i }}">{{ $date }}</option>
                    @endforeach
                </select>
                <select name="limit" id="limit">
                    @foreach ($limits as $i => $limit)
                        <option value="{{ $i }}">{{ $limit }}</option>
                    @endforeach
                </select>

            </div>

            <div id="top_x_div" class="my-5 w-full" style="width: 100%; height: 600px;"></div>
            @csrf
        </div>
    </div>
    @section('jqueryui')
        <script type="text/javascript">
            $(document).ready(function() {
                hoy = new Date()
                d = hoy.getDate()
                m = hoy.getMonth() + 1
                y = hoy.getFullYear()

                date = y + '-' + (m < 10 ? '0' + m : m) + '-' + (d < 10 ? '0' + d : d)
                $("#datepicker").val(date)

                crearGrafica(date, false)

                $("#date_range").on('change', function() {
                    crearGrafica($(this).val(), true)
                })

                $("#limit").on('change', function() {
                    $("#date_range").val(0)
                    crearGrafica($("#datepicker").val(), false)
                })
            })

            $("#datepicker").datepicker({
                dateFormat: 'yy-mm-dd',
                minDate: "-2m",
                maxDate: new Date('yyyy-mm-dd'),
                onSelect: function(date) {
                    $("#date_range").val(0)
                    crearGrafica(date, false)
                }
            });

            google.charts.load('current', {
                'packages': ['bar']
            });

            google.charts.setOnLoadCallback(drawStuff);

            function drawStuff() {
                var data = new google.visualization.arrayToDataTable([
                    ['Nota', 'Visitas', {role:'style'}, {role:'annotation'}],

                ]);
            };

            function cargando() {
                console.log('cargando...')
            }

            function crearGrafica(date, range) {

                $.ajax({
                    url: "{{ route('admin.estadisticas.masvistas') }}",
                    type: 'POST',
                    data: {
                        'date': date,
                        'range': range,
                        'limit': $("#limit").val(),
                        '_token': "{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        cargando()
                    },
                    success: function(datasset) {
                        if (datasset.length > 0) {
                            var data = new google.visualization.DataTable()

                            data.addColumn('string', 'Notas')
                            data.addColumn('number', 'Total de vistas')
                            data.addColumn({role: 'style'})
                            data.addColumn({role: 'annotation'})

                            $.each(datasset, function(i, v) {

                                var nota = v.post
                                var views = parseInt(v.cuantos)
                                data.addRows([
                                    [nota, views, '#981c3e', nota]
                                ])
                            })

                            var options = {
                                width: "100%",
                                bar: {
                                    groupWidth: "60%"
                                },
                                bars: 'horizontal',
                                axes: {
                                    x: {
                                        0: {
                                            side: 'top',
                                        } 
                                    }
                                },
                                legend: {position: 'none'},
                            };

                            var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                            // Convert the Classic options to Material options.
                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        } else
                            $("#top_x_div").html(
                                "<div class=' text-sm text-red-500'>No existen datos para el " + (range ?
                                    'rango de ' : 'día ') + (date ==
                                    false ? 'de hoy' : date) + "</div>")

                    }
                })
            }
        </script>
    @endsection

</x-app-layout>
