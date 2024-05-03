@extends('header_footer')

@section('content')
<!-- Fonts -->
<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

@vite(['resources/js/app.js'])
@vite(['resources/css/app.css'])

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="max-w-[85rem] px-4 py-6 sm:px-6 h-fit lg:px-8 lg:py-8 mx-auto">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Order Summary</h2>
            <div class="mb-4">
                <p class="text-gray-600">Order ID: <span class="font-semibold">{{ $order->id }}</span></p>
                <p class="text-gray-600">Order Date: <span class="font-semibold">{{ $order->created_at->format('M d, Y h:i A') }}</span></p>
            </div>
            <div>
                <h3 class="text-xl font-semibold mb-2">Ordered Items</h3>
                @if($order->orderItems->isNotEmpty())
                    <ul>
                        @foreach($order->orderItems as $item)
                        <li class="flex justify-between items-center mb-2">
                            <div>{{ $item->productVariation->product->name }}</div>
                            <div>{{ $item->quantity }} x ${{ $item->price }}</div>
                        </li>
                        @endforeach
                    </ul>
                @else
                    <p>No items found for this order.</p>
                @endif
            </div>
            <div class="mt-4">
                <p class="text-xl font-semibold">Total: ${{ $order->total }}</p>
            </div>
        </div>
        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Shipping Details</h2>
            <p class="text-gray-600"><span class="font-semibold">Name:</span> {{ $order->user->name }}</p>
            <p class="text-gray-600"><span class="font-semibold">Address:</span> {{ $order->user->address }}</p>
            <p class="text-gray-600"><span class="font-semibold">City:</span> {{ $order->user->city }}</p>
            <p class="text-gray-600"><span class="font-semibold">Country:</span> {{ $order->user->state }}</p>
            <p class="text-gray-600"><span class="font-semibold">Postal Code:</span> {{ $order->user->postal }}</p>
        </div>
    </div>
    <div class="py-6 h-full w-full flex justify-center">
        <a href="{{ url('/home') }}" class=" py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"> 
        <img width="16" height="16" src="https://img.icons8.com/material-outlined/64/FFFFFF/home--v2.png" alt="home--v2"/>
        Home
              </a>
      </div>
</div>

@endsection

@push('scripts')
<script src="{{ mix('js/app.js') }}"></script>
@endpush
