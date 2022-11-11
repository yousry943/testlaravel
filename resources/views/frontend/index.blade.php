@extends('frontend.layouts.app')

@section('title') {{app_name()}} @endsection

@section('content')



<section class="mb-20">
    <div class="container mx-auto flex px-5 py-10 sm:py-24 items-center justify-center flex-col">
        <div class="text-center lg:w-2/3 w-full">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-800">
                Screenshots of the project
            </h1>
            <p class="mb-8 leading-relaxed">
                In the following section we listed a number of screenshots of different parts of the project, Laravel Starter.
            </p>
        </div>
    </div>
</section>

<section class="mb-20">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 p-5">
        <div class="shadow-lg p-3 sm:p-10 rounded-lg">
            <img src="https://user-images.githubusercontent.com/396987/88519250-a0dcc380-d013-11ea-9dc5-9d731af611f1.jpg" alt="About page preview">
        </div>
        <div class="shadow-lg p-3 sm:p-10 rounded-lg row-span-2">
            <img src="https://user-images.githubusercontent.com/396987/88519360-d1bcf880-d013-11ea-9f6c-b5d33912057f.jpg" alt="Pricing page preview">
        </div>
        <div class="shadow-lg p-3 sm:p-10 rounded-lg">
            <img src="https://user-images.githubusercontent.com/396987/88489727-f3889200-cfb7-11ea-819f-dc9a52bc8d82.jpg" alt="Landing page preview">
        </div>
    </div>
</section>

@endsection
