<div>
    <form wire:submit.prevent="submit">
    @if($recipient)
        <p class="text-2xl">Recipient number: *******{{ \Illuminate\Support\Str::substr($recipient, -3, 3)}}</p>
        <button wire:click="reset">RESET</button>
    @else
        <x-label> Find user You would like to send SMS message.</x-label>
        <input class="mb-5" wire:model="search" type="text" placeholder="Search users..."/><br>
        @if($users->count() != 0)
            <div class="absolute bg-gray-200 rounded-l p-5">
                @foreach($users as $user)
                    <button type="button" value="{{$user->mobile}}"
                            wire:click="setMobile('{{$user->mobile}}')"
                    >{{$user->name}}</button><br>
                @endforeach
            </div>

        @endif

    @endif
        @error('recipient') <p class="text-red-600 text-xl-center">{{ $message }}</p> @enderror


    <x-input type="hidden"
             wire:model="recipient"
             name="recipient"
             value="{{ $recipient ?? '' }}"

    />
    {{--///////////////////////////////////--}}
    <x-label class="mb-3">Your text message</x-label>
    <x-input type="textarea"
             name="message"
             wire:model="message"
             class="h-48 w-3/4" placeholder="Type message here"/><br>
        @error('message') <p class="text-red-600 text-xl-center">{{ $message }}</p> @enderror
    <x-button class="w-3/4 my-2" type="submit">Send</x-button>

    </form>
</div>
