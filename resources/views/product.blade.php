@extends('header_footer')
@section('content')
<!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">

  <!-- Filter Dropdowns -->
  <form action="{{ route('productSelection') }}" method="GET" class="">
    <div class="gap-x-4 flex ">
      <!-- Filter by Brand -->
      <div class="w-40 mb-4 md:mb-0">
        <label for="brand" class="block text-sm font-medium text-gray-700">Filter by Brand:</label>
        <select id="brand" name="brand_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:border-blue-600 focus:ring-blue-600 sm:text-sm appearance-none">
          <option value="{{  $selectedBrand ? $selectedBrand->id : '' }}" selected>{{$selectedBrand ? $selectedBrand->name : 'Select Brand'}}</option>
          <!-- Loop through brands to generate options -->
          @foreach ($brands as $brand)
          <option value="{{ $brand->id }}">{{ $brand->name }}</option>
          @endforeach
          <option value="">all</option>
        </select>
      </div>
      <!-- Filter by Category -->
      <div class="w-40 mb-4 md:mb-0">
        <label for="category" class="block text-sm font-medium text-gray-700">Filter by Type:</label>
        <select id="category" name="category_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:border-blue-600 focus:ring-blue-600 sm:text-sm appearance-none">
          <option value="{{  $selectedCategory ? $selectedCategory->id : '' }}" selected>{{  $selectedCategory ? $selectedCategory->name : 'Select Category' }}</option>
          <!-- Loop through categories to generate options -->
          @foreach ($categories as $category)
          <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
          <option value="">all</option>
        </select>
      </div>

       <div class="w-40 mb-4 md:mb-0">
        <label for="type" class="block text-sm font-medium text-gray-700">Filter by Category:</label>
        <select id="type" name="type_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:border-blue-600 focus:ring-blue-600 sm:text-sm appearance-none ">
        <option value="{{  $selectedType ? $selectedType->id : '' }}">{{  $selectedType ? $selectedType->name : 'Select Type' }}</option>
          <!-- Loop through categories to generate options -->
          @foreach ($types as $type)
          <option value="{{ $type->id }}">{{ $type->name }}</option>
          @endforeach
          <option value="">all</option>
        </select>
      </div>

      <button type="submit" class="mt-6 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Apply Filters</button>
 
    </div>
    
    </div>
  </form>

  <!-- Grid -->
  @if (count($products) > 0)
  <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 py-6 px-3">
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
</div>
@endsection
