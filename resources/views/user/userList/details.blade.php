@extends('user.layouts.master')

@section('content')
    <style>
        /* UI Enhancements */
        body {
            background-color: #f8f9fa;
        }

        .detail-container {
            background-color: #ffffff;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
        }

        .product-img-box {
            transition: transform 0.5s ease;
            overflow: hidden;
            border-radius: 20px;
            border: 1px solid #f1f1f1;
        }

        .product-img-box:hover img {
            transform: scale(1.05);
        }

        .nav-tabs .nav-link {
            color: #6c757d;
            border: none;
            padding: 12px 25px;
            font-weight: 600;
        }

        .nav-tabs .nav-link.active {
            background: none !important;
            color: #000 !important;
            border-bottom: 3px solid #ffc107 !important;
        }

        .qty-box {
            background: #f1f3f5;
            border-radius: 50px;
            border: 1px solid #e9ecef;
        }

        /* Related Product Card Styling */
        .related-product-card {
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
            background: #fff;
            border: 1px solid #eee;
        }

        .related-product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .rating-css input {
            display: none;
        }

        .rating-css label {
            color: #ddd;
            font-size: 30px;
            cursor: pointer;
        }

        .rating-css input:checked~label,
        .rating-css label:hover,
        .rating-css label:hover~label {
            color: #f1c40f;
        }
    </style>

    <div class="container-fluid py-5 mt-5">
        <div class="container py-5 detail-container p-4 p-md-5">
            <!-- Breadcrumb -->
            <div class="mb-4">
                <a href="{{ route('userHome') }}" class="text-muted text-decoration-none">Home</a>
                <i class="mx-2 fa-solid fa-angle-right text-warning" style="font-size: 0.8rem;"></i>
                <span class="text-dark fw-bold">Product Details</span>
            </div>

            <div class="row g-5 mb-5">
                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="product-img-box shadow-sm">
                        <img src="{{ asset('product/' . $product->image) }}" class="img-fluid w-100"
                            style="height: 450px; object-fit: cover;" alt="{{ $product->name }}">
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <h2 class="fw-bold text-dark mb-1">{{ $product->name }}</h2>
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-danger bg-opacity-10 text-white border border-danger border-opacity-10 me-3">
                            <i class="fa-solid fa-fire me-1"></i> {{ $product->available_item }} left
                        </span>
                        <span class="text-muted small">Category: <b
                                class="text-primary">{{ $product->category_name }}</b></span>
                    </div>

                    <hr class="my-4 opacity-50">

                    <!-- Price Section -->
                    <div class="my-4">
                        @if ($product->category_name == 'Vegetarian')
                            <h5 class="text-muted text-decoration-line-through mb-1 small">
                                {{ number_format($product->price) }} MMK</h5>
                            <div class="d-flex align-items-center">
                                <h2 class="fw-bold text-success mb-0 me-3">{{ number_format($product->price * 0.7) }} MMK
                                </h2>
                                <span class="badge bg-success text-white py-2 px-3 rounded-pill">30% OFF</span>
                            </div>
                        @else
                            <h2 class="fw-bold text-dark">{{ number_format($product->price) }} MMK</h2>
                        @endif
                    </div>

                    <!-- Rating & Views -->
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fa fa-star {{ $i <= $rating ? 'text-warning' : 'text-light' }}"></i>
                            @endfor
                            <span class="ms-2 text-dark fw-bold">({{ $rating }}/5)</span>
                        </div>
                        <div class="text-muted border-start ps-4">
                            <i class="fa-solid fa-eye text-info me-2"></i> {{ $view_count }} Views
                        </div>
                    </div>

                    <p class="text-secondary mb-4 lh-lg">{{ $product->description }}</p>

                    <!-- Form Buttons -->
                    <form action="{{ route('userList#addToCart') }}" method="post">
                        @csrf
                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="productId" value="{{ $product->id }}">

                        <div class="d-flex align-items-center flex-wrap gap-3">
                            <div class="input-group qty-box" style="width: 130px;">
                                <button type="button" class="btn btn-minus text-dark border-0"><i
                                        class="fa fa-minus"></i></button>
                                <input type="text" name="count" id="quantity"
                                    class="form-control bg-transparent border-0 text-center fw-bold" value="1">
                                <button type="button" class="btn btn-plus text-dark border-0"><i
                                        class="fa fa-plus"></i></button>
                            </div>
                            <button type="submit" class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow">
                                <i class="fa fa-shopping-bag me-2 text-warning"></i> Add to cart
                            </button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-bold">
                                <i class="fa-solid fa-star me-2 text-warning"></i> Rate
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabs Section (Reviews) -->
            <div class="row mt-5">
                <div class="col-12">
                    <nav>
                        <div class="nav nav-tabs mb-4">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#nav-about">Description</button>
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-comments">
                                Reviews <span class="badge bg-dark text-white ms-1">{{ count($comment) }}</span>
                            </button>
                        </div>
                    </nav>
                    <div class="tab-content">
                        <div class="tab-pane fade show active p-3" id="nav-about">
                            <p class="text-secondary lh-lg">{{ $product->description }}</p>
                        </div>
                        <div class="tab-pane fade" id="nav-comments">
                            @forelse ($comment as $item)
                                <div class="p-3 mb-3 bg-white shadow-sm rounded-4 border border-light">
                                    <div class="d-flex">
                                        <!-- User Profile Photo -->
                                        <img src="{{ $item->user_profile ? (str_contains($item->user_profile, 'http') ? $item->user_profile : asset('profile/' . $item->user_profile)) : asset('admin/img/undraw_profile.svg') }}"
                                            style="width: 45px; height: 45px; object-fit: cover;"
                                            class="rounded-circle shadow-sm me-3 border" alt="User">

                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <!-- User Name -->
                                                    <h6 class="fw-bold mb-0 text-dark">{{ $item->user_name }}</h6>
                                                    <!-- Comment Date -->
                                                    <small class="text-muted" style="font-size: 12px;">
                                                        <i class="fa-regular fa-clock me-1"></i>
                                                        {{ $item->created_at->format('j-F-Y / h:i A') }}
                                                    </small>
                                                </div>

                                                <!-- Edit & Delete Buttons (Show only for owner) -->
                                                @if (Auth::check() && $item->user_id == Auth::user()->id)
                                                    <div class="d-flex gap-2">
                                                        <button class="btn btn-sm btn-outline-primary border-0 edit-btn"
                                                            data-id="{{ $item->id }}"
                                                            data-message="{{ $item->message }}">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </button>
                                                        <a href="{{ route('userList#deleteComment', $item->id) }}"
                                                            class="btn btn-sm btn-outline-danger border-0">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Comment Message -->
                                            <p class="mt-2 text-secondary mb-0" style="line-height: 1.6;">
                                                {{ $item->message }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <div class="text-center py-4">
                                    <p class="text-muted">No reviews yet. Be the first to share your thoughts!</p>
                                </div>
                            @endforelse
                        </div>

                        <form action="{{ route('userList#comment') }}" method="post">
                            @csrf
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <input type="hidden" name="commentId" id="editCommentId">
                            <h4 class="mb-5 fw-bold">Leave a Comments</h4>
                            <div class="row g-1">
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded ">

                                        <textarea name="comment" id="commentTextarea" class="form-control border-0 shadow" cols="30" rows="8"  
                                                                                      placeholder="Your Review *" spellcheck="false"></textarea>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between py-3 mb-5">
                                        <button type="submit"
                                            class="btn border border-secondary text-primary rounded-pill px-4 py-3">Post
                                            Comment</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <hr class="my-5">

            <!-- Related Products Section -->
            @if (count($productList) != 0)
                <h1 class="mb-3 fw-bold">Related products</h1>
            @endif

            <div class=" @if (count($productList) >= 3) owl-carousel vegetable-carousel justify-content-center @endif "
                style="@if (count($productList) < 3) width:800px; @endif ">


                @foreach ($productList as $item)
                    @if ($product->id != $item->id)
                        <div class="col-sm-6 col-md-4 col-xl-4">
                            <div class="product-card card h-100 bg-transparent overflow-hidden rounded-4">
                                <!-- Image Container -->
                                <div class="position-relative overflow-hidden">
                                    <a href="{{ route('userList#details', $item->id) }}">
                                        <img src="{{ str_contains($item->image, 'http') ? $item->image : asset('product/' . $item->image) }}"
                                            style="height: 240px; object-fit: cover;" class="img-fluid w-100 card-img-top"
                                            alt="{{ $item->name }}">
                                    </a>
                                    <!-- Floating Badge -->
                                    <div class="position-absolute top-0 start-0 m-3 px-3 py-1 rounded-pill text-white shadow-sm"
                                        style="background: rgba(0,0,0,0.6); backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.2); font-size: 0.8rem;">
                                        <i class="fa-solid fa-tag me-1 text-warning"></i>
                                        {{ $item->category_name }}
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="card-body d-flex flex-column p-4" style="background: rgba(0,0,0,0.4);">
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
                                                    {{ number_format($item->price) }} <span class="fs-6">MMK</span>
                                                </div>
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
                    @endif
                @endforeach

            </div>
        </div>

        <!-- Rating Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow rounded-4">
                    <div class="modal-header border-0">
                        <h5 class="fw-bold">Rate this product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('userList#rating') }}" method="post">
                        @csrf
                        <div class="modal-body text-center">
                            <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="productId" value="{{ $product->id }}">
                            <div class="rating-css">
                                <div class="star-icon">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio" value="{{ $i }}" name="productRating"
                                            id="rating{{ $i }}" {{ $i == 1 ? 'checked' : '' }}>
                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="submit" class="btn btn-warning w-100 rounded-pill fw-bold">Submit
                                Rating</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
                // Quantity Plus
                $('.btn-plus').click(function() {
                    var input = $('#quantity');
                    var currentVal = parseInt(input.val());
                    if (!isNaN(currentVal)) {
                        input.val(currentVal + 1);
                    }
                });

                // Quantity Minus
                $('.btn-minus').click(function() {
                    var input = $('#quantity');
                    var currentVal = parseInt(input.val());
                    if (!isNaN(currentVal) && currentVal > 1) {
                        input.val(currentVal - 1);
                    }
                });

                // Edit Comment
                $('.edit-btn').click(function() {
                    let id = $(this).data('id');
                    let message = $(this).data('message');
                    $('#commentTextarea').val(message);
                    $('#editCommentId').val(id);
                    $('#commentTextarea').focus();
                });
            });
        </script>
    @endsection
