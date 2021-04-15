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
                        <form action="{{ route('updateMobileNo') }}" method="post">
                            @csrf
                            <x-label>Mobile number</x-label>
                            <x-input placeholder="+44" type="text"
                                     value="{{Auth::user()->mobile ?? ''}}"

                                     class="m-5" name="newmobile"></x-input>
                            <x-button>Submit</x-button>
                        </form>
                    </div>


                    @if(!Auth::user()->mobile_verified_at)
                        <p>Your mobile number is not verified yet</p>
                    @endif
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
