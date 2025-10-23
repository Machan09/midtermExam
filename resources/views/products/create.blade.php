@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
            @error('quantity') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group mb-3">
            <label>Price</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
            @error('price') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <div class="form-group mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
