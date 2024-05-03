@extends('header_footer')

@section('content')
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

@vite(['resources/js/app.js'])
@vite(['resources/css/app.css'])

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="max-w-[85rem] px-4 py-6 sm:px-6 h-fit lg:px-8 lg:py-8 mx-auto" id="app">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- User Details Section -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-md h-80">
            <h2 class="text-2xl font-semibold mb-4">User Details</h2>
            <div class="mb-4">
                <p class="text-gray-600">Email: <span class="font-semibold">{{ Session::get('user_email') }}</span></p>
                <p class="text-gray-600">Name: <span class="font-semibold">{{ Session::get('user_name') }}</span></p>
                <p class="text-gray-600">Address: <span class="font-semibold">{{ DB::table('users')->where('email', Session::get('user_email'))->value('address') }}</span></p>
                <p class="text-gray-600">Postal Code: <span class="font-semibold">{{ DB::table('users')->where('email', Session::get('user_email'))->value('postal') }}</span></p>
                <p class="text-gray-600">State: <span class="font-semibold">{{ DB::table('users')->where('email', Session::get('user_email'))->value('state') }}</span></p>
                <p class="text-gray-600">City: <span class="font-semibold">{{ DB::table('users')->where('email', Session::get('user_email'))->value('city') }}</span></p>
                <p class="text-gray-600">Telephone: <span class="font-semibold">{{ DB::table('users')->where('email', Session::get('user_email'))->value('telephone') }}</span></p>
               
                <div class="w-full flex">
                <button-for-data class="pt-4 w-40 pr-4"></button-for-data>
                @if (DB::table('users')->where('email', Session::get('user_email'))->value('google_id') === null)
                        <button-for-password class="pt-4 w-40"></button-for-password>
                @endif
                </div>
                
            </div>
        </div> 
        <!-- Orders Section -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-md overflow-y-auto h-80">
            <h2 class="text-2xl font-semibold mb-4">Orders</h2>
            @if($userOrders->isNotEmpty())
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 bg-gray-200">Order&nbsp;ID</th>
                            <th class="px-4 py-2 bg-gray-200">Status</th>
                            <th class="px-4 py-2 bg-gray-200">Order&nbsp;Date</th>
                            <th class="px-4 py-2 bg-gray-200">Total</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userOrders as $order)
                        <tr>
                        <td class=" py-2 text-center flex justify-center items-center">
                            <a class="py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="{{ route('order.summary', ['OrderId' => $order->id]) }}">{{ $order->id }}</a>
                        </td>
                            <td class="px-4 py-2 text-center">{{ $order->status }}</td>
                            <td class="px-4 py-2 text-center">{{ $order->created_at->format('Md,Y ') }}</td>
                            <td class="px-4 py-2 text-center">{{ $order->total }}</td>
                            <!-- Add more cells with order details as needed -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No orders found for this user.</p>
            @endif
        </div>
    </div>
</div>

<div class="py-6  w-full flex justify-center">
    <a href="{{ url('/home') }}" class=" py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"> 
        <img width="16" height="16" src="https://img.icons8.com/material-outlined/64/FFFFFF/home--v2.png" alt="home--v2"/>
        Home
    </a>
    <a href="{{ url('/logout') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 h-full">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="h-4 w-4 white">
              <path fill="#ffffff"d="M502.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-128-128c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L402.7 224 192 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l210.7 0-73.4 73.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l128-128zM160 96c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 32C43 32 0 75 0 128L0 384c0 53 43 96 96 96l64 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-64 0c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l64 0z"/>
              </svg>
    </a>
</div>

 
@endsection

