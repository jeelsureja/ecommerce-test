@extends('layout.master')

@section('content')
<div class="container mt-3">
    @include('layout.response_message')
    <h2>Checkout</h2>
    <form action="{{ route('place_order') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pwd">Shipping Address:</label>
                    <textarea name="shipping_address" id="shipping_address" cols="30" rows="10"
                        class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="pwd">Biling Address:</label>
                    <textarea name="biling_address" id="biling_address" cols="30" rows="10"
                        class="form-control"></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header">
                        <h3>Product</h3>
                    </div>
                    <div class="card-body">
                        <h4>Product Name:-{{ $product->product_name ?? 'N/A' }}</h4>
                        <h4>Quantity:-{{ $quantity ?? 'N/A' }}</h4>
                        <h4>Total:-${{ $total ?? 'N/A' }}</h4>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary ml-3">Submit</button>
        </div>
    </form>
</div>
@endsection