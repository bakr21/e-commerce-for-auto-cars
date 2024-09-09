@extends('website.layouts.master')
@section('TitlePage' , 'Cart')
@section('content')


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shopping Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($cart_products as $product)
                        <tr>
                            <td class="align-middle">
                                @if($product->product->images->isNotEmpty())
                                    <img src="{{ Storage::url($product->product->images->first()->image_path) }}" alt="{{ $product->product->name }}" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('admin/assets/img/product/noimage.png') }}" alt="No Image" style="width: 50px;">
                                @endif
                                {{ $product->product->name }}
                            </td>
                            <td class="align-middle">${{ $product->product->selling_price }}</td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input id="form1" min="0" name="qty" type="text" class="form-control form-control-sm bg-secondary border-0 text-center qty_{{$product->id}}" 
                                    value="{{ $product->qty }}">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus" >
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">${{ $product->product->selling_price * $product->qty }}</td>
                            <td class="align-middle">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletecartModal-{{ $product->id }}">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>    
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No products found in the cart.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">Cart Summary</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>{{ $total_price }} EGP</h6>
                        </div>
                        {{-- <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">Shipping</h6>
                        </div> --}}
                    </div>
                    <div class="pt-2">
                        {{-- <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>${{ $total_price}}</h5>
                        </div> --}}
                        <a href="{{route('checkout.index')}}" class="btn btn-block btn-primary font-weight-bold my-3 py-3" >Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Cart End -->
    
    <!-- Delete product from cart Modal -->
    @foreach ($cart_products as $product)
    <div class="modal fade" id="deletecartModal-{{ $product->id }}" tabindex="-1" aria-labelledby="deletecartModalLabel-{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletecartModalLabel-{{ $product->id }}">Delete Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cart.destroy', $product->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        Delete {{ $product->Product->name }} from your Cart?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    
<script>
    $(document).ready(function() {
        $('.btn-plus, .btn-minus').on('click', function() {
            var $btn = $(this);
            var $input = $btn.closest('.input-group').find('input');
            var currentValue = parseInt($input.val());
            var newValue = $btn.hasClass('btn-plus') ? currentValue : currentValue ;
            newValue = newValue < 0 ? 0 : newValue;
            $input.val(newValue);

            var productId = $input.attr('class').split('_')[1];
            var newQty = newValue;

            // AJAX request to update cart quantity
            $.ajax({
                url: '{{route('cart.update')}}', 
                type: 'POST',
                data: {
                    id: productId,
                    qty: newQty,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Update the total price based on the new quantity
                    $('#total-price-' + productId).text('$' + response.newTotalPrice);
                    $('#cart-summary').text('$' + response.cartTotal);
                }
            });
        });
    });
</script>

    
@endsection