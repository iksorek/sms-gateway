<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages LOG
        </h2>
    </x-slot>

    <div class="py-12 container max-w-7xl mx-auto">
        <div class="p-10 bg-gray-500 border-b border-gray-200 rounded-2xl">
            @if($messages)

                <table class="table-fixed">
                    <thead>
                    <tr class="bg-gray-300">
                        <th class="w-1/6">Sender</th>
                        <th class="w-1/8">Recipient</th>
                        <th class="w-1/2">Message</th>
                        <th class="w-1/8">Status</th>
                        <th class="w-1/4">Time</th>
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
                            <th>{{$message->recipient}}</th>
                            <th>{{$message->message}}</th>
                            <th>{{$message->status}}</th>
                            <th>{{$message->created_at->diffForHumans()}}</th>
                        </tr>


                    @endforeach
                    </tbody>
                </table>
            @else
                <p>There is no messages in database</p>

            @endif


        </div>
    </div>
</x-app-layout>
