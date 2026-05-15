@extends('user.layouts.master')

@section('content')
    <style>
        /* Smooth transition for product cards */
        .product-card {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.5) !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
        }

        /* Sticky sidebar for better UX */
        .filter-sidebar {
            position: sticky;
            top: 20px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Custom Input styling */
        .glass-input {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            border-radius: 10px !important;
        }

        .glass-input::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.15) !important;
            box-shadow: 0 0 10px rgba(255, 193, 7, 0.3);
        }
    </style>

    <div class="container-fluid px-3 px-md-5 mt-5" style="margin-top: -95px;">
        <!-- Main Background Card -->
        <div class="card border-0 shadow-lg rounded-5 overflow-hidden"
            style="background-image: url('{{ asset('user/img/pizza_bg1-artguru.png') }}'); 
               background-attachment: fixed;
               background-position: center; 
               background-size: cover;">

            <!-- Dark Overlay Layer -->
            <div class="card-body"
                style="background: linear-gradient(135deg, rgba(20, 10, 40, 0.8), rgba(0, 0, 0, 0.7)); padding: 40px;">

                <div class="container-fluid">
                    <!-- Header Row -->
                    <div class="row g-4 align-items-center mb-5">
                        <div class="col-lg-6">
                            <h1 class="display-4 fw-bold text-white mb-0">Experience <span
                                    class="text-warning">Premium</span> Pizza</h1>
                            <p class="text-white-50 mt-2">Discover our curated selection of handcrafted flavors.</p>
                        </div>
                        <div class="col-lg-6 text-lg-end">
                            <nav class="d-inline-flex p-2 rounded-pill shadow-sm"
                                style="background: rgba(255,255,255,0.1);">
                                <a class="btn btn-warning rounded-pill px-4 fw-bold" href="">All Menu</a>
                                <a class="btn text-white px-4" href="">Favorites</a>
                            </nav>
                        </div>
                    </div>

                    <div class="row g-4">
                        <!-- Sidebar (Filter & Search) -->
                        <div class="col-12 col-lg-3">
                            <div class="filter-sidebar p-4 shadow-sm">
                                <h5 class="text-warning mb-4"><i class="fa-solid fa-filter me-2"></i>Filters</h5>

                                <input type="hidden" name="searchKey" value="{{ request('searchKey') }}">
                                <input type="hidden" name="minPrice" value="{{ request('minPrice') }}">
                                <input type="hidden" name="maxPrice" value="{{ request('maxPrice') }}">

                                <!-- Search -->
                                <form action="{{ route('shop#sortingType') }}" method="get" class="mb-4">
                                    @csrf
                                    <div class="input-group shadow-sm">
                                        <input type="text" name="searchKey" value="{{ request('searchKey') }}"
                                            class="form-control glass-input border-0" placeholder="Find a pizza...">
                                        <button type="submit" class="btn btn-warning border-0">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>

                                <hr class="border-secondary opacity-25">

                                <!-- Price Filter -->
                                <div class="mt-4">
                                    <label class="text-white-50 small fw-bold mb-2 uppercase">Budget Range</label>
                                    <form action="{{ route('shop#sortingType') }}" method="get">
                                        @csrf
                                        <input type="number" value="{{ request('minPrice') }}" name="minPrice"
                                            placeholder="Min MMK" class="form-control glass-input mb-2">
                                        <input type="number" value="{{ request('maxPrice') }}" name="maxPrice"
                                            placeholder="Max MMK" class="form-control glass-input mb-3">
                                        <button type="submit"
                                            class="btn btn-outline-warning w-100 rounded-pill btn-sm fw-bold">Set
                                            Range</button>
                                    </form>
                                </div>

                                <!-- Sorting -->
                                <div class="mt-4">
                                    <label class="text-white-50 small fw-bold mb-2 uppercase">Sort Results</label>


                                    <form action="{{ route('shop#sortingType') }}" method="get">
                                        <select name="sortingType" class="form-select glass-input border-0 mb-3">
                                            <option value="name,asc"
                                                {{ request('sortingType') == 'name,asc' ? 'selected' : '' }}>A - Z</option>
                                            <option value="name,desc"
                                                {{ request('sortingType') == 'name,desc' ? 'selected' : '' }}>Z - A
                                            </option>
                                            <option value="price,asc"
                                                {{ request('sortingType') == 'price,asc' ? 'selected' : '' }}>Price: Low to
                                                High</option>
                                            <option value="price,desc"
                                                {{ request('sortingType') == 'price,desc' ? 'selected' : '' }}>Price: High
                                                to Low</option>
                                        </select>
                                        <button type="submit"
                                            class="btn btn-success w-100 rounded-pill btn-sm fw-bold shadow">Apply
                                            Sort</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Product Grid Area -->
                        <div class="col-12 col-lg-9">
                            <div class="row g-4">
                                @foreach ($products as $item)
                                    <div class="col-sm-6 col-md-4 col-xl-4">
                                        <div class="product-card card h-100 bg-transparent overflow-hidden rounded-4">
                                            <!-- Image Container -->
                                            <div class="position-relative overflow-hidden">
                                                <a href="{{ route('userList#details', $item->id) }}">
                                                    <img src="{{ str_contains($item->image, 'http') ? $item->image : asset('product/' . $item->image) }}"
                                                        style="height: 240px; object-fit: cover;"
                                                        class="img-fluid w-100 card-img-top" alt="{{ $item->name }}">
                                                </a>
                                                <!-- Floating Badge -->
                                                <div class="position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill text-white shadow-sm"
                                                    style="background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.2); font-size: 0.8rem;">
                                                    <i class="fa-solid fa-tag me-1 text-warning"></i>
                                                    {{ $item->category_name }}
                                                </div>
                                            </div>

                                            <!-- Content -->
                                            <div class="card-body d-flex flex-column p-4"
                                                style="background: rgba(0,0,0,0.4);">
                                                <h5 class="text-white fw-bold mb-2">{{ $item->name }}</h5>
                                                <p class="text-white-50 small flex-grow-1">
                                                    {{ Str::limit($item->description, 60) }}
                                                </p>

                                                <div class="d-flex justify-content-between align-items-end mt-3">
                                                    <div>
                                                        @if ($item->category_name == 'Vegetarian')
                                                            <small
                                                                class="text-danger text-decoration-line-through">{{ number_format($item->price) }}</small>
                                                            <div class="text-warning fw-bold fs-4">
                                                                {{ number_format($item->price * 0.7) }} <span
                                                                    class="fs-6">MMK</span></div>

                                                            <span class="badge bg-danger rounded-pill">-30%</span>
                                                        @else
                                                            <div class="text-white fw-bold fs-4">
                                                                {{ number_format($item->price) }} <span
                                                                    class="fs-6">MMK</span></div>
                                                        @endif
                                                    </div>


                                                </div>

                                                <a href="{{ route('userList#details', $item->id) }}"
                                                    class="btn btn-outline-light btn-sm mt-3 rounded-pill">
                                                    View Product
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div> <!-- End Product Grid -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
