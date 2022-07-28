<x-app-layout>
    <div class="py-12">
        <div class="w-full sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @foreach ($posts as $post)
                    <div class="flex flex-row hover:bg-gray-500    ">
                        <div class="flex-1">{{$post->title}}</div>
                        <div class="flex-1">{{$post->user->name}}</div>
                        <div class="flex-1">{{$post->status->name}}</div>
                        <div class="flex-1"></div>
                        
                    </div>
                @endforeach
                {{$posts->links()}}
            </div>
        </div>
    </div>
</x-app-layout>
