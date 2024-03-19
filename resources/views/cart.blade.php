@extends('header_footer')
@section('content')
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/js/app.js'])
        @vite(['resources/css/app.css'])
<meta name="csrf-token" content="{{ csrf_token() }}">   
@if($cartItemCount > 0)
         <!-- Display content when user has products in their cart -->
          <!-- Display content when user has products in their cart -->
          <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
            <div id="app">
            <cart :variations="{{ json_encode($cartItems) }}"
            ></cart>
            </div>
          </div>
    @else
        <!-- Display content when user has no products in their cart -->
        <div class="justify-center h-full flex items-center">
        <div>
        <div class="p-4 sm:p-14 text-center overflow-y-auto g">
        <h3 class="mb-2 text-2xl font-bold text-gray-800 dark:text-gray-200">
          Nothing here!
        </h3>
        <p class="text-gray-500">
          Add item in the cart to view it here!
        </p>
      </div>

      <div class="flex items-center justify-center  ">
        <div class="px-6">
        <a href="{{  route('productSelection', ['category_id' => 1] )}}" class=" py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
        <img width="16" height="16" src="https://img.icons8.com/external-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto/64/FFFFFF/external-shopping-bag-digital-marketing-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto.png" alt="external-shopping-bag-digital-marketing-yogi-aprelliyanto-basic-outline-yogi-aprelliyanto"/>
         Shop 
              </a>  
        </div>
        <div class="px-6">
        <a href="{{ url('/home') }}" class=" py-2.5 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"> 
        <img width="16" height="16" src="https://img.icons8.com/material-outlined/64/FFFFFF/home--v2.png" alt="home--v2"/>
        Home
              </a>
      </div>
    </div>
  </div>
  </div>
</div>

    @endif
@endsection

@push('scripts')
<script src="{{ mix('js/app.js') }}">


</script>
@endpush
