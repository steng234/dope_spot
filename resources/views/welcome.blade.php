@extends('header_footer')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 h-screen">
    <div class="group flex-shrink-0 relative overflow-hidden mx-auto md:h-1/2 w-full bg-white ">
        <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover w-full " src="{{ asset('images/home.jpeg') }}" >
        <div class="absolute inset-0 bg-gray-900 opacity-50 group-hover:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover w-full "></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center  ">
            <p class="text-white text-lg font-bold">SHOES</p>
            <a href="{{ route('productSelection', ['category_id' => 2]) }}" class="bg-transparent hover:bg-white text-white hover:text-black font-bold py-2 px-4 rounded mt-4 border border-white">shop now</a>
        </div>     
    </div>
    <div class="group flex-shrink-0 relative overflow-hidden mx-auto w-full md:h-1/2 bg-white ">
        <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover w-full " src="{{ asset('images/team1.jpeg') }}" >
        <div class="absolute inset-0 bg-gray-900 opacity-50 group-hover:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover w-full "></div>
        <div class="absolute inset-0 flex flex-col justify-center items-center  ">
            <p class="text-white text-lg font-bold">CLOTHES</p>
            <a href="{{ route('productSelection', ['category_id' => 1]) }}" class="bg-transparent hover:bg-white text-white hover:text-black font-bold py-2 px-4 rounded mt-4 border border-white">shop now</a>
        </div>     
    </div>
</div>
@endsection