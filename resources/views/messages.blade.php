<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages
        </h2>
    </x-slot>

    <div class="py-12 container max-w-7xl mx-auto">

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


        <div class="p-10 bg-gray-500 border-b border-gray-200 rounded-2xl">
            @if(\Illuminate\Support\Facades\Cache::has('sms-' . \Illuminate\Support\Facades\Auth::id()))
                <p>There is a limit: 1 message per 15 seconds.</p>

            @else
                {{--               ONLY FOR REGISTRED AND VERIFIED--}}
                <form action="sendMessage" method="post" class="h-3/4">
                    @csrf
                    <x-label>Recipient number</x-label>
                    <x-input type="text" name="recipient"
                             value="{{old('recipient')}}"
                             class="w-3/4 my-2" placeholder="Enter valid mobile number"/>
                    <x-label>Your text message</x-label>
                    <x-input type="textarea" name="message"
                             value="{{old('message')}}"
                             class="h-48 w-3/4" placeholder="Type message here"/>
                    <x-button class="w-3/4 my-2">Send</x-button>
                </form>
            @endif
        </div>


    </div>
</x-app-layout>
