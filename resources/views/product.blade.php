@extends('header_footer')
@section('content')
<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Customer stories</h2>
    <p class="mt-1 text-gray-600 dark:text-gray-400">See how game-changing companies are making the most of every engagement with Preline.</p>
  </div>
  <!-- End Title -->

  <!-- Grid -->
  @if (count($products) > 0)
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 py-10 px-3">
    @foreach ($products as $product)
    <div class="px-3">
    <a href="{{ route('product-detail', ['id' => $product->id]) }}" class="flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg transition-all duration-300 rounded-xl p-5 dark:border-gray-700 dark:hover:border-transparent dark:hover:shadow-black/[.4] dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">
      <div class="aspect-w-16 aspect-h-11">
      @if ($product->images->isNotEmpty())
    <img src="{{ asset('images/'. $product->category->name . '/' . $product->brand->name . '/' . $product->type->name . '/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="w-full h-80  object-cover rounded-xl">
@else
    <img src="{{ asset('images/home.jpeg') }}" alt="{{ $product->name }}" class="w-full object-cover rounded-xl">
@endif
      <div class="mt-auto flex justify-center items-center py-3 w-full text-center ">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-300 dark:group-hover:text-white">
        {{ $product->name }}
        </h3>
        </div>
        <div class="mt-auto flex justify-center items-center py-3 w-full text-center ">
        <p class="text-sm font-semibold text-gray-500 dark:text-gray-300 dark:group-hover:text-white">
        by {{ $product->brand->name }}
        </p>
        </div>
        <div class="mt-auto flex justify-center items-center gap-x-3  w-full text-center">
        <p class="mt-5 text-gray-600 dark:text-gray-400">
        {{ $product->variations->first()->price ?? 'N/A' }}$
        </p>
      </div>
      <div class="mt-auto flex justify-center items-center gap-x-3 py-3 w-full text-center">  
      <h5 class="text-sm text-gray-800 dark:text-gray-200">Click here for more info</h5>   
      </div>
        </div>
     </a> 
    </div>

    @endforeach

</div>

    
@else
  <p>No products found in this category.</p>
@endif

<!-- End Card Blog -->
@endsection