@extends('website.layouts.master')
@section('TitlePage' , 'Cart')
@section('content')


    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">{{__('breadcrumb.home')}}</a>
                    <a class="breadcrumb-item text-dark" href="#">{{__('breadcrumb.shop')}}</a>
                    <span class="breadcrumb-item active">{{__('breadcrumb.cart')}}</span>
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
                            <th>{{__('cart.product')}}</th>
                            <th>{{__('cart.price')}}</th>
                            <th>{{__('cart.quantity')}}</th>
                            <th>{{__('cart.total')}}</th>
                            <th>{{__('cart.remove')}}</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @forelse ($cart_products as $product)
                        <tr>
                            <td class="text-start">
                                @if($product->product->images->isNotEmpty())
                                    <img src="{{ Storage::url($product->product->images->first()->image_path) }}" alt="{{ $product->product->name }}" class="pe-1" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('admin/assets/img/product/noimage.png') }}" alt="No Image" style="width: 50px;">
                                @endif
                                {{ $product->product->name }}
                            </td>
                            <td class="align-middle">{{ $product->product->selling_price }} {{__('product.egp')}}</td>
                            <td class="align-middle">
                                <div class="input-group qty mx-auto" style="width: 100px;">
                                    <button class="btn btn-sm btn-primary btn-minus" data-id="{{ $product->product_id ?? $product->id }}">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input id="qty_{{ $product->product_id ?? $product->id }}"
                                            min="1"
                                            name="qty[{{ $product->product_id ?? $product->id }}]"
                                            type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center qty-input"
                                            value="{{ $product->qty }}"
                                            data-id="{{ $product->product_id ?? $product->id }}" disabled>
                                    <button class="btn btn-sm btn-primary btn-plus" data-id="{{ $product->product_id ?? $product->id }}">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="align-middle" id="total-price-{{ $product->id }}">{{ $product->product->selling_price * $product->qty }} {{__('product.egp')}}</td>

                            <td class="align-middle">
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deletecartModal-{{ $product->id }}">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">{{__('cart.empty_cart')}}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">

                <h5 class="section-title position-relative text-uppercase mb-3">
                    <span class="bg-secondary pr-3">{{__('cart.cart_summary')}}</span>
                </h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>{{__('cart.subtotal')}}</h6>
                            <h6>{{ $total_price }} {{__('product.egp')}}</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <a href="{{ route('checkout.index') }}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">{{__('cart.proceed_to_checkout')}}</a>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <form action="{{ route('cart.update') }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT') <!-- أو @method('PATCH') -->
                            <button type="submit" class="btn btn-secondary font-weight-bold py-3 flex-grow-1 mr-2">{{__('cart.update_cart')}}</button>
                        </form>
                        <a href="{{ route('website.shop') }}" class="btn btn-primary font-weight-bold py-3 flex-grow-1 ml-2">{{__('cart.continue_shopping')}}</a>
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
                    <h1 class="modal-title fs-5" id="deletecartModalLabel-{{ $product->id }}">{{__('cart.remove_product')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('cart.destroy', $product->id) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <div class="modal-body">
                        {{ __('cart.delete_from_cart', ['product' => $product->product->name]) }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('cart.close')}}</button>
                        <button type="submit" class="btn btn-danger">{{__('cart.remove_product')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    @section('customjs')
    <script>

    document.querySelectorAll('.btn-plus, .btn-minus').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.getAttribute('data-id');
            const inputField = document.querySelector(`#qty_${productId}`);
            let quantity = parseInt(inputField.value);

            if (this.classList.contains('btn-plus')) {
                quantity += 1;
            } else if (this.classList.contains('btn-minus') && quantity > 1) {
                quantity -= 1;
            }

            inputField.value = quantity;

            // إرسال طلب AJAX لتحديث الكمية
            fetch("{{ route('cart.update') }}", {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id: productId, // تأكد من أن productId صحيح
                    qty: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Cart updated successfully');
                    // تحديث الواجهة بناءً على الرد (مثل تحديث المجموع الكلي)
                } else {
                    console.error('Failed to update cart');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    </script>
    @endsection
@endsection
