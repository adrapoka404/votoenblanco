<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md flex flex-col items-center mt-6 px-6 py-4 bg-white shadow-black shadow-3xl overflow-hidden sm:rounded-lg">
        <div >
            {{ $logo }}
        </div>
        <div class="w-full my-10">
            {{ $txt }}
        </div>
        <div class="w-full">
            {{ $slot }}
        </div>
    </div>
    
</div>
