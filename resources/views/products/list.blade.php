@extends('layout.master')

@section('content')
<div class="container mt-3">
    @include('layout.response_message')
    <div class="row">
        @forelse ($products as $product)
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 mt-3">
            <div class="card">
                <img class="card-img" src="{{ $product->image }}" height="250px" width="250px" alt="image">
                <div class="d-flex justify-content-end mr-2">
                    @if($product->stock > 0)
                    <span>
                        <span class="badge badge-primary">In-Stock</span>
                    </span>
                    @else
                    <span>
                        <span class="badge badge-danger">Out-of-stock</span>
                    </span>
                    @endif
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $product->product_name ?? 'N/A' }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">Brand: {{ $product->productsBrand->brand_name ?? 'N/A' }}
                    </h6>
                    <p class="card-text">{{ $product->description ?? 'N/A' }}</p>
                    <div class="buy d-flex justify-content-between align-items-center">
                        <div class="price text-success">
                            <h5 class="mt-4">${{ $product->price ?? 'N/A' }}</h5>
                            <h6>Stock:- {{ $product->stock ?? 0 }}</h6>
                        </div>
                        @if($product->stock > 0)
                        <a href="{{ route('add-to-cart',$product->id) }}" class="btn btn-danger mt-3"><i
                                class="fas fa-shopping-cart"></i> Add to Cart</a>
                        @else
                        <a href="{{ route('add-to-cart',$product->id) }}" class="btn btn-danger mt-3" disabled><i
                                class="fas fa-shopping-cart"></i> Add to Cart</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty

        @endforelse
    </div>
</div>
@endsection