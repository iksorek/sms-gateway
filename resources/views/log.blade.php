<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages LOG
        </h2>
    </x-slot>

    <div class="py-12 container max-w-7xl mx-auto">
        <div class="p-10 bg-gray-500 border-b border-gray-200 rounded-2xl overflow-hidden">
            @if($messages)

                <table class="table-auto w-full">
                    <thead>
                    <tr class="bg-gray-300">
                        <th class="w-1/4">Sender</th>
                        <th>Recipient</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($messages as $message)
                        @if(\Illuminate\Support\Facades\Auth::id() == $message->user->id)
                            <tr class="text-sm bg-gray-400">
                        @else
                            <tr class="text-sm">
                                @endif

                                <th>{{$message->user->name}}</th>
                                <th>*******{{ \Illuminate\Support\Str::substr($message->recipient, -3, 3)}}</th>
                                <th>{{ \Illuminate\Support\Str::limit($message->message, 40, '(...)')}}</th>
                                <th>{{$message->status}}</th>
                                <th>{{$message->created_at->diffForHumans()}}</th>
                            </tr>


                            @endforeach
                    </tbody>
                </table>
                <div class="w-3/4 mx-auto mt-5">{{$messages->links()}}</div>
            @else
                <p>There is no messages in database</p>

            @endif


        </div>
    </div>
</x-app-layout>
