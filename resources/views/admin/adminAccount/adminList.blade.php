@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4 py-4">
        <!-- Header Section -->
        <div class="row align-items-center mb-4">
            <div class="col">
                <h3 class="fw-bold text-gray-800 m-0" style="font-weight: 700;">Admin Management</h3>
                <p class="text-muted small mb-0">Overview of all administrative accounts and their access levels.</p>
            </div>
            <div class="col-auto">
                <div class="card border-0 shadow-sm px-3 py-2 bg-white rounded-lg">
                    <span class="text-muted small font-weight-bold">Total Accounts:
                        <span class="text-primary h5 mb-0 ml-2">{{ $admin->total() }}</span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Search & Action Bar -->
        <div class="card border-0 shadow-sm mb-4 rounded-lg overflow-hidden">
            <div class="card-body bg-white">
                <div class="row g-3 align-items-center">
                    <div class="col-md">
                        <a href="{{ route('profile#adminList') }}"
                            class="btn btn-outline-primary border shadow-sm px-4 rounded-pill">
                            <i class="fas fa-sync-alt mr-2"></i> Refresh List
                        </a>
                    </div>
                    <div class="col-md-5">
                        <form action="{{ route('profile#adminList') }}" method="get">
                            <div class="input-group shadow-sm border rounded-pill overflow-hidden">
                                <span class="input-group-text border-0 bg-white pl-3">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" name="searchKey" value="{{ request('searchKey') }}"
                                    class="form-control border-0 py-2" placeholder="Search by name or email...">
                                <button type="submit" class="btn btn-primary px-4">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modern Table Container -->
        <div class="card border-0 shadow-sm rounded-lg overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase font-weight-bold">
                        <tr>
                            <th class="px-4 py-3 border-0">Admin Profile</th>
                            <th class="py-3 border-0">Contact Information</th>
                            <th class="py-3 border-0 text-center">Role</th>
                            <th class="py-3 border-0 text-center">Platform</th>
                            <th class="py-3 border-0">Joined Date</th>
                            <th class="py-3 border-0 text-right px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($admin as $item)
                            <tr class="border-bottom">
                                <!-- Profile Column -->
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle mr-3 shadow-sm d-flex align-items-center justify-content-center bg-primary-soft text-primary font-weight-bold"
                                            style="width: 42px; height: 42px; border-radius: 50%; background: #eef2ff; border: 1px solid #e0e7ff;">
                                            {{ strtoupper(substr($item->name, 0, 1)) }}
                                        </div>
                                        <div style="white-space: nowrap;">
                                            <div class="font-weight-bold text-dark mb-0">{{ $item->name }}</div>
                                            <div class="text-muted" style="font-size: 11px;">ID: {{ $item->id }}</div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Contact Column -->
                                <td class="py-3" style="white-space: nowrap; min-width: 200px;">
                                    <div class="d-flex align-items-center mb-1">
                                        <i class="fa-solid fa-envelope text-primary mr-2"
                                            style="width: 14px; font-size: 13px;"></i>
                                        <span class="text-dark font-weight-500"
                                            style="font-size: 13.5px;">{{ $item->email }}</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <i class="fa-solid fa-phone text-success mr-2"
                                            style="width: 14px; font-size: 13px;"></i>
                                        <span class="text-muted"
                                            style="font-size: 13px;">{{ $item->phone ?: 'Not provided' }}</span>
                                    </div>
                                </td>

                                <!-- Role Column -->
                                <td class="py-3 text-center">
                                    @if ($item->role == 'superadmin')
                                        <span
                                            class="badge badge-pill px-3 py-2 text-danger bg-danger-soft border border-danger"
                                            style="background: #fff5f5; font-size: 11px;">
                                            SUPER ADMIN
                                        </span>
                                    @else
                                        <span class="badge badge-pill px-3 py-2 text-info bg-info-soft border border-info"
                                            style="background: #f0f9ff; font-size: 11px;">
                                            ADMIN
                                        </span>
                                    @endif
                                </td>

                                <!-- Platform Column -->
                                <td class="py-3 text-center">
                                    @if ($item->provider == 'google')
                                        <span class="small border rounded px-2 py-1 bg-light shadow-xs">
                                            <i class="fab fa-google text-danger mr-1"></i> Google
                                        </span>
                                    @else
                                        <span class="small border rounded px-2 py-1 bg-light shadow-xs">
                                            <i class="fas fa-desktop text-secondary mr-1"></i> System
                                        </span>
                                    @endif
                                </td>

                                <!-- Date Column -->
                                <td class="py-3 small text-muted" style="white-space: nowrap;">
                                    {{ $item->created_at->format('M d, Y') }}
                                </td>

                                <!-- Actions Column -->
                                <td class="py-3 text-right px-4">
                                    @if ($item->role != 'superadmin' && Auth::user()->id != $item->id)
                                        <a href="{{ route('profile#delete', $item->id) }}"
                                            class="btn btn-sm btn-light text-danger border rounded-circle shadow-sm p-2 hover-delete"
                                            onclick="return confirm('Confirm account deletion?')">
                                            <i class="fas fa-trash-alt mx-1"></i>
                                        </a>
                                    @else
                                        <span class="text-muted small"><i class="fas fa-lock"></i> Locked</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Custom Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="small text-muted font-weight-500">
                Showing records <span class="text-dark">{{ $admin->firstItem() }}-{{ $admin->lastItem() }}</span> of
                {{ $admin->total() }}
            </div>
            <div class="pagination-modern">
                {{ $admin->appends(request()->query())->links() }}
            </div>
        </div>
    </div>

    <style>
        /* UI Typography & Spacing */
        body {
            background-color: #f8f9fc;
        }

        .font-weight-500 {
            font-weight: 500;
        }

        /* Table Enhancements */
        .table thead th {
            border: none;
            letter-spacing: 0.5px;
        }

        .table td {
            vertical-align: middle !important;
            border-top: 1px solid #f2f4f8;
        }

        .table-hover tbody tr:hover {
            background-color: #fbfcfe !important;
        }

        /* Utility Styles */
        .bg-primary-soft {
            background-color: #eef2ff !important;
        }

        .shadow-xs {
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .hover-delete:hover {
            background-color: #ffeded !important;
            color: #dc3545 !important;
            border-color: #ffc1c1 !important;
        }

        /* Pagination Styling Fix */
        .pagination-modern .pagination {
            margin-bottom: 0;
        }

        .pagination-modern .page-link {
            border: none;
            margin: 0 2px;
            border-radius: 6px !important;
            color: #4e73df;
            padding: 8px 14px;
        }

        .pagination-modern .page-item.active .page-link {
            background-color: #4e73df;
            color: #fff;
            box-shadow: 0 4px 6px rgba(78, 115, 223, 0.2);
        }
    </style>
@endsection
