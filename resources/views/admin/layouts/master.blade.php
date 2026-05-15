<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>POS Admin - Modern Dashboard</title>

    <!-- Custom fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Custom styles -->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fc;
        }

        /* Sidebar Styling */
        .sidebar {
            background: #4e73df !important;
            border-radius: 0 20px 20px 0;
        }

        .sidebar .nav-item .nav-link {
            padding: 1rem;
            transition: 0.3s;
            margin: 0 10px;
            border-radius: 10px;
        }

        .sidebar .nav-item .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar .nav-item.active .nav-link {
            background: #fff;
            color: #4e73df !important;
            font-weight: bold;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .sidebar .nav-item.active .nav-link i {
            color: #4e73df !important;
        }

        /* Topbar Styling */
        .topbar {
            background: #fff !important;
            border-bottom: 1px solid #e3e6f0;
        }

        .img-profile {
            border: 2px solid #4e73df;
            padding: 2px;
        }

        /* Card & Button Styling */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-logout {
            background: #e74a3b;
            color: white;
            border: none;
            width: 90%;
            margin: 10px auto;
            display: block;
        }

        .btn-logout:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #4e73df;
            border-radius: 10px;
        }
    </style>
</head>

<body id="page-top">

    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center my-3"
                href="{{ route('adminHome') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-store"></i>
                </div>
                <div class="sidebar-brand-text mx-1">Hunter Pizza</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- Nav Items -->
            <li class="nav-item {{ request()->routeIs('adminHome') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('adminHome') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('category#listCategory') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('category#listCategory') }}">
                    <i class="fa-solid fa-layer-group"></i><span>Category</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('products#addProducts') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('products#addProducts') }}">
                    <i class="fa-solid fa-circle-plus"></i><span>Add Products</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('List#productsList') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('List#productsList') }}">
                    <i class="fa-solid fa-list-check"></i><span>Product List</span>
                </a>
            </li>

            @if (Auth::user()->role == 'superadmin')
                <li class="nav-item {{ request()->routeIs('paymentMethod#adminPayment') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('paymentMethod#adminPayment') }}">
                        <i class="fa-solid fa-credit-card"></i><span>Payment Method</span>
                    </a>
                </li>
            @endif



            <li class="nav-item {{ request()->routeIs('contact#customerContact') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('contact#customerContact') }}">
                    <i class="fa-solid fa-envelope"></i><span>Messages</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('info#adminOrder') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('info#adminOrder') }}">
                    <i class="fa-solid fa-cart-shopping"></i><span>Order Board</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile#changePassword') }}">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Security</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Logout -->
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-logout shadow-sm">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                    </button>
                </form>
            </li>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow-sm px-4">
                    <h5 class="m-0 font-weight-bold text-primary d-none d-md-block">Admin Control Panel</h5>

                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-700 small font-weight-bold">{{ Auth::user()->name }}</span>
                                <img class="img-profile rounded-circle shadow-sm"
                                    src="{{ asset(Auth::user()->profile != null ? 'profile/' . Auth::user()->profile : 'admin/img/undraw_profile.svg') }}">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow-lg border-0 animated--fade-in">
                                <a class="dropdown-item" href="{{ route('profile#accountProfile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile
                                </a>
                                @if (Auth::user()->role == 'superadmin')
                                    <a class="dropdown-item" href="{{ route('profile#createNewAdminAccount') }}">
                                        <i class="fas fa-plus-circle fa-sm fa-fw mr-2 text-gray-400"></i> Add Admin
                                    </a>
                                @endif

                                @if (Auth::user()->role == 'superadmin')
                                    <a class="dropdown-item" href="{{ route('profile#adminList') }}">
                                        <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i> Admin List
                                    </a>
                                @endif



                                <a class="dropdown-item" href="{{ route('profile#userList') }}">
                                    <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i> User List
                                </a>

                                <a class="dropdown-item" href="{{ route('profile#changePassword') }}">
                                    <i class="fas fa-users-cog fa-sm fa-fw mr-2 text-gray-400"></i> Change Password
                                </a>

                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="post" id="logoutForm">
                                    @csrf
                                    <a class="dropdown-item text-danger" href="javascript:void(0)"
                                        onclick="document.getElementById('logoutForm').submit();">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i> Logout</span>
                                    </a>
                                </form>

                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    @yield('content')
                </div>

            </div>

        </div>

    </div>

    @include('sweetalert::alert')

    <!-- Scripts -->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('admin/js/orderStatus.js') }}"></script>

    <!-- AJAX Logic and Other Scripts remain the same -->
</body>

</html>
