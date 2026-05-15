@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4 py-4">

        <!-- Back Link -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 mb-4">
                <li class="breadcrumb-item">
                    <a href="{{ route('List#productsList') }}" class="text-decoration-none text-primary font-weight-bold">
                        <i class="fas fa-arrow-left mr-1"></i> Back to Inventory
                    </a>
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
                    <div class="row no-gutters">
                        <!-- Product Image Section -->
                        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-4">
                            <div class="product-img-wrapper shadow">
                                <img src="{{ asset('product/' . $productDetails->image) }}" class="img-fluid rounded"
                                    alt="{{ $productDetails->name }}"
                                    style="max-height: 400px; width: 100%; object-fit: cover;">
                            </div>
                        </div>

                        <!-- Product Info Section -->
                        <div class="col-md-7">
                            <div class="card-body p-lg-5">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        <span class="badge badge-primary-soft text-primary px-3 py-2 mb-2"
                                            style="background: #eef2ff;">
                                            <i class="fas fa-tag mr-1"></i> {{ $productDetails->category_name }}
                                        </span>
                                        <h2 class="h3 font-weight-bold text-gray-900 mb-0">{{ $productDetails->name }}</h2>
                                    </div>
                                    <div class="text-right">
                                        <h3 class="text-primary font-weight-bold mb-0">
                                            {{ number_format($productDetails->price) }} <small>MMK</small></h3>
                                        <small class="text-muted italic">Unit Price</small>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="row mb-4">
                                    <div class="col-6 border-right">
                                        <p class="text-muted small text-uppercase font-weight-bold mb-1">Current Stock</p>
                                        <h5
                                            class="font-weight-bold {{ $productDetails->available_item <= 5 ? 'text-danger' : 'text-dark' }}">
                                            <i class="fas fa-box-open mr-2 text-muted"></i>
                                            {{ $productDetails->available_item }} units
                                        </h5>
                                    </div>
                                    <div class="col-6 pl-4">
                                        <p class="text-muted small text-uppercase font-weight-bold mb-1">Product Status</p>
                                        <h5 class="text-success font-weight-bold">
                                            <i class="fas fa-check-circle mr-2"></i> Active
                                        </h5>
                                    </div>
                                </div>

                                <div class="product-description mb-4">
                                    <h6 class="font-weight-bold text-dark text-uppercase small mb-2">Detailed Description
                                    </h6>
                                    <p class="text-muted leading-relaxed">
                                        {{ $productDetails->description ?: 'No detailed description provided for this product.' }}
                                    </p>
                                </div>

                                <div class="mt-5 d-flex">
                                    <a href="{{ route('product#updatePage', $productDetails->id) }}"
                                        class="btn btn-primary px-4 shadow-sm mr-2">
                                        <i class="fas fa-edit mr-2"></i> Edit Product
                                    </a>
                                    <button class="btn btn-outline-light border text-dark px-4 shadow-sm">
                                        <i class="fas fa-print mr-2 text-muted"></i> Print Info
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <style>
        .product-img-wrapper {
            transition: transform 0.3s ease;
            border-radius: 12px;
            overflow: hidden;
            background: white;
        }

        .product-img-wrapper:hover {
            transform: scale(1.02);
        }

        .leading-relaxed {
            line-height: 1.6;
        }

        .badge-primary-soft {
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 0.75rem;
        }
    </style>
@endsection
