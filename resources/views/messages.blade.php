<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Send message
        </h2>
    </x-slot>

    <div class="py-12 container max-w-7xl mx-auto">

    <div class="p-10 bg-gray-300 border-b border-gray-200 rounded-2xl">
            @if(\Illuminate\Support\Facades\Cache::has('sms-' . \Illuminate\Support\Facades\Auth::id()))
                <p>There is a limit: 1 message per 15 seconds.</p>
            @else

                <livewire:send-message />

            @endif
        </div>


    </div>
</x-app-layout>
