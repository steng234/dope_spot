@extends('header_footer')
@section('content')
   <!-- Fonts -->
   <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        @vite(['resources/js/app.js'])
        @vite(['resources/css/app.css'])
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="app">
  <product-detail
    :product-name="'{{ $product->name }}'"
    :product-id="'{{ $product->id }}'"
    :brand-name="'{{ $product->brand->name }}'"
    :product-price="'{{ $product->variations->first()->price ?? 'N/A' }}'"
    :product-description="'{{ $product->description }}'"
    :main-image="'{{ asset('images/'. $product->category->name . '/' . $product->brand->name . '/' . $product->type->name . '/' . $product->images->get(1)->image) }}'"
    :additional-images="[ 
  @foreach($product->images->skip(1) as $image)
    '{{ asset('images/'. $product->category->name . '/' . $product->brand->name . '/' . $product->type->name . '/' . $image->image) }}',
  @endforeach
]"
:variations="{{ $product->variations }}"
    @main-image-changed="updateMainImage"
  ></product-detail>
</div>
@endsection

@push('scripts')
<script src="{{ mix('js/app.js') }}"></script>
@endpush
