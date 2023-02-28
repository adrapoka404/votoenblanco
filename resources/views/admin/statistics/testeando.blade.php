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
                <input type="text" name="datepicker" id="datepicker">
            </div>
            <div class="mx-auto my-3">
                <select name="date_range" id="date_range">
                    <option value="0">Selecciona un rango</option>
                    @foreach ($dates as $i => $date)
                        <option value="{{ $i }}">{{ $date }}</option>
                    @endforeach
                </select>

            </div>

            <div id="top_x_div" class="my-5 w-full" style="width: 800px; height: 600px;"></div>
            @csrf
        </div>
    </div>
    @section('jqueryui')
        <script type="text/javascript">
            $(document).ready(function() {

                crearGrafica(false, false)

                hoy = new Date()
                d = hoy.getDate()
                m = hoy.getMonth() + 1
                y = hoy.getFullYear()
                $("#datepicker").val(y + '-' + (m < 10 ? '0' + m : m) + '-' + (d < 10 ? '0' + d : d))

                $("#date_range").on('change', function(){
                    crearGrafica($(this).val(), true)
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
                    ['Nota', 'Visitas'],

                ]);

                var options = {
                    width: 800,
                    axes: {
                        x: {
                            0: {
                                side: 'top',
                                label: 'Vistas por nota'
                            } // Top x-axis.
                        }
                    },
                    bar: {
                        groupWidth: "90%"
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                // Convert the Classic options to Material options.
                chart.draw(data, google.charts.Bar.convertOptions(options));
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
                            data.addColumn('number', 'Vistas')

                            $.each(datasset, function(i, v) {

                                var nota = v.post
                                var views = parseInt(v.cuantos)
                                data.addRows([
                                    [nota, views]
                                ])
                            })

                            var options = {
                                width: 800,
                                axes: {
                                    x: {
                                        0: {
                                            side: 'top',
                                            label: 'Vistas por nota'
                                        } // Top x-axis.
                                    }
                                },
                                bar: {
                                    groupWidth: "90%"
                                }
                            };

                            var chart = new google.charts.Bar(document.getElementById('top_x_div'));
                            // Convert the Classic options to Material options.
                            chart.draw(data, google.charts.Bar.convertOptions(options));
                        } else
                            $("#top_x_div").html(
                                "<div class=' text-sm text-red-500'>No existen datos para el "+ (range ? 'rango de ' : 'día ') + (date ==
                                    false ? 'de hoy' : date) + "</div>")

                    }
                })
            }
        </script>
    @endsection

</x-app-layout>
