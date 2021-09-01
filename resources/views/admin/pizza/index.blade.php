@extends('layouts.app')

@section('content')
    <div class="container">
        <pizza-list-component source="{{ route('pizza.get-ajax') }}"></pizza-list-component>
    </div>
@endsection
