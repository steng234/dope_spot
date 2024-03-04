@extends('header_footer')

@section('content')
<div class="container mx-auto px-4 py-8">
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
            <p class="roboto">{{ DB::table('users')->where('email', Session::get('user_email'))->value('cap') }}</p>
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

        <div class="grid grid-cols-1 flex items-center w-40 text-center">
            <button type="button" class="py-3 px-4 items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                Modify Data
            </button>
        </div>

        <div class="grid grid-cols-1 flex items-center w-40 text-center">
            <button @click="showModal = true" type="button" class="py-3 px-4 items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                modify password
            </button>
        </div>
    </div>
   
</div>

@endsection
