@extends('user.layouts.master')

@section('content')
    <div class="container py-5 mt-5  ">
        <div class="row py-5">
            <div class="card  col-12 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-body">
                                        <h5 class="mb-4">Payment methods</h5>


                                        @foreach ($payments as $item) 
                                            <div class="mt-3">
                                                <b> {{ $item->type }}</b> (Name : {{ $item->account_name }})
                                            </div>
                                            Account : {{ $item->account_number }}
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    Payment Info
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <form action="{{ route('userList#order') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <input type="text" name="name" id=""
                                                        value="{{ Auth::user()->name }}" readonly
                                                        class="form-control @error('name') is-invalid @enderror "
                                                        placeholder="User Name...">
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="phone" id=""
                                                        value="{{ old('phone', Auth::user()->phone) }}"
                                                        class="form-control @error('phone') is-invalid @enderror "
                                                        placeholder="09xxxxxxxx">
                                                    @error('phone')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="address" id=""
                                                        value="{{ old('address', Auth::user()->address) }}"
                                                        class="form-control @error('address') is-invalid @enderror "
                                                        placeholder="Address...">
                                                    @error('address')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <select name="paymentType" id=""
                                                        class=" form-select @error('paymentType') is-invalid @enderror ">
                                                        <option value="{{ old('paymentType') }}">Choose Payment methods...
                                                        </option>
                                                        @foreach ($payments as $item)
                                                            <option value="{{ $item->type }}"
                                                                @if (old('paymentType') == $item->id) selected @endif>
                                                                {{ $item->type }}</option>
                                                        @endforeach

                                                    </select>
                                                    @error('paymentType')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <input type="file" name="payslipImage" id=""
                                                        class="form-control   @error('payslipImage') is-invalid @enderror
                                                       ">
                                                    @error('payslipImage')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col">
                                                    <input type="hidden" name="orderCode"
                                                        value="{{ $orderProduct[0]['order_code'] }}">
                                                    Order Code : <span
                                                        class="text-secondary fw-bold">{{ $orderProduct[0]['order_code'] }}</span>
                                                </div>
                                                <div class="col">
                                                    <input type="hidden" name="totalAmount"
                                                        value="{{ $orderProduct[0]['total_amount'] }}">
                                                    Total amt : <span
                                                        class=" fw-bold ">{{ $orderProduct[0]['total_amount'] }}
                                                        mmk</span>
                                                </div>
                                            </div>

                                            <div class="row mt-4 mx-2">
                                                <button type="submit" class="btn btn-outline-success w-100"><i
                                                        class="fa-solid fa-cart-shopping me-3"></i> Order
                                                    Now...</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
