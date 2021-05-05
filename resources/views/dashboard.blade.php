<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome in text for free!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-300 border-b border-gray-200">
                    <p class="text-xl">Hi, {{ \Illuminate\Support\Facades\Auth::user()->name }}</p>

                    @if(\Illuminate\Support\Facades\Auth::user()->Sms()->count() !=0)
                        You have sent {{ \Illuminate\Support\Facades\Auth::user()->Sms()->count() }} messages so far.
                    @else
                        You haven't sent any message yet. Why?
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
