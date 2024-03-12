@extends('header_footer')
@section('content')
@vite(['resources/js/app.js'])
@vite(['resources/css/app.css'])
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">  
<div id="app" class="container mx-auto px-4 py-8 z-0">
    <h1 class="text-3xl font-semibold text-center mb-6 ">Good Morning {{ Session::get('user_name') }}</h1>
    <div class="flex justify-center items-center mb-4 gap-4 w-full">
        <div class="grid grid-cols-1 flex items-center w-80 text-center">
            <h2 class="mr-2">Email:</h2>
            <p class="roboto">{{ Session::get('user_email') }}</p>
        </div>

        <div class="grid grid-cols-1 flex items-center w-80 text-center">
            <h2 class="mr-2">Name:</h2>
            <p class="roboto">{{ Session::get('user_name') }}</p>
        </div>

    </div>
    <div class="flex justify-center items-center mb-4 gap-4 w-full">
        <div class="grid grid-cols-1 flex items-center w-80 text-center">
            <h2 class="mr-2">Address:</h2>
            <p class="roboto">{{ DB::table('users')->where('email', Session::get('user_email'))->value('address') }}</p>
        </div>

        <div class="grid grid-cols-1 flex items-center w-80 text-center">
            <h2 class="mr-2">Postal code:</h2>
            <p class="roboto">{{ DB::table('users')->where('email', Session::get('user_email'))->value('postal') }}</p>
        </div>

    </div>

    <div class="flex justify-center items-center mb-4 gap-4 w-full">
        <div class="grid grid-cols-1 flex items-center w-80 text-center">
            <h2 class="mr-2">State:</h2>
            <p class="roboto">{{ DB::table('users')->where('email', Session::get('user_email'))->value('state') }}</p>
        </div>

        <div class="grid grid-cols-1 flex items-center w-80 text-center">
            <h2 class="mr-2">City:</h2>
            <p class="roboto">{{ DB::table('users')->where('email', Session::get('user_email'))->value('city') }}</p>
        </div>
    </div>

    <div class="flex justify-center items-center mb-4 gap-4 w-full">
            <h2 class="mr-2">telephone:</h2>
            <p class="roboto">{{ DB::table('users')->where('email', Session::get('user_email'))->value('telephone') }}</p>
    </div>
    <div class="flex justify-center items-center text-center mb-4 gap-4 w-full">
    <button-for-data></button-for-data>
  
    @if (DB::table('users')->where('email', Session::get('user_email'))->value('google_id') === null)
            <button-for-password></button-for-password>
    @endif
    </div>
    
</div>
@endsection
