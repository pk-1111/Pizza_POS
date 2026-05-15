@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4 py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Header Actions -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Edit Product</h1>
                    <a href="{{ route('List#productsList') }}" class="btn btn-sm btn-light border shadow-sm text-dark px-3">
                        <i class="fa-solid fa-arrow-left-long mr-1"></i> Back to List
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-lg">
                    <form action="{{ route('product#update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="oldPhoto" value="{{ $product->image }}">
                        <input type="hidden" name="productId" value="{{ $product->id }}">

                        <div class="card-body p-lg-5">
                            <div class="row">
                                <!-- Left Side: Image Upload & Preview -->
                                <div class="col-md-4 text-center border-right">
                                    <label
                                        class="form-label font-weight-bold mb-3 d-block text-muted small text-uppercase">Product
                                        Image</label>
                                    <div
                                        class="image-upload-wrapper mb-3 position-relative d-inline-block shadow-sm rounded">
                                        <img class="img-fluid rounded" id="output"
                                            src="{{ asset('product/' . $product->image) }}"
                                            style="width: 100%; height: 250px; object-fit: cover;">
                                        <div class="image-overlay">
                                            <i class="fas fa-camera text-white"></i>
                                        </div>
                                    </div>
                                    <div class="custom-file text-left mt-2">
                                        <input type="file" name="image"
                                            class="custom-file-input @error('image') is-invalid @enderror" id="imageInput"
                                            onchange="loadFile(event)">
                                        <label class="custom-file-label text-truncate" for="imageInput">Change
                                            photo...</label>
                                        @error('image')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Side: Form Fields -->
                                <div class="col-md-8 pl-md-5">
                                    <div class="row">
                                        <!-- Product Name -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-dark font-weight-bold small">Product Name</label>
                                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                                class="form-control @error('name') is-invalid @enderror shadow-none"
                                                placeholder="e.g. Spicy Ramen">
                                            @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Category -->
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label text-dark font-weight-bold small">Category</label>
                                            <select name="categoryId"
                                                class="form-control @error('categoryId') is-invalid @enderror shadow-none">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->category_id }}"
                                                        @if (old('categoryId', $product->category_id) == $item->category_id) selected @endif>
                                                        {{ $item->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('categoryId')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Price -->
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label text-dark font-weight-bold small">Price (MMK)</label>
                                            <div class="input-group">
                                                <input type="number" name="price"
                                                    value="{{ old('price', $product->price) }}"
                                                    class="form-control @error('price') is-invalid @enderror shadow-none">
                                            </div>
                                            @error('price')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Stock -->
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label text-dark font-weight-bold small">Stock
                                                Quantity</label>
                                            <input type="number" name="stock"
                                                value="{{ old('stock', $product->stock) }}"
                                                class="form-control @error('stock') is-invalid @enderror shadow-none">
                                            @error('stock')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <!-- Discount Rate -->
                                        <div class="col-md-4 mb-3">
                                            <label class="form-label text-dark font-weight-bold small">Discount (%)</label>
                                            <input type="number" name="rate" value="{{ old('rate', $product->rate) }}"
                                                class="form-control shadow-none" placeholder="0">
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-4">
                                        <label class="form-label text-dark font-weight-bold small">Detailed
                                            Description</label>
                                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror shadow-none"
                                            placeholder="Tell more about the product...">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <small class="invalid-feedback">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <!-- Submit Buttons -->
                                    <div class="d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary px-5 shadow-sm rounded-pill font-weight-bold">
                                            Update Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control {
            border-radius: 8px;
            border: 1px solid #e3e6f0;
            padding: 0.6rem 1rem;
        }

        .form-control:focus {
            border-color: #4e73df;
            background-color: #f8f9fc;
        }

        .image-upload-wrapper {
            width: 100%;
            max-width: 280px;
            overflow: hidden;
            background: #f8f9fc;
            border: 2px solid #eaecf4;
        }

        .custom-file-label::after {
            content: "Browse";
            background-color: #4e73df;
            color: white;
        }
    </style>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
            // Update filename label
            var fileName = event.target.files[0].name;
            var label = document.querySelector('.custom-file-label');
            label.innerText = fileName;
        };
    </script>
@endsection
