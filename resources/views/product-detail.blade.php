@extends('header_footer')
@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <div class="max-w-2xl mx-auto">
    <div class="border border-gray-200 rounded-xl p-5 dark:border-gray-700">
      <!-- Product Image -->
      <div class="aspect-w-16 aspect-h-11">
        <img src="{{ asset('images/'. $product->category->name . '/' . $product->brand->name . '/' . $product->type->name . '/' . $product->images->first()->image) }}" alt="{{ $product->name }}" class="w-full h-80 object-cover rounded-xl">
      </div>
      <!-- Product Name -->
      <h2 class="mt-5 text-2xl font-bold text-gray-800 dark:text-gray-300">{{ $product->name }}</h2>
      <!-- Brand -->
      <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-gray-300">Brand: {{ $product->brand->name }}</p>
      <!-- Price -->
      <p class="mt-2 text-lg font-bold text-gray-800 dark:text-gray-300">${{ $product->variations->first()->price ?? 'N/A' }}</p>
      <!-- Description -->
      <p class="mt-4 text-base text-gray-600 dark:text-gray-400">{{ $product->description }}</p>
      <!-- Additional Information -->
      <div class="mt-4">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-300">Additional Photos:</h3>
        <ul class="mt-2 grid grid-cols-2 gap-4">
          @foreach($product->images as $image)
            <li>
              <img src="{{ asset('images/'. $product->category->name . '/' . $product->brand->name . '/' . $product->type->name . '/' . $image->image) }}" alt="{{ $product->name }}" class="w-full h-32 object-cover rounded-lg">
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>


@endsection