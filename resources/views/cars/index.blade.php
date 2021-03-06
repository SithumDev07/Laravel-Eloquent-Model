@extends('layouts.app')

{{-- @foreach ($cars as $car)
    {{ $car->name }}
@endforeach --}}

@section('content')
    <div class="m-auto w-4/5 py-24 ">
        <div class="text-center">
            <h1 class="text-5xl uppercase bold">Cars</h1>
        </div>

        {{-- {{ dd(Auth::user()) }} --}}

        @if (Auth::user())
            <div class="pt-10">
                <a href="cars/create" class="border-b-2 pb-2 border-dotted italic text-gray-500">
                    Add a new car &rarr;
                </a>
            </div>
        @else
            <p class="py-12 italic">
                Please login to add a ner car.
            </p>
        @endif
    
        
        <div class="w-5/6 py-10">
            @foreach ($cars as $car)
                <div class="m-auto">

                    @if (isset(Auth::user()->id) && Auth::user()->id == $car->user_id)
                            <div class="float-right">
                                <a href="cars/{{ $car->id }}/edit" class="border-b-2 pb-2 border-dotted italic text-green-500">
                                {{-- <a href="cars//edit" class="border-b-2 pb-2 border-dotted italic text-green-500"> --}}
                                Edit &rarr;</a>

                                <form action="/cars/{{ $car->id }}" method="POST" class="pt-3">
                                {{-- <form action="/cars/" method="POST" class="pt-3"> --}}
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="border-b-2 pb-2 border-dotted italic text-red-500">Delete &rarr;</button>
                                </form>
                            </div>
                        
                    @endif

                    <img src="{{ asset('images/' . $car->image_path) }}" alt="" class="w-40 mb-8 shadow-xl">
                    
                    <span class="uppercase text-blue-500 font-bold text-xs italic">
                        Founded: {{ $car->founded }}
                    </span>

                    <h2  class="text-gray-700 text-5xl hover:text-gray-500">
                        {{-- {{ $car->name }} --}}
                        <a href="/cars/{{ $car->id }}">{{ $car->name }}</a>
                    </h2>

                    <p class="text-lg text-gray-700 py-6">
                        {{ $car->description }}
                    </p>
                
                    <hr class="mt-4 mb-8">
                
                </div>
            @endforeach
        </div>

        {{ $cars->links() }} 
    </div>
@endsection