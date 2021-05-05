<x-jet-action-section>
    <x-slot name="title">
        Mobile
    </x-slot>

    <x-slot name="description">
    Your mobile number must be valid to be able to send and receive text messages.
    </x-slot>

    <x-slot name="content">

        <div>
            @if(!Auth::user()->mobile)
                <p class="m-4">There is no mobile number added yet! You have to add it before continue</p>
            @endif
            <div>
                @if(Auth::user()->mobile && Auth::user()->mobile_verified_at)
                    <p class="text-center text-xl m-3">Your mobile hab been verified, and Your account is active. Feel free to <a
                            href="{{route('messages')}}">send text</a></p>
                @endif
                <form action="{{ route('updateMobileNo') }}" method="post">
                    @csrf
                    <x-label>Mobile number</x-label>
                    <x-input placeholder="eg 07533078790" type="text"
                             value="{{Auth::user()->mobile ?? ''}}"

                             class="m-5" name="newmobile"></x-input>

                    <x-jet-button>
                        @if(Auth::user()->mobile)
                            Change
                        @else
                            Submit
                        @endif
                    </x-jet-button>
                  </form>
            </div>


            @if(!Auth::user()->mobile_verified_at && Auth::user()->mobile)
                <p>Your mobile number is not verified yet</p>
                <form action="{{ route('verifycode') }}" method="post" class="my-5">
                    @csrf
                    @if(Auth::user()->verification_code)
                        <x-label>Enter verification code:
                        </x-label>
                        <x-input placeholder="Code" type="text"
                                 class="m-5" name="verification_code"></x-input>
                        <x-button>Submit</x-button>
                    @endif
                    @if(!Auth::user()->mobile_verified_at)
                        <p class="text-center m-5">
                            <a href="{{route("resendCode")}}">RESEND VEREFICATION CODE</a>
                        </p>
                    @endif


                </form>
            @endif
        </div>
    </x-slot>
</x-jet-action-section>
