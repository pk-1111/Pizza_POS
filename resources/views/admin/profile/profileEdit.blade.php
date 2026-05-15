@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm mb-4 border-0 rounded-lg">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-user-edit mr-2"></i> Edit Profile Information
                            <small class="text-danger ml-2">({{ Auth::user()->role }} Role)</small>
                        </h6>
                    </div>

                    <form action="{{ route('profile#updateProfile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-4">
                            <div class="row">
                                <!-- Profile Image Section -->
                                <div class="col-md-4 text-center border-right">
                                    <div class="mb-3">
                                        <img class="img-profile img-thumbnail rounded-circle shadow-sm" id="output"
                                            style="width: 180px; height: 180px; object-fit: cover;"
                                            src="{{ asset(Auth::user()->profile ? 'profile/' . Auth::user()->profile : 'admin/img/undraw_profile.svg') }}">
                                    </div>
                                    <div class="px-3">
                                        <div class="custom-file mb-1">
                                            <input type="file" name="image"
                                                class="form-control @error('image') is-invalid @enderror"
                                                onchange="loadFile(event)">
                                        </div>
                                        @error('image')
                                            <small class="text-danger font-weight-bold">{{ $message }}</small>
                                        @enderror
                                        <p class="small text-muted mt-2 italic">* Click to upload new profile picture</p>
                                    </div>
                                </div>

                                <!-- Form Fields Section -->
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label font-weight-bold">Full Name</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name', Auth::user()->name ?: Auth::user()->nickname) }}"
                                                placeholder="Enter your name">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label font-weight-bold">Email Address</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email', Auth::user()->email) }}"
                                                placeholder="admin@example.com">
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label font-weight-bold">Phone Number</label>
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone', Auth::user()->phone) }}" placeholder="09*********">
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label font-weight-bold">Address</label>
                                            <input type="text" name="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                value="{{ old('address', Auth::user()->address) }}"
                                                placeholder="Street, City, State">
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-end">
                                        <a href="{{ url()->previous() }}" class="btn btn-light mr-2">Cancel</a>
                                        <button type="submit" class="btn btn-primary px-5 shadow-sm">
                                            <i class="fas fa-save mr-2"></i> Update Profile
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

    <!-- Image Preview Script -->
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
@endsection
