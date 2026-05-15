@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Payment Methods Management</h1>
        </div>

        <div class="row">
            <!-- Create Payment Form -->
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Create New Payment</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('paymentMethod#adminPaymentCreate') }}" method="post">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Account Number</label>
                                <input type="text" name="accountNumber"
                                    class="form-control shadow-none @error('accountNumber') is-invalid @enderror"
                                    value="{{ old('accountNumber') }}" placeholder="Enter account no...">
                                @error('accountNumber')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="small font-weight-bold text-dark">Account Name</label>
                                <input type="text" name="accountName"
                                    class="form-control shadow-none @error('accountName') is-invalid @enderror"
                                    value="{{ old('accountName') }}" placeholder="Enter account name...">
                                @error('accountName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="small font-weight-bold text-dark">Payment Type</label>
                                <input type="text" name="accountType"
                                    class="form-control shadow-none @error('accountType') is-invalid @enderror"
                                    value="{{ old('accountType') }}" placeholder="e.g. KBZ Pay, WavePay">
                                @error('accountType')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block shadow-sm font-weight-bold">
                                <i class="fas fa-plus-circle mr-1"></i> Create Payment
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Payment List Table -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Payment Methods List</h6>
                    </div>
                    <div class="table-responsive p-3">
                        <table class="table table-hover align-middle border-light text-center">
                            <thead class="bg-light text-dark">
                                <tr>
                                    <th class="border-0">ID</th>
                                    <th class="border-0">Type</th>
                                    <th class="border-0 text-left">Account Info</th>
                                    <th class="border-0">Created Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (count($payments) != 0)
                                    @foreach ($payments as $item)
                                        <tr>
                                            <td class="align-middle">{{ $item->id }}</td>
                                            <td class="align-middle">
                                                <span class="badge badge-info px-3 py-2">{{ $item->type }}</span>
                                            </td>
                                            <td class="text-left align-middle">
                                                <div class="font-weight-bold text-dark">{{ $item->account_name }}</div>
                                                <small class="text-muted">{{ $item->account_number }}</small>
                                            </td>
                                            <td class="align-middle text-muted small">
                                                {{ $item->created_at->format('j M Y') }}
                                            </td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="py-5">
                                            <div class="text-center text-muted">
                                                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                                <p class="mb-0">No payment methods found.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if (method_exists($payments, 'links'))
                        <div class="card-footer bg-white border-0">
                            {{ $payments->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control:focus {
            border-color: #4e73df;
        }

        .table thead th {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-info {
            background-color: #eaf2fd;
            color: #4e73df;
            border: 1px solid #d1e3ff;
        }
    </style>
@endsection
