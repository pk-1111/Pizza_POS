@extends('user.layouts.master')


@section('content')
    <!-- Cart Page Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>

                        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">

                        @foreach ($cart as $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ str_contains($item->image, 'http') ? $item->image : asset('product/' . $item->image) }}"
                                            class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                            alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->name }}</p>
                                </td>
                                <td class="price"
                                    data-price = "{{ $item->category_name == 'Vegetarian' ? $item->price * 0.7 : $item->price }}">
                                    @if ($item->category_name == 'Vegetarian')
                                        <p class="mb-0 mt-4">
                                            <span class="fw-bold text-success  ">{{ number_format($item->price * 0.7) }}
                                                mmk</span>
                                        </p> <br>
                                    @else
                                        <p class="mb-0 mt-4 "> {{ number_format($item->price) }} mmk</p>
                                    @endif



                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" id="quantity" style="color: black"
                                            class="form-control  qty form-control-sm text-center border-0"
                                            value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4 total">
                                        {{ ($item->category_name == 'Vegetarian' ? $item->price * 0.7 : $item->price) * $item->qty }}
                                        mmk</p>
                                </td>
                                <td>
                                    <input type="hidden" class="productId" value="{{ $item->product_id }}">
                                    <input type="hidden" class="cartId" value="{{ $item->cart_id }}">
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <div class="row g-4 mt-3 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="subTotal">{{ $total }}mmk</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Delivery </h5>
                                <div class="">
                                    <p class="mb-0"> 50000 mmk </p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4 " id="finalTotal">{{ $total + 5000 }} mmk</p>
                        </div>

                        <button @if (count($cart) == 0) disabled @endif id="btn-checkout"
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button">Proceed Checkout</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
