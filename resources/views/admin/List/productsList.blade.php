@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4">

        <!-- Page Header -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Product Inventory</h1>
                <p class="text-muted small mb-0">Total Products: <span
                        class="badge badge-secondary">{{ count($products) }}</span></p>
            </div>
            <div class="d-flex align-items-center">
                <a href="{{ route('List#productsList') }}" class="btn btn-sm btn-white border shadow-sm mr-2">
                    <i class="fas fa-sync-alt text-primary"></i> Refresh
                </a>
                <a href="{{ route('List#productsList', 'lowAmt') }}" class="btn btn-sm btn-danger shadow-sm">
                    <i class="fas fa-exclamation-triangle mr-1"></i> Low Stock
                </a>
            </div>
        </div>

        <!-- Search & Filter Bar -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body p-3">
                <form action="{{ route('List#productsList') }}" method="get">
                    <div class="row no-gutters align-items-center">
                        <div class="col">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-light border-0"><i class="fas fa-search"></i></span>
                                </div>
                                <input type="text" name="searchKey" value="{{ request('searchKey') }}"
                                    class="form-control bg-light border-0 shadow-none"
                                    placeholder="Search by product name or ID...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary px-4">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Product Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4">Product
                                    Info</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Category
                                </th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                    Price</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                    Stock Status</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($products) != 0)
                                @foreach ($products as $item)
                                    <tr class="hover-row border-bottom">
                                        <td class="px-4">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('product/' . $item->image) }}"
                                                    class="rounded shadow-sm mr-3"
                                                    style="width: 50px; height: 50px; object-fit: cover;">
                                                <div>
                                                    <h6 class="mb-0 text-sm font-weight-bold text-dark">{{ $item['name'] }}
                                                    </h6>
                                                    <small class="text-muted">ID: {{ $item['id'] }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span
                                                class="badge badge-pill badge-light border">{{ $item['category_name'] }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if ($item['category_name'] == 'Vegetarian')
                                                <div class="d-flex flex-column align-items-center">
                                                    <span
                                                        class="text-xs text-danger text-decoration-line-through">{{ number_format($item['price']) }}</span>
                                                    <span
                                                        class="text-dark font-weight-bold">{{ number_format($item['price'] * 0.7) }}
                                                        MMK</span>
                                                    <span class="badge badge-warning text-xxs px-1">30% OFF</span>
                                                </div>
                                            @else
                                                <span
                                                    class="text-dark font-weight-bold">{{ number_format($item['price']) }}
                                                    MMK</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex flex-column">
                                                <span class="font-weight-bold text-dark">{{ $item['stock'] }} units</span>
                                                @if ($item['stock'] <= 3)
                                                    <span
                                                        class="badge badge-danger-soft text-xxs text-uppercase font-weight-bold"
                                                        style="color: #e74a3b; background: #fff5f5;">Low Stock</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-right px-4">
                                            <div class="btn-group">
                                                <a href="{{ route('product#detailProduct', $item->id) }}"
                                                    class="btn btn-sm btn-light text-primary border shadow-sm mr-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('product#updatePage', $item->id) }}"
                                                    class="btn btn-sm btn-light text-info border shadow-sm mr-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('product#delete', $item->id) }}"
                                                    class="btn btn-sm btn-light text-danger border shadow-sm">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="py-5 text-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="fas fa-box-open fa-3x text-light mb-3"></i>
                                            <h5 class="text-muted font-weight-bold">No Products Found</h5>
                                            <p class="text-muted small">Try adjusting your search or add new products.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-xxs {
            font-size: 0.65rem;
        }

        .hover-row:hover {
            background-color: #fbfbfb;
            transition: 0.2s;
        }

        .btn-white {
            background-color: #fff;
        }

        .badge-danger-soft {
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            border: 1px solid #ff000021;
        }

        .text-decoration-line-through {
            text-decoration: line-through;
        }
    </style>
@endsection
