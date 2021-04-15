<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Welcome in text for free!
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">


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
                <div class="p-6 bg-gray-500 border-b border-gray-200">
                    @if(!Auth::user()->mobile)
                        <p class="m-4">There is no mobile number added yet! You have to add it before continue</p>
                    @endif
                    <div>
                        @if(Auth::user()->mobile && Auth::user()->mobile_verified_at)
                            <p class="text-center text-2xl">You account is active. Feel free to <a
                                    href="{{route('messages')}}">send text</a></p>
                        @endif
                        <form action="{{ route('updateMobileNo') }}" method="post">
                            @csrf
                            <x-label>Mobile number</x-label>
                            <x-input placeholder="+44" type="text"
                                     value="{{Auth::user()->mobile ?? ''}}"

                                     class="m-5" name="newmobile"></x-input>
                            <x-button>
                                @if(Auth::user()->mobile)
                                    Change
                                @else
                                    Submit
                                @endif
                            </x-button>
                        </form>
                    </div>


                    @if(!Auth::user()->mobile_verified_at && Auth::user()->mobile)
                        <p>Your mobile number is not verified yet</p>
                        <form action="{{ route('verifycode') }}" method="post" class="my-5">
                            @csrf
                            @if(Auth::user()->verification_code)
                                <x-label>Enter verification code: ({{ Auth::user()->verification_code }})</x-label>
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


            </div>
        </div>
    </div>
</x-app-layout>
