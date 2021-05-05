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
                {{--               ONLY FOR REGISTRED AND VERIFIED--}}
{{--                <form action="sendMessage" method="post" class="h-3/4">--}}
{{--                    @csrf--}}
{{--                    <livewire:search-users>--}}

{{--                        <x-label>Your text message</x-label>--}}
{{--                        <x-input type="textarea" name="message"--}}
{{--                                 value="{{old('message')}}"--}}
{{--                                 class="h-48 w-3/4" placeholder="Type message here"/>--}}
{{--                        <x-button class="w-3/4 my-2">Send</x-button>--}}

{{--                </form>--}}
            @endif
        </div>


    </div>
</x-app-layout>
