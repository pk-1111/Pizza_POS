@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4">
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">Category Management</h1>
            <p class="text-muted small">Create and manage your product categories here.</p>
        </div>

        <div class="row">
            <!-- Create Category Form -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus-circle mr-2"></i>New Category</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('category#create') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="small font-weight-bold text-dark">Name</label>
                                <input type="text"
                                    class="form-control bg-light border-0 py-4 @error('categoryName') is-invalid @enderror"
                                    value="{{ old('categoryName') }}" name="categoryName"
                                    placeholder="Enter category name...">

                                @error('categoryName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-block shadow-sm py-2 mt-2">
                                <i class="fas fa-save mr-1"></i> Create Category
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Category List Table -->
            <div class="col-lg-8 col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 px-4">
                                            ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Dates</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($categories) != 0)
                                        @foreach ($categories as $item)
                                            <tr class="border-bottom">
                                                <td class="px-4">
                                                    <span class="text-xs font-weight-bold">{{ $item['category_id'] }}</span>
                                                </td>
                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0 text-dark">{{ $item['title'] }}
                                                    </p>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-column">
                                                        <span class="text-xs text-muted">Created:
                                                            {{ $item->created_at->format('j M Y') }}</span>
                                                        <span class="text-xs text-info">Updated:
                                                            {{ $item->updated_at->format('j M Y') }}</span>
                                                    </div>
                                                </td>
                                                <td class="text-right px-4">
                                                    <div class="btn-group">
                                                        <a href="{{ route('category#updatePage', $item['category_id']) }}"
                                                            class="btn btn-sm btn-light text-primary border shadow-sm mr-2"
                                                            title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('category#delete', $item['category_id']) }}"
                                                            class="btn btn-sm btn-light text-danger border shadow-sm"
                                                            title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center py-5">
                                                <div class="d-flex flex-column align-items-center">
                                                    <i class="fas fa-folder-open fa-3x text-light mb-3"></i>
                                                    <h5 class="text-muted">No Categories Found</h5>
                                                    <p class="text-muted small">Start by creating a new category using the
                                                        form on the left.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="mt-3 d-flex justify-content-end">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        .table td,
        .table th {
            vertical-align: middle;
        }

        .text-xxs {
            font-size: 0.7rem;
        }

        .btn-light:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
        }

        .form-control:focus {
            box-shadow: none;
            border: 1px solid #4e73df;
        }
    </style>
@endsection
