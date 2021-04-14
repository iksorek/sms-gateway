<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-gray-500 border-b border-gray-200">
                    @if(!Auth::user()->mobile)
                        <p class="m-4">There is no mobile number added yet! You have to add it before continue</p>
                        <div>
                            <form action="">
                            <x-label>Mobile number</x-label>
                        <x-input placeholder="+44" type="text" class="m-5"></x-input>
                            <x-button>Submit</x-button>
                            </form>
                        </div>




                    @elseif(!Auth::user()->mobile_verified_at)
                        <p>Your mobile number is not verified yet</p>
                    @endif
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
