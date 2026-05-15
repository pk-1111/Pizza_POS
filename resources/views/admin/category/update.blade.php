@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="mb-4 d-flex align-items-center">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Edit Category</h1>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">

                <!-- Back Button -->
                <div class="mb-3">
                    <a href="{{ route('category#listCategory') }}"
                        class="btn btn-sm btn-light text-primary border shadow-sm px-3">
                        <i class="fas fa-arrow-left mr-1"></i> Back to List
                    </a>
                </div>

                <!-- Update Form Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom-0">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-edit mr-2"></i> Update Category Information
                        </h6>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <form action="{{ route('category#updatePage', $category->category_id) }}" method="post">
                            @csrf

                            <div class="form-group">
                                <label class="small font-weight-bold text-dark">Category Name</label>
                                <input type="text" value="{{ old('categoryName', $category->title) }}"
                                    class="form-control bg-light border-0 py-4 @error('categoryName') is-invalid @enderror"
                                    name="categoryName" placeholder="Enter new category name...">

                                @error('categoryName')
                                    <small class="invalid-feedback font-weight-bold">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary btn-block shadow-sm py-2">
                                    <i class="fas fa-sync-alt mr-1"></i> Update Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Meta Info (Optional) -->
                <div class="text-center mt-3">
                    <small class="text-muted italic">
                        Category ID: <span class="font-weight-bold">#{{ $category->category_id }}</span>
                        | Last Updated: {{ $category->updated_at->diffForHumans() }}
                    </small>
                </div>

            </div>
        </div>
    </div>

    <style>
        .form-control:focus {
            box-shadow: none;
            background-color: #fff !important;
            border: 1px solid #4e73df !important;
        }

        .btn-light:hover {
            background-color: #f8f9fa;
            transform: translateY(-1px);
        }
    </style>
@endsection
