<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Messages LOG
        </h2>
    </x-slot>

    <div class="md:py-12 container max-w-7xl mx-auto ">
        <div class="md:p-10 bg-gray-300 border-b border-gray-200 rounded-2xl overflow-x-auto">
            @if($messages)

                <table class="table-auto w-full">
                    <thead>
                    <tr class="bg-gray-300">
                        <th>Sender</th>
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

                                <td>{{\Illuminate\Support\Str::substr($message->user->name, 0, 3)}}*****</td>
                                <td>*******{{ \Illuminate\Support\Str::substr($message->recipient, -3, 3)}}</td>

                                @if(\Illuminate\Support\Facades\Auth::id() == $message->user->id)
                                    <td>{{ \Illuminate\Support\Str::limit($message->message, 40, '(...)')}}</td>
                                @else
                                    <td class="text-transparent">{{ \Illuminate\Support\Str::limit($message->message, 40, '(...)')}}</td>
                                @endif


                                <td>{{$message->status}}</td>
                                <td>{{$message->created_at->diffForHumans()}}</td>
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
