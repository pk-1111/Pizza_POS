<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pizza Hunter - Delicious Pizza Delivered</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <style>
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar for better UI */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #A70904;
            border-radius: 10px;
        }
    </style>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries & Bootstrap Stylesheet -->
    <link href="{{ asset('user/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('user/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('user/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('user/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('user/css/ratingStar.css') }}">
</head>

<body
    style="background-image: url('{{ asset('user/img/main_bg-artguru.png') }}'); min-height: 100vh; background-attachment: fixed; background-position: center; background-repeat: no-repeat; background-size: cover;">

    <!-- Navbar Start -->
    <div class="sticky-top w-100" style="z-index: 1050;">
        <div class="container p-0">
            <nav class="navbar navbar-expand-lg navbar-dark rounded px-4 py-2 shadow mt-2"
                style="background: rgba(167, 9, 4, 0.95); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.1);">

                <a href="{{ route('userHome') }}" class="navbar-brand d-flex align-items-center">
                    <img src="{{ asset('user/img/download (4).jpg') }}" alt="Logo" class="rounded"
                        style="width: 40px; height: 40px; margin-right: 10px; object-fit: cover;">
                    <h1 class="text-warning px-2 mb-0" style="font-size: 1.6rem; letter-spacing: 1px;"> Pizza Hunter
                    </h1>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-warning"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav mx-auto">
                        <a href="{{ route('userHome') }}"
                            class="nav-item nav-link {{ Request::routeIs('userHome') ? 'active text-white' : 'text-warning' }} fw-bold">
                            <i class="fa-solid fa-house"></i> Home
                        </a>
                        <a href="{{ route('shop#shopPage') }}" class="nav-item nav-link text-white fw-bold">
                            <i class="fa-solid fa-pizza-slice"></i> Menu
                        </a>
                        <a href="{{ route('userList#addToCartPage') }}" class="nav-item nav-link text-white fw-bold">
                            <i class="fa-solid fa-cart-shopping"></i> Cart
                        </a>
                        <a href="{{ route('userList#contact') }}" class="nav-item nav-link text-white fw-bold">
                            <i class="fa-solid fa-headset"></i> Support
                        </a>
                    </div>

                    <div class="d-flex align-items-center mt-3 mt-lg-0">
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle p-0 d-flex align-items-center text-white"
                                data-bs-toggle="dropdown">
                                <img src="{{ Auth::check() && Auth::user()->profile ? (str_contains(Auth::user()->profile, 'http') ? Auth::user()->profile : asset('profile/' . Auth::user()->profile)) : asset('admin/img/undraw_profile.svg') }}"
                                    style="width: 35px; height: 35px; object-fit: cover;"
                                    class="rounded-circle border border-2 border-warning me-2" alt="User">
                                <span class="small">{{ Auth::user()->name ?? Auth::user()->nickname }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end bg-dark border-warning rounded shadow mt-2">
                                <a href="{{ route('user#useraccountProfile') }}"
                                    class="dropdown-item text-black py-2"><i class="fa fa-user me-2"></i> Profile</a>
                                <a href="{{ route('user#editProfile') }}" class="dropdown-item text-black py-2"><i
                                        class="fa fa-edit me-2"></i> Edit Account</a>
                                <a href="{{ route('user#changePasswordPage') }}"
                                    class="dropdown-item text-black py-2"><i class="fa fa-key me-2"></i> Password</a>
                                <div class="dropdown-divider border-secondary"></div>
                                <form action="{{ route('logout') }}" method="post" class="px-3 py-2">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger w-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <main class="py-4">
        @yield('content')
    </main>

    @include('sweetalert::alert')

    <!-- Footer Start -->
    <footer class="container-fluid text-white-50 footer pt-5 mt-5"
        style="background: rgba(0,0,0,0.85); backdrop-filter: blur(10px);">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h1 class="text-primary mb-3">Pizza Hunter</h1>
                    <p class="mb-4">Craving the best pizza in town? We bring authentic flavors and fresh ingredients
                        straight to your doorstep.</p>
                    <div class="d-flex">
                        <a class="btn btn-outline-primary btn-md-square rounded-circle me-2" href="#"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-primary btn-md-square rounded-circle me-2" href="#"><i
                                class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-primary btn-md-square rounded-circle" href="#"><i
                                class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">Quick Links</h4>
                    <a class="btn-link text-white-50 d-block mb-2" href="#">About Us</a>
                    <a class="btn-link text-white-50 d-block mb-2" href="#">Contact Us</a>
                    <a class="btn-link text-white-50 d-block mb-2" href="#">Terms & Conditions</a>
                    <a class="btn-link text-white-50 d-block mb-2" href="#">Privacy Policy</a>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-light mb-4">Newsletter</h4>
                    <p>Subscribe for exclusive pizza deals!</p>
                    <div class="position-relative w-100">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5 rounded-pill" type="text"
                            placeholder="Your email">
                        <button type="button"
                            class="btn btn-primary position-absolute top-0 end-0 mt-2 me-2 py-1 px-3 rounded-pill">Join</button>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="{{ asset('user/lib/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('user/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('user/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Consolidated Core JS -->
    <script>
        $(document).ready(function() {
            // Owl Carousel Initialization
            $(".owl-carousel").owlCarousel({
                items: 3,
                loop: true,
                margin: 10,
                autoplay: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });

            // Quantity Control & Price Update Logic
            $(document).on('click', '.btn-plus, .btn-minus', function() {
                let $row = $(this).closest('tr');
                let $input = $row.find('.qty');
                let currentVal = parseInt($input.val()) || 1;

                if ($(this).hasClass('btn-plus')) {
                    $input.val(currentVal + 1);
                } else if (currentVal > 1) {
                    $input.val(currentVal - 1);
                }

                // Update Row Subtotal
                let price = Number($row.find('.price').data('price')) || 0;
                let newQty = parseInt($input.val());
                let rowTotal = price * newQty;

                $row.find('.total').text(rowTotal.toLocaleString() + " mmk");

                updateGrandTotal();
            });

            // Update Grand Totals
            function updateGrandTotal() {
                let subTotal = 0;
                $('.total').each(function() {
                    let val = parseInt($(this).text().replace(/[^0-9]/g, '')) || 0;
                    subTotal += val;
                });

                $('#subTotal').text(subTotal.toLocaleString() + " mmk");
                $('#finalTotal').text((subTotal + 5000).toLocaleString() + " mmk");
            }

            // Remove Item Logic
            $(".btn-remove").click(function() {
                let $row = $(this).closest("tr");
                let cartId = $row.find('.cartId').val();

                $.ajax({
                    type: 'get',
                    url: '/user/addToCard/delete',
                    data: {
                        'cartId': cartId
                    },
                    success: function(res) {
                        if (res.status == 'success') $row.fadeOut(300, function() {
                            $(this).remove();
                            updateGrandTotal();
                        });
                    }
                });
            });

            // Checkout Process
            $('#btn-checkout').click(function() {
                let orderList = [];
                let orderCode = "CL-POS" + Date.now();
                let totalAmount = parseInt($('#finalTotal').text().replace(/[^0-9]/g, ''));

                $('#productTable tbody tr').each(function() {
                    orderList.push({
                        'user_id': $("#userId").val(),
                        'product_id': $(this).find('.productId').val(),
                        'qty': $(this).find('.qty').val(),
                        'order_code': orderCode,
                        'total_amount': totalAmount
                    });
                });

                $.ajax({
                    type: 'get',
                    url: '/user/cart/temp',
                    data: Object.assign({}, orderList),
                    success: function(res) {
                        if (res.status == 'success') location.href = '/user/payment';
                    }
                });
            });
        });

        // Image Preview Handler
        function loadFile(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById("output");
                if (output) output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    @yield('script')
</body>

</html>
