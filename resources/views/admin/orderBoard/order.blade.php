@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid px-4">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Order Management</h1>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="">
                <button class="btn btn-sm btn-secondary shadow-sm px-3">
                    <i class="fas fa-list mr-1"></i> Order List
                </button>
            </a>

            <div class="col-md-4 px-0">
                <form action="" method="get">
                    @csrf
                    <div class="input-group shadow-sm">
                        <input type="text" name="searchKey" value="{{ request('searchKey') }}"
                            class="form-control border-0 small" placeholder="Search by order code or user...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="border-0">Date</th>
                                <th class="border-0">Order Code</th>
                                <th class="border-0">Customer Name</th>
                                <th class="border-0" style="width: 200px;">Action</th>
                                <th class="border-0">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($order) > 0)
                                @foreach ($order as $item)
                                    <tr>
                                        <input type="hidden" class="orderCode" value="{{ $item->order_code }}">
                                        <td class="align-middle text-muted small">
                                            {{ $item->created_at->format('j M Y') }}
                                        </td>

                                        <td class="align-middle">
                                            <a href="{{ route('info#details', $item->order_code) }}"
                                                class="font-weight-bold text-primary text-decoration-none">
                                                {{ $item->order_code }}
                                            </a>
                                        </td>

                                        <td class="align-middle font-weight-bold text-dark">
                                            {{ $item->user_name }}
                                        </td>

                                        <td class="align-middle">
                                            <select name=""
                                                class="form-control form-control-sm custom-select statusChange shadow-sm border-info">
                                                <option value="0" @if ($item->status == 0) selected @endif>
                                                    Pending</option>
                                                <option value="1" @if ($item->status == 1) selected @endif>
                                                    Accept</option>
                                                <option value="2" @if ($item->status == 2) selected @endif>
                                                    Reject</option>
                                            </select>
                                        </td>

                                        <td class="align-middle">
                                            @if ($item->status == 0)
                                                <span class="badge badge-pill badge-warning-soft p-2">
                                                    <i class="fa-regular fa-clock text-warning fa-lg"></i>
                                                </span>
                                            @endif
                                            @if ($item->status == 1)
                                                <span class="badge badge-pill badge-success-soft p-2">
                                                    <i class="fa-solid fa-check text-success fa-lg"></i>
                                                </span>
                                            @endif
                                            @if ($item->status == 2)
                                                <span class="badge badge-pill badge-danger-soft p-2">
                                                    <i class="fa-regular fa-circle-xmark text-danger fa-lg"></i>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="py-5 text-muted small">No orders found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-end">
            {{-- Pagination can go here --}}
        </div>

    </div>
@endsection
