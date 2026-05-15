@extends('admin.layouts.master')

{{-- @section('content')
    <div class="container-fluid pb-5">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Create New Product</h1>
            <a href="{{ route('List#productsList') }}" class="btn btn-sm btn-outline-primary shadow-sm">
                <i class="fas fa-list fa-sm mr-1"></i> Back to Product List
            </a>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-body p-lg-5">
                        <form action="{{ route('products#addProductsCreate') }}" method="post"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <!-- Left Column: Image Upload -->
                                <div class="col-md-4 text-center border-right">
                                    <label class="form-label font-weight-bold mb-3 d-block text-primary">Product
                                        Image</label>

                                    <div class="image-preview-container mb-3 shadow-sm rounded bg-light d-flex align-items-center justify-content-center overflow-hidden"
                                        style="height: 250px; border: 2px dashed #d1d3e2;">
                                        <img class="img-fluid" id="output"
                                            src="{{ asset('admin/img/undraw_profile.svg') }}"
                                            style="max-height: 100%; object-fit: cover;">
                                    </div>

                                    <div class="custom-file mb-2">
                                        <input type="file" name="image"
                                            class="custom-file-input @error('image') is-invalid @enderror"
                                            id="productImageInput" onchange="loadFile(event)">
                                        <label class="custom-file-label text-left small" for="productImageInput">Choose
                                            photo</label>
                                        @error('image')
                                            <small class="invalid-feedback text-left">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <p class="text-muted small italic text-left">* Recommended size: 500x500px (JPG/PNG)</p>
                                </div>

                                <!-- Right Column: Product Details -->
                                <div class="col-md-8 pl-md-4 mt-4 mt-md-0">
                                    <h5 class="text-dark font-weight-bold mb-4 border-bottom pb-2">General Information</h5>

                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label small font-weight-bold">Product Name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control bg-light border-0 shadow-none @error('name') is-invalid @enderror"
                                                placeholder="e.g. Premium Coffee Bean">
                                            @error('name')
                                                <small class="invalid-feedback font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label small font-weight-bold">Category <span
                                                    class="text-danger">*</span></label>
                                            <select name="categoryId"
                                                class="form-control bg-light border-0 shadow-none @error('categoryId') is-invalid @enderror">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $item)
                                                    <option value="{{ $item->category_id }}"
                                                        @if (old('categoryId') == $item->category_id) selected @endif>
                                                        {{ $item->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('categoryId')
                                                <small class="invalid-feedback font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label small font-weight-bold">Initial Stock <span
                                                    class="text-danger">*</span></label>
                                            <input type="number" name="stock" value="{{ old('stock') }}"
                                                class="form-control bg-light border-0 shadow-none @error('stock') is-invalid @enderror"
                                                placeholder="0">
                                            @error('stock')
                                                <small class="invalid-feedback font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label small font-weight-bold">Base Price (MMK) <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="price" value="{{ old('price') }}"
                                                class="form-control bg-light border-0 shadow-none @error('price') is-invalid @enderror"
                                                placeholder="0.00">
                                            @error('price')
                                                <small class="invalid-feedback font-weight-bold">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label small font-weight-bold">Discount Rate (%)</label>
                                            <input type="number" name="rate" value="{{ old('rate') }}"
                                                class="form-control bg-light border-0 shadow-none" placeholder="e.g. 10">
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label small font-weight-bold">Product Description</label>
                                        <textarea name="description" rows="5"
                                            class="form-control bg-light border-0 shadow-none @error('description') is-invalid @enderror"
                                            placeholder="Tell customers more about this product...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <small class="invalid-feedback font-weight-bold">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="reset"
                                            class="btn btn-light px-4 mr-2 shadow-sm font-weight-bold">Reset</button>
                                        <button type="submit" class="btn btn-primary px-5 shadow-sm font-weight-bold">
                                            <i class="fas fa-plus mr-1"></i> Create Product
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-control:focus {
            background-color: #fff !important;
            border: 1px solid #4e73df !important;
        }

        .custom-file-label::after {
            content: "Browse";
            background-color: #4e73df;
            color: white;
        }

        .border-right {
            border-right: 1px solid #eaecf4 !important;
        }

        @media (max-width: 768px) {
            .border-right {
                border-right: none !important;
                border-bottom: 1px solid #eaecf4;
                padding-bottom: 20px;
            }
        }
    </style>
@endsection --}}








@section('content')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column"
        style="background-color: #f8f9fc; min-height: 100vh; padding: 40px 0;">

        <!-- Main Content -->
        <div id="content">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-12">
                        <div class="card border-0 shadow-lg rounded-lg">
                            <div class="card-header bg-white py-3">
                                <h5 class="m-0 font-weight-bold text-primary text-center">Create New Product</h5>
                            </div>

                            <form action="{{ route('products#addProductsCreate') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="card-body p-4">
                                    <div class="row">
                                        <!-- Image Upload Section -->
                                        <div class="col-md-4 text-center border-right">
                                            <div class="mb-4">
                                                <label class="form-label d-block font-weight-bold text-dark">Product
                                                    Image</label>
                                                <div class="image-preview-container mb-3"
                                                    style="height: 200px; background: #f1f1f1; display: flex; align-items: center; justify-content: center; border-radius: 10px; overflow: hidden; border: 2px dashed #ddd;">
                                                    <img class="img-fluid" id="output"
                                                        src="https://via.placeholder.com/200x200?text=No+Image"
                                                        style="max-height: 100%; object-fit: cover;">
                                                </div>

                                                <div class="custom-file text-left">
                                                    <input type="file" name="image" id="imageInput"
                                                        class="form-control-file @error('image') is-invalid @enderror"
                                                        onchange="loadFile(event)">

                                                    @error('image')
                                                        <small class="invalid-feedback d-block">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <small class="text-muted mt-2 d-block">Recommended size: 500x500 px</small>
                                            </div>
                                        </div>

                                        <!-- Form Details Section -->
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label font-weight-bold text-dark">Product
                                                        Name</label>
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control shadow-sm @error('name') is-invalid @enderror"
                                                        placeholder="Enter Product...">
                                                    @error('name')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label font-weight-bold text-dark">Category
                                                        Name</label>
                                                    <select name="categoryId" id=""
                                                        class="form-control shadow-sm custom-select @error('categoryId') is-invalid @enderror">
                                                        <option value="">Choose Category...</option>
                                                        @foreach ($categories as $item)
                                                            <option value="{{ $item->category_id }}"
                                                                @if (old('categoryId') == $item->category_id) selected @endif>
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
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label font-weight-bold text-dark">Price (Ks)</label>
                                                    <input type="text" name="price" value="{{ old('price') }}"
                                                        class="form-control shadow-sm @error('price') is-invalid @enderror"
                                                        placeholder="0.00">
                                                    @error('price')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label font-weight-bold text-dark">Stock
                                                        Quantity</label>
                                                    <input type="text" name="stock" value="{{ old('stock') }}"
                                                        class="form-control shadow-sm @error('stock') is-invalid @enderror"
                                                        placeholder="0">
                                                    @error('stock')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label class="form-label font-weight-bold text-dark">Discount
                                                        (%)</label>
                                                    <input type="number" name="rate" class="form-control shadow-sm"
                                                        placeholder="0">
                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label font-weight-bold text-dark">Product
                                                    Description</label>
                                                <textarea name="description" id="" cols="30" rows="5"
                                                    class="form-control shadow-sm @error('description') is-invalid @enderror"
                                                    placeholder="Describe your product details here...">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>

                                            <div class="text-right">
                                                <hr>
                                                <button type="submit"
                                                    class="btn btn-primary px-5 py-2 shadow-sm rounded-pill font-weight-bold">
                                                    <i class="fas fa-plus-circle mr-2"></i> Create Product
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

        </div>
    </div>
@endsection


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
