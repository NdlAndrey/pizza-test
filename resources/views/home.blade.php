@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($pizzas as $pizza)
                <div class="mb-3 col-md-6">
                    <div class="card h-100" style="max-width: 540px;">
                        <div class="row no-gutters ">
                            <div class="col-md-4 ml-0">
                                <img src="{{ asset('images/pizza-placeholder-img.jpg') }}" class="card-img" alt="{{ $pizza->name }}">

                                <h5 class="font-weight-bold text-center mt-4">Price: {{ $pizza->price() }} EUR</h5>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $pizza->name }} </h5>
                                    <ul>
                                        @foreach($pizza->ingredients as $ingredient)
                                            <li>{{ $ingredient->name }}</li>
                                        @endforeach
                                    </ul>
                                    <p class="card-text"><small class="text-muted">Last
                                            updated {{ $pizza->updated_at->diffForHumans() }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
@endsection
