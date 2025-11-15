@extends('header_footer')

@section('content')
    <div class="container h-full w-full mx-auto px-4 py-8 flex items-center justify-center">
        <div>
            <h1 class="text-2xl font-semibold mb-4 ">Choose Payment Method</h1>
            @if($paymentMethods->isEmpty())
                <p class="text-gray-500 pb-6">You don't have any stored payment methods.</p>
                <a href="{{ route('payment.add') }}" class="py-3 px-4 inline-flex items-center gap-x-2 text-xs font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 h-full">Add Payment Method</a>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($paymentMethods as $paymentMethod)
                        <div class="bg-white rounded-lg shadow-md p-6">
                            <h2 class="text-lg font-semibold">Card number</h2>
                            <p class="text-gray-500 pb-2">{{ $paymentMethod->card_number }}</p>
                            <p class="text-gray-500 pb-2">{{ $paymentMethod->expiry_date }}</p>
                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method_id" value="{{ $paymentMethod->id }}">
                                <button type="submit" class="w-full py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Use This Card</button>
                            </form>
                        </div>
                    @endforeach
                </div>
                <div class=" p-10 w-full h-10 flex justify-center items-center">
                    <a href="{{ route('payment.add') }}" class="py-3  h-10 px-4 inline-flex items-center gap-x-2 text-xs font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 h-full"> Or add Payment Method</a>
                </div>
            @endif
        </div>
    </div>
@endsection
