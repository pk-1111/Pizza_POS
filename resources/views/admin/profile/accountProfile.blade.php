@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <!-- Profile Card -->
                <div class="card shadow-sm mb-4 border-0 rounded-lg">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-user-circle mr-2"></i> Account Information
                            <span class="badge badge-danger-soft text-danger ml-2">( Admin Role )</span>
                        </h6>
                    </div>

                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <!-- Profile Image Section -->
                            <div class="col-md-4 text-center mb-4 mb-md-0">
                                <div class="profile-img-wrapper">
                                    <img class="img-fluid rounded-circle shadow-sm border p-1"
                                        style="width: 200px; height: 200px; object-fit: cover;" id="output"
                                        src="{{ asset(Auth::user()->profile ? 'profile/' . Auth::user()->profile : 'admin/img/undraw_profile.svg') }}">
                                </div>
                            </div>

                            <!-- Information Section -->
                            <div class="col-md-8">
                                <div class="info-group mb-3">
                                    <div class="row">
                                        <div class="col-sm-4 font-weight-bold text-muted"><i class="fas fa-user mr-2"></i>
                                            Name</div>
                                        <div class="col-sm-8 h6 mb-0 text-dark">
                                            {{ Auth::user()->name ?: Auth::user()->nickname ?: 'Not set' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-group mb-3">
                                    <div class="row">
                                        <div class="col-sm-4 font-weight-bold text-muted"><i
                                                class="fas fa-envelope mr-2"></i> Email</div>
                                        <div class="col-sm-8 h6 mb-0 text-dark">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>

                                <div class="info-group mb-3">
                                    <div class="row">
                                        <div class="col-sm-4 font-weight-bold text-muted"><i class="fas fa-phone mr-2"></i>
                                            Phone</div>
                                        <div class="col-sm-8 h6 mb-0 text-dark">{{ Auth::user()->phone ?: '-' }}</div>
                                    </div>
                                </div>

                                <div class="info-group mb-3">
                                    <div class="row">
                                        <div class="col-sm-4 font-weight-bold text-muted"><i
                                                class="fas fa-map-marker-alt mr-2"></i> Address</div>
                                        <div class="col-sm-8 h6 mb-0 text-dark small">{{ Auth::user()->address ?: '-' }}
                                        </div>
                                    </div>
                                </div>

                                <div class="info-group mb-4">
                                    <div class="row">
                                        <div class="col-sm-4 font-weight-bold text-muted"><i
                                                class="fas fa-user-shield mr-2"></i> Role</div>
                                        <div class="col-sm-8 h6 mb-0">
                                            <span
                                                class="text-danger font-weight-bold uppercase">{{ Auth::user()->role }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex flex-wrap">
                                    <a href="{{ route('profile#profileEdit') }}"
                                        class="btn btn-primary px-4 shadow-sm mr-2 mb-2">
                                        <i class="fas fa-user-edit mr-2"></i> Edit Profile
                                    </a>
                                    <a href="{{ route('profile#changePasswordPage') }}"
                                        class="btn btn-outline-primary px-4 shadow-sm mb-2">
                                        <i class="fas fa-key mr-2"></i> Change Password
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .badge-danger-soft {
            background-color: #fee2e2;
            padding: 0.5em 0.8em;
            border-radius: 6px;
            font-size: 0.85rem;
        }

        .info-group {
            border-bottom: 1px solid #f8f9fc;
            padding-bottom: 0.8rem;
        }

        .info-group:last-of-type {
            border-bottom: none;
        }

        .text-muted {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
@endsection
