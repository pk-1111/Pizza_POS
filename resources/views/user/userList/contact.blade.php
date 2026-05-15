@extends('user.layouts.master')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="row">
            <!-- Main Glassmorphism Wrapper -->
            <div class="card col-12 shadow-lg border-0"
                style="background: rgba(0,0,0,0.6); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 25px;">

                <div class="card-body p-4 p-md-5">
                    <div class="row g-4">

                        <!-- Left Side: Contact Information -->
                        <div class="col-lg-5">
                            <div class="card text-white h-100 border-0 shadow-sm"
                                style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">

                                <div class="card-body p-4">
                                    <h4 class="mb-4 fw-bold text-warning"><i
                                            class="fa-solid fa-address-book me-2"></i>Contact Info</h4>

                                    <div class="mb-4">
                                        <p class="mb-1 text-secondary small uppercase fw-bold">Office Manager</p>
                                        <p class="fs-5">U Mg Mg</p>
                                    </div>

                                    <div class="d-flex mb-3">
                                        <div class="me-3 text-warning"><i class="fa-solid fa-phone"></i></div>
                                        <div>09457896582</div>
                                    </div>

                                    <div class="d-flex mb-3">
                                        <div class="me-3 text-warning"><i class="fa-solid fa-envelope"></i></div>
                                        <div>pizzahunter@gmail.com</div>
                                    </div>

                                    <div class="d-flex mb-0">
                                        <div class="me-3 text-warning"><i class="fa-solid fa-location-dot"></i></div>
                                        <div>
                                            MoKaung Pagoda (14-BC),<br>
                                            No-2, MinMaHaw Road, Yangon.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Feedback Form -->
                        <div class="col-lg-7">
                            <div class="card text-white border-0 shadow-sm"
                                style="background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);">

                                <div class="card-body p-4">
                                    <h4 class="mb-4 fw-bold text-white">Customer Feedback</h4>

                                    <form action="{{ route('userList#contactCreate') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="row g-3">
                                            <!-- Name (Read Only) -->
                                            <div class="col-md-6">
                                                <label class="form-label small text-secondary">User Name</label>
                                                <input type="text" name="name" value="{{ Auth::user()->name }}"
                                                    readonly class="form-control text-white border-0 py-2"
                                                    style="background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1);"
                                                    placeholder="User Name...">
                                            </div>

                                            <!-- Phone -->
                                            <div class="col-md-6">
                                                <label class="form-label small text-secondary">Phone Number</label>
                                                <input type="text" name="phone" required
                                                    class="form-control text-white border-0 py-2"
                                                    style="background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1);"
                                                    placeholder="09xxxxxxxx">
                                            </div>

                                            <!-- Address -->
                                            <div class="col-12">
                                                <label class="form-label small text-secondary">Your Address</label>
                                                <input type="text" name="address" required
                                                    class="form-control text-white border-0 py-2"
                                                    style="background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1);"
                                                    placeholder="Enter your address...">
                                            </div>

                                            <!-- Reason/Message -->
                                            <div class="col-12">
                                                <label class="form-label small text-secondary">Message / Reason</label>
                                                <textarea name="reason" rows="4" required class="form-control text-white border-0"
                                                    style="background: rgba(0,0,0,0.4); border: 1px solid rgba(255,255,255,0.1);"
                                                    placeholder="Tell us what's on your mind..."></textarea>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-12 mt-4">
                                                <button type="submit" class="btn btn-warning w-100 fw-bold py-2 shadow-sm">
                                                    <i class="fa-solid fa-paper-plane me-2"></i>Send Feedback
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End col-lg-7 -->

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
