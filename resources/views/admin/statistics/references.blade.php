<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="w-full container p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div class=" my-5">
            <a href="{{ route('admin.estadisticas.index') }}"
                class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">{{ __('Menú estadisticas') }}</a>
                <a href="#"
                class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">{{ __('Agentes') }}</a>
                <a href="#"
                class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">{{ __('Agentes') }}</a>
        </div>
        <div class="my-5">
            <p>En esta sección encontrara la informacion de las URL de procedencia las cuales corresponden a la descripción inferior en la grafica</p>
            <p class=" text-sm">
                <span class=" text-blue">Nota:</span>
                Hay {{ number_format($nulos['nulos'], 0)}} visitas sin referente.
            </p>
        </div>
        <div id="piechart" style="width: 900px; height: 500px;">
            <span class=" animate-pulse"> Cargando datos...</span>
        </div>
        <div class="my-5 text-sm">
            <p><span class=" font-semibold">facebook:</span> Las URL que proceden de la plataforma de facebook para PC</p>
            <p><span class=" font-semibold">facebook_mobile:</span> Las URL que proceden de la plataforma de facebook para dispositivos moviles</p>
            <p><span class=" font-semibold">google:</span> Las URL que proceden del buscador de google</p>
            <p><span class=" font-semibold">votoenblanco:</span> Las URL que proceden de la navegación interna del sitio, exceptuando editores, categorías y otras notas</p>
            <p><span class=" font-semibold">votoenblanco_sections:</span> Las URL que proceden de alguna de las secciones internas del sitio</p>
            <p><span class=" font-semibold">votoenblanco_editors:</span> Las URL que proceden de alguno de los editores del sitio</p>
            <p><span class=" font-semibold">votoenblanco_otras_notas:</span> Las URL que proceden de otras notas</p>
            <p><span class=" font-semibold">votoenblanco_otros:</span> Las URL que proceden de otros buscador o paginas externas</p>
        </div>
        
    </div>
    @section('jqueryui')
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = new google.visualization.DataTable();
  
        data.addColumn('string', 'Referente')
        data.addColumn('number', 'Conteo')

        @foreach($referentes as $referente => $conteo)
            data.addRows([["{{$referente}}", {{$conteo}}]])
        @endforeach
          var options = {
            title: 'Referentes de la página',
            pieSliceText: 'label',
            slices: {  
                    0 : {offset: 0.3},//FB pc
                      2: {offset: 0.1},//google
                      4: {offset: 0.3},//categorias
                      7: {offset: 0.1},// otros irrelevantes            
                    },
          };
  
          var chart = new google.visualization.PieChart(document.getElementById('piechart'));
          chart.draw(data, options);
        }
      </script>
    @endsection
</x-app-layout>

