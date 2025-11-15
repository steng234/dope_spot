@extends('layout')

@section('content')
  <body class="dark:bg-slate-900 bg-gray-100 flex h-full items-center py-16">
    <main class="w-full max-w-md mx-auto p-6">
      <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
        <div class="p-4 sm:p-7" id="app">
          <payment-form></payment-form>
        </div>
      </div>
    </main>
  </body>
@endsection