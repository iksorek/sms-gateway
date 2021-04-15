<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($errors->any())
                    <div class="bg-red-700 text-2xl text-center p-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('info'))
                    <div class="bg-blue-400 text-2xl text-center p-3">
                        <p>{!! Session::get('info') !!}</p>
                    </div>
                @endif
                <div class="p-6 bg-gray-500 border-b border-gray-200">
{{--               ONLY FOR REGISTRED AND VERIFIED--}}


                </div>


            </div>
        </div>
    </div>
</x-app-layout>
