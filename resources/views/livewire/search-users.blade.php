<div>


    @if($mobile)
        <p class="text-2xl">Recipient number: *******{{ \Illuminate\Support\Str::substr($mobile, -3, 3)}}</p>
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


    <x-input type="hidden" name="recipient"
             value="{{ $mobile ?? '' }}"

    />


</div>
