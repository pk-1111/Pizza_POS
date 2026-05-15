@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <!-- Page Header & Search Section -->
        <div class="d-flex justify-content-between align-items-center my-4">
            <div>
                <h4 class="m-0 font-weight-bold text-primary">User List</h4>
            </div>
            <div class="d-flex shadow-sm">
                <form action="{{ route('userListPage') }}" method="get" class="d-flex">
                    @csrf
                    <div class="input-group shadow-sm">
                        <input type="text" name="searchKey" value="{{ request('searchKey') }}"
                            class="form-control border-0 px-3" placeholder="Search products..." style="width: 250px;">
                        <button type="submit" class="btn btn-dark px-3">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover text-center mb-0">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="py-3">ID</th>
                                <th class="py-3">Name</th>
                                <th class="py-3">Email</th>
                                <th class="py-3">Phone</th>
                                <th class="py-3">Address</th>
                                <th class="py-3">Role</th>
                                <th class="py-3">Created Date</th>
                                <th class="py-3">Platform</th>
                                <th class="py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr class="align-middle">
                                    <td class="align-middle">#{{ $item['id'] }}</td>
                                    <td class="align-middle font-weight-bold text-dark">{{ $item['name'] }}</td>
                                    <td class="align-middle">{{ $item['email'] }}</td>
                                    <td class="align-middle">{{ $item['phone'] ?? '-' }}</td>
                                    <td class="align-middle text-truncate" style="max-width: 150px;">
                                        {{ $item['address'] ?? '-' }}
                                    </td>
                                    <td class="align-middle">
                                        <span class="badge badge-danger px-2 py-1">{{ $item['role'] }}</span>
                                    </td>
                                    <td class="align-middle text-muted small">
                                        {{ $item->created_at->format('j M Y') }}
                                    </td>
                                    <td class="align-middle text-capitalize text-info">
                                        @if ($item->provider == 'google')
                                            <i class="fa-brands fa-google mr-1"></i> Google
                                        @else
                                            <i class="fa-solid fa-user-shield mr-1"></i> Simple
                                        @endif
                                    </td>
                                    <td class="align-middle">

                                        <a href="" class="btn btn-sm btn-outline-danger shadow-sm"
                                            onclick="return confirm('Are you sure you want to delete this admin?')">
                                            <i class="fas fa-trash"></i>
                                        </a>



                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination Section -->
        <div class="mt-3 d-flex justify-content-end">
            {{ $user->appends(request()->query())->links() }}
        </div>
    </div>
@endsection
