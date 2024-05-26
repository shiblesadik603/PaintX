<!-- show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('uploads/products/'.$item->photo) }}" alt="{{ $item->name }}" class="img-fluid">
        </div>
        <div class="col-md-6">
            <h2>{{ $item->name }}</h2>
            <p>{{ $item->description }}</p>
            <p>Price: ${{ $item->price }}</p>
            <form action="{{ route('cart.add', $item->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>
        </div>
    </div>
</div>
@endsection
