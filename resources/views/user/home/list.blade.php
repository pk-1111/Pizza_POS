@extends('user.layouts.master')

@section('content')
    <div class="container-fluid p-0">

        <!-- Hero Section -->
        <div class="container px-3 px-md-5 pt-4">
            <div class="card border-0 shadow-lg"
                style="background: linear-gradient(135deg, rgba(75, 26, 209, 0.15), rgba(0,0,0,0.3)); 
                   backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); 
                   border-radius: 35px; border: 1px solid rgba(255,255,255,0.05) !important;">
                <div class="card-body p-4 p-md-5">
                    <div class="row align-items-center">
                        <!-- Text Content -->
                        <div class="col-lg-4 text-center text-lg-start text-white">
                            <h4 class="fw-light mb-1" style="letter-spacing: 2px;">ENJOY YOUR</h4>
                            <h1 class="display-4 fw-bold mb-3">Delicious <span class="text-danger">Food</span></h1>
                            <p class="text-white-50 mb-4" style="font-size: 1.1rem;">Best choice for your happy moments,
                                delivered with love.</p>

                            <form action="{{ route('userList#details', 8) }}" method="get">
                                <button type="submit"
                                    class="btn btn-danger rounded-pill px-5 py-3 fw-bold shadow-lg border-0 transition-transform"
                                    style="letter-spacing: 1px;">
                                    ORDER NOW <i class="fa-solid fa-arrow-right ms-2"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Animated Pizza -->
                        <div class="col-lg-5 text-center my-5 my-lg-0">
                            @if ($veggiePizza)
                                <img src="{{ asset('product/' . $veggiePizza->image) }}" alt="Pizza"
                                    class="pizza_spin img-fluid" style="max-height: 380px;">
                            @endif
                        </div>

                        <!-- Discount Badge -->
                        <div class="col-lg-3 text-center text-lg-end">
                            <div class="d-inline-block p-4 rounded-4" style="background: rgba(255,255,255,0.05);">
                                <h1 class="fw-bold blink-text text-warning display-4 mb-0">30% OFF</h1>
                                <h5 class="fw-bold text-white-50 mt-2">DISCOUNT <span class="text-danger">ONLINE</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid Section -->
        <div class="container px-3 px-md-5 mt-5 pt-4">
            <div class="text-center mb-5">
                <h2 class="section-title text-white fw-bold display-6">Choose Our Best Taste</h2>
                <div class="mx-auto"
                    style="width: 80px; height: 3px; background: #dc3545; border-radius: 2px; margin-top: 15px;"></div>
            </div>

            <div class="row g-4">
                @foreach ($products as $item)
                    <div class="col-6 col-md-4 col-xl-3">
                        <div class="card h-100 fruite-item overflow-hidden"
                            style="background: rgba(20, 22, 28, 0.8); border-radius: 25px;">

                            <!-- Category Badge -->
                            <div class="position-absolute px-3 py-1 text-white fw-bold shadow-sm"
                                style="top: 15px; left: 15px; background: #dc3545; border-radius: 30px; z-index: 10; font-size: 0.7rem;">
                                {{ $item->category_name }}
                            </div>

                            <!-- Product Image -->
                            <div class="overflow-hidden" style="height: 180px; border-radius: 25px 25px 0 0;">
                                <a href="{{ route('userList#details', $item->id) }}">
                                    <img src="{{ str_contains($item->image, 'http') ? $item->image : asset('product/' . $item->image) }}"
                                        class="w-100 h-100 object-fit-cover" alt="{{ $item->name }}">
                                </a>
                            </div>

                            <!-- Product Details -->
                            <div class="card-body d-flex flex-column text-white p-4">
                                <h6 class="text-warning fw-bold mb-2">{{ $item->name }}</h6>
                                <p class="small text-white-50 mb-4" style="line-height: 1.4;">
                                    {{ Str::limit($item->description, 45) }}
                                </p>

                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <div>
                                        @if ($item->category_name == 'Vegetarian')
                                            <small class="text-white-50 text-decoration-line-through d-block"
                                                style="font-size: 0.75rem;">
                                                {{ number_format($item->price) }}
                                            </small>

                                            <span class="badge bg-danger rounded-pill">-30%</span>

                                            <span class="fw-bold fs-5 text-white">{{ number_format($item->price * 0.7) }}
                                                <small style="font-size: 0.7rem;">MMK</small></span>
                                        @else
                                            <span class="fw-bold fs-5 text-white">{{ number_format($item->price) }} <small
                                                    style="font-size: 0.7rem;">MMK</small></span>
                                        @endif


                                    </div>
                                    <a href="{{ route('userList#details', $item->id) }}"
                                        class="btn btn-outline-danger btn-sm rounded-circle p-2 transition-transform">
                                        <i class="fa-solid fa-plus px-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Special Menus Section -->
        <div class="container px-3 px-md-5 py-5 mt-5">
            <div class="card border-0 rounded-5 overflow-hidden shadow-lg">

                <div class="p-4 p-md-5" style="backdrop-filter: blur(8px);">
                    <h2 class="text-center text-info fw-bold mb-5 section-title">Our Special Menus</h2>

                    <div class="row g-4">
                        <!-- Card 1 -->
                        @php
                            $specials = [
                                ['img' => 'end_pizza.jpg', 'title' => 'Breakfast Specials'],
                                ['img' => 'end_pizza.jpg', 'title' => 'Lunch Specials'],
                                ['img' => 'end_pizza.jpg', 'title' => 'Cheese Pizza Combo'],
                            ];
                        @endphp

                        @foreach ($specials as $special)
                            <div class="col-md-4">
                                <div class="card delivery-card border-0 rounded-4 overflow-hidden h-100 shadow-lg"
                                    style="background: rgba(255,255,255,0.95);">
                                    <div class="overflow-hidden" style="height: 200px;">
                                        <img src="{{ asset('user/img/' . $special['img']) }}"
                                            class="w-full border-r-2  h-100 object-fit-cover">
                                    </div>
                                    <div class="card-body p-4">
                                        <h5 class="fw-bold text-dark">{{ $special['title'] }}</h5>
                                        <p class="text-muted small mb-4">Premium selection of our top-rated dishes crafted
                                            for your cravings.</p>
                                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3"
                                            style="background: #f8f9fa;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
