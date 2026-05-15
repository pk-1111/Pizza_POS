@extends('user.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid py-5 mt-5">
        <div class="row justify-content-center">

            <div class="card  shadow col-lg-8 py-5 col-md-10 p-0"
                style="  background: rgba(0,0,0,0.6); backdrop-filter: blur(5px);  border: 1px solid rgba(255,255,255,0.1);">



                <div class="card-body">
                    <div class="row align-items-center">

                        <div class="col-md-5 text-center mb-4 mb-md-0">
                            <img src="{{ asset(Auth::user()->profile != null ? 'profile/' . Auth::user()->profile : 'admin/img/undraw_profile.svg') }}"
                                class="img-fluid rounded-circle img-thumbnail shadow-sm"
                                style="width: 250px; height: 250px; object-fit: cover;" id="output">

                        </div>

                        <div class="col-md-7">
                            <div class="ps-md-4 ">
                                <div class="row mb-3">
                                    <div class="col-4 h5">Name :</div>
                                    <div class="col-8 h5 text-white">{{ Auth::user()->name ?? Auth::user()->nickname }}
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 h5">Email :</div>
                                    <div class="col-8 h5 text-white">{{ Auth::user()->email }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 h5">Phone :</div>
                                    <div class="col-8 h5 text-white">{{ Auth::user()->phone }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-4 h5">Address :</div>
                                    <div class="col-8 h5 text-danger font-weight-bold">{{ Auth::user()->address }}</div>
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('user#changePasswordPage') }}" class="btn btn-success me-2">
                                        <i class="fas fa-lock"></i> Change Password
                                    </a>
                                    <a href="{{ route('user#editProfile') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
