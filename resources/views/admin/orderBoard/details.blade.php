@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <!-- Header Section -->
        <div class="d-flex align-items-center justify-content-between mb-4 mt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 m-0">
                    <li class="breadcrumb-item"><a href="{{ route('info#adminOrder') }}">Orders</a></li>
                    <li class="breadcrumb-item active">Order Details</li>
                </ol>
            </nav>
            <a href="{{ route('info#adminOrder') }}" class="btn btn-sm btn-secondary shadow-sm">
                <i class="fa-solid fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>

        <div class="row">
            <!-- Customer & Order Info Card -->
            <div class="col-lg-7 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-user mr-2"></i>Customer
                            Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Customer Name:</div>
                            <div class="col-sm-8 text-dark">{{ $payslipData->user_name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Phone Number:</div>
                            <div class="col-sm-8 text-dark">
                                @if ($payslipData->phone != $order[0]->user_phone)
                                    <span class="badge badge-light border">{{ $payslipData->phone }}</span> /
                                @endif
                                <span class="text-primary font-weight-bold">{{ $order[0]->user_phone }}</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-4 text-muted font-weight-bold">Shipping Address:</div>
                            <div class="col-sm-8 text-dark small">{{ $payslipData->address }}</div>
                        </div>
                        <hr class="my-3">
                        <div class="row mb-2">
                            <div class="col-sm-4 text-muted font-weight-bold">Order Code:</div>
                            <div class="col-sm-8"><span class="badge badge-primary px-3"
                                    id="orderCode">{{ $payslipData->order_code }}</span></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-muted font-weight-bold">Total Amount:</div>
                            <div class="col-sm-8">
                                <h5 class="text-success font-weight-bold mb-0">{{ number_format($payslipData->total_amt) }}
                                    MMK</h5>
                                <small class="text-danger">* Included Delivery Charges</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment & Payslip Card -->
            <div class="col-lg-5 mb-4">
                <div class="card shadow-sm border-0 h-100 text-center">
                    <div class="card-header bg-white py-3 text-left">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fa-solid fa-credit-card mr-2"></i>Payment
                            Details</h6>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <div class="mb-3 w-100 text-left px-3">
                            <p class="mb-1 text-muted">Method: <strong>{{ $payslipData->payment_method }}</strong></p>
                            <p class="mb-3 text-muted">Date:
                                <strong>{{ $payslipData->created_at->format('d M Y | h:i A') }}</strong></p>
                        </div>
                        <div class="payslip-container shadow-sm border rounded p-2">
                            <p class="small text-muted mb-1">Attached Payslip</p>
                            <a href="{{ asset('payslip/' . $payslipData->payslip_image) }}" target="_blank">
                                <img style="max-height: 200px;" src="{{ asset('payslip/' . $payslipData->payslip_image) }}"
                                    class="img-fluid rounded border shadow-sm">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Table Card -->
        <div class="card shadow-sm border-0 mb-5">
            <div class="card-header bg-primary text-white py-3">
                <h6 class="m-0 font-weight-bold text-white">Order Board (Items List)</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover text-center mb-0 align-middle" id="productTable">
                        <thead class="bg-light text-dark small text-uppercase">
                            <tr>
                                <th class="py-3" style="width: 150px;">Image</th>
                                <th class="py-3 text-left">Product Name</th>
                                <th class="py-3">Quantity</th>
                                <th class="py-3">In Stock</th>
                                <th class="py-3">Price (Unit)</th>
                                <th class="py-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $item)
                                <tr class="item-row">
                                    <input type="hidden" class="productId" value="{{ $item->product_id }}">
                                    <input type="hidden" class="productOrderCount" value="{{ $item->order_count }}">

                                    <td class="p-3">
                                        <img src="{{ asset('product/' . $item->product_image) }}"
                                            class="img-fluid rounded border shadow-sm"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    </td>
                                    <td class="text-left font-weight-bold text-dark">{{ $item->product_name }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-info px-3 py-2">{{ $item->order_count }}</span>
                                        @if ($item->available_stock < $item->order_count)
                                            <br><small class="text-danger font-weight-bold">Insufficient Stock!</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $item->available_stock }} units</span>
                                    </td>
                                    <td>{{ number_format($item->product_price) }} MMK</td>
                                    <td class="text-primary font-weight-bold">
                                        {{ number_format($item->order_count * $item->product_price) }} MMK</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white py-3 border-top d-flex justify-content-end">
                <div class="btn-group">
                    <button type="button" id="btn-order-confirm" class="btn btn-success px-4 mr-2 rounded shadow-sm"
                        @if ($payslipData->status != 0) disabled @endif>
                        <i class="fa-solid fa-check-circle mr-1"></i> Confirm Order
                    </button>

                    <button type="button" id="btn-order-cancle" class="btn btn-outline-danger px-4 rounded shadow-sm"
                        @if ($payslipData->status == 2) disabled @endif>
                        <i class="fa-solid fa-times-circle mr-1"></i> Cancel Order
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
