@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Create ingredient
            </div>
            <div class="card-body">
                <form action="{{ $route }}" method="post">
                    @csrf
                    {!! $method !!}
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="ingredient-name">Name</label>
                            <input type="text" class="form-control" name='name' id="ingredient-name"
                                   value="{{ old('name', $item ? $item->name: '') }}"
                                   placeholder="Set name ingredient">
                            @error('name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="ingredient-name">Cost price</label>
                            <input type="number" class="form-control" id="ingredient-price"
                                   step="0.01"
                                   name="cost_price"
                                   value="{{ old('cost_price', $item ? $item->cost_price: 0) }}"
                                   placeholder="Set cost price ingredient">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
