@extends('welcome')

@section('content')
<div class=" h-full px-4 sm:px-6 lg:px-8 mx-auto ">
  <div>
  <!-- Title -->
  <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
    <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">About shipping</h2>
    <p class="mt-1 text-gray-600 dark:text-gray-400">Dope-Spot take care of shipping to improve user experience</p>
  </div>
  <!-- End Title -->

  <!-- Grid -->
  <div class="grid sm:grid-cols-1 lg:grid-cols-2 gap-6 py-10 px-3">

    <!-- Card -->
    <div class="px-3">
    <a class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg transition-all duration-300 rounded-xl p-5 dark:border-gray-700 dark:hover:border-transparent dark:hover:shadow-black/[.4] dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">
      <div class="aspect-w-16 aspect-h-11">
        <img class="w-full object-cover rounded-xl" src="{{asset('images/ups.webp')}}" alt="Image Description">
      </div>
      <div class="mt-auto flex justify-center items-center py-3 w-full text-center ">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-300 dark:group-hover:text-white">
          About our delivery company
        </h3>
        </div>
        <div class="mt-auto flex justify-center items-center gap-x-3  w-full text-center">
        <p class="mt-5 text-gray-600 dark:text-gray-400">
            We prioritize the safe and timely delivery of your purchases. 
            That's why we partner exclusively with reputable shipping companies like UPS. Rest assured, your orders are in good hands from our store to your doorstep. Experience the convenience and reliability of our shipping services today.
          </p>
        </p>
      </div>
      <div class="mt-auto flex justify-center items-center gap-x-3 py-3 w-full text-center">  
      </div>
    </a>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="px-3">
    <a class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg transition-all duration-300 rounded-xl p-5 dark:border-gray-700 dark:hover:border-transparent dark:hover:shadow-black/[.4] dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">
      <div class="aspect-w-16 aspect-h-11">
        <img class="w-full object-cover rounded-xl" src="{{asset('images/vintage_banana_store.webp')}}" alt="Image Description">
      </div>
      <div class="mt-auto flex justify-center items-center py-3 w-full text-center ">
        <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-300 dark:group-hover:text-white">
         About reimbursement
        </h3>
        </div>
        <div class="mt-auto flex justify-center items-center gap-x-3  w-full text-center">
        <p class="mt-5 text-gray-600 dark:text-gray-400">
        That's why our reimbursement system is designed to be straightforward and hassle-free. 
        Simply keep your receipts handy, and we'll take care of the rest. 
        Our dedicated team works diligently to process reimbursements promptly.
        </p>
      </div>
      <div class="mt-auto flex justify-center items-center gap-x-3 py-3 w-full text-center">  
      </div>

    </a>
  </div>
    <!-- End Card -->
    
  

  </div>
  <!-- End Grid -->
</div>
</div>
<!-- End Card Blog -->
@endsection