<div>
    <input wire:model="search" type="text" placeholder="Search users..."/>
    <br>


    @foreach($users as $user)
        <button type="button" value="{{$user->mobile}}"
                wire:click="setMobile('{{$user->mobile}}')"
        >{{$user->name}}</button><br>

    @endforeach
    @if($mobile)
        <x-label>Recipient number: *******{{ \Illuminate\Support\Str::substr($mobile, -3, 3)}}</x-label>
    @else
        Find user You would like to send SMS message.
    @endif


    <x-input type="hidden" name="recipient"
             value="{{ $mobile ?? '' }}"

    />


</div>
