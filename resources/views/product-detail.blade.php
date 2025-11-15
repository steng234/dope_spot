@extends('header_footer')
@section('content')
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
