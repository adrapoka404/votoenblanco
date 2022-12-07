<x-app-layout>
    <x-slot name="header">
    </x-slot>
    <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
        <x-info />
        <div>
            <canvas id="myChart"></canvas>
          </div>
          
        <div class="grid grid-cols-2">
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas leida
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masleida->views}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masleida->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$masleida->image_principal) }})"></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.masleidas')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Mas leidas</a>
                    <a href="{{ route('notas.show', $masleida->slug) }}" target="_blank" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Ver nota</a>
                </div>
            </div>
            @if (!empty($masslike))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas super likeada
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masslike->slikes}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masslike->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$masslike->image_principal) }})"></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.masslikeadas')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Mas super likeadas</a>
                    <a href="{{ route('notas.show', $masslike->slug) }}" target="_blank" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Ver nota</a>
                </div>
            </div>
                
            @endif
            @if (!empty($maslike))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas likeada
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$maslike->likes}}</div>
                </div>
                <div class=" font-light text-sm">{{ $maslike->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$maslike->image_principal) }})"></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.maslikeadas')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Mas likeadas</a>
                    <a href="{{ route('notas.show', $maslike->slug) }}" target="_blank" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Ver nota</a>
                </div>
            </div>
            @endif
            @if(!empty($masnlike))
            <div class="p-2 border-2 border-wine m-2">
                <div class="bg-wine my-2 font-semibold text-center text-white text-xl p-3">
                    Mas no likeada
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masnlike->nlikes}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masnlike->title }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ asset('storage/'.$masnlike->image_principal) }})"></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.masnlikeadas')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Mas no likeadas</a>
                    <a href="{{ route('notas.show', $masnlike->slug) }}" target="_blank" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Ver nota</a>
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
                    El mas leido
                    <div class=" w-3 rounded-full bg-white animate-pulse p-2 text-wine inline">{{$masleido->vistas}}</div>
                </div>
                <div class=" font-light text-sm">{{ $masleido->user->name }}</div>
                <div class=" w-32 h-32 bg-contain bg-no-repeat mx-auto " style="background-image: url({{ $masleido->user->profile_photo_url }})"></div>
                <div class="w-full">
                    <a href="{{route('admin.estadisticas.losmasleidos')}}" class="cursor-pointer bg-black px-3 py-1 rounded-full text-white mx-auto">Los mas leidos</a>
                </div>
            </div>
            
        </div>
    </div>

</x-app-layout>
@section('jqueryui')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<script type="text/javascript">
  
      var labels = {'uno','dos','tres'}
      var users =  {'10','20','30'}
  
      const data = {
        labels: labels,
        datasets: [{
          label: 'My First dataset',
          backgroundColor: 'rgb(255, 99, 132)',
          borderColor: 'rgb(255, 99, 132)',
          data: users,
        }]
      };
  
      const config = {
        type: 'line',
        data: data,
        options: {}
      };
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
  
</script>
@endsection