@extends('layout.master')

@section('content')
<div class="container">
    @include('layout.response_message')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            @php
            $total = 0;
            @endphp
            @if(session('cart'))
            @forelse (session('cart') as $id=>$details)
            @php
            $total += $details['price'] * $details['quantity'];
            @endphp
            <tr data-id="{{$id}}">
                <td data-th="Product">
                    <div class="row">
                        <div class="col-sm-3" hidden-xs><img src="{{ $details['image'] }}" height="100px" width="100px"
                                alt="img" class="image-responsive"></div>
                        <div class="col-sm-9">
                            <h4 class="ml-4">{{ $details['product_name'] }}</h4>
                        </div>
                    </div>
                </td>
                <td data-th="Price">
                    ${{$details['price']}}
                </td>
                <td data-th="Quantity">
                    <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity update-cart" />
                </td>
                <td data-th="Subtotal" class="text-center">
                    ${{ $details['price'] * $details['quantity'] }}
                </td>
                <td data-th="actions" class="sections">
                    <button class="btn btn-danger btn-sm remove-from-cart"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
            @empty
            <tr>
                <td><p class="text-center">No Items</p></td>
            </tr>
            @endforelse
            @endif
        </tbody>
        <tfoot>
            <tr class="text-right">
                <td colspan="5"><strong>${{ $total }}</strong></td>
            </tr>
            <tr colspan="5" class="text-right">
                <td colspan="5" class="text-rigt">
                    <a href="{{ route('product-list') }}" class="btn btn-warning">Continue To shopping</a>
                    <a href="{{ route('checkout') }}" class="btn btn-success">Checkout</a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('custom-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
    $(".update-cart").change(function(e){
        e.preventDefault();

        var ele = $(this);
        console.log(ele);

        $.ajax({
            url: '{{ route('update-cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("data-id"),
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $(".remove-from-cart").click(function(e){
        e.preventDefault();

        var ele = $(this);
        console.log(ele);

        if(confirm("are you sure want to remove")) {
            $.ajax({
                url: '{{ route('remove-from-cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection