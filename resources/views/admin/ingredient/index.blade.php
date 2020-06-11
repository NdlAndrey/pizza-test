@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Ingredients List

                <a href="{{ route('ingredients.create') }}" class="btn btn-primary btn-sm float-right" >Create</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col" width="130">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($ingredients as $index => $ingredient)
                    <tr>
                        <td>{{ ++$index }}</td>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->cost_price }}</td>
                        <td>
                            <a href="{{ route('ingredients.update', $ingredient->id) }}" class="btn btn-primary btn-sm " >Edit</a>
                            <form action="{{ route('ingredients.destroy', $ingredient->id) }}" method="post" class="form-inline float-right">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $ingredients->links() }}
            </div>
        </div>
    </div>
@endsection
