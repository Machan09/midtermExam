@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Product Details</h1>
    <p><strong>ID:</strong> {{ $product->id }}</p>
    <p><strong>Name:</strong> {{ $product->name }}</p>
    <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
    <p><strong>Price:</strong> {{ $product->price }}</p>
    <p><strong>Category:</strong> {{ $product->category->name }}</p>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
