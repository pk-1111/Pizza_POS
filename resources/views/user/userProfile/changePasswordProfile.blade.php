@extends('user.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid py-5 mt-5">

        <!-- Page Heading -->

        <div class="mt-5">
            <div class="row">
                <div class="col-6 offset-3 ">



                    <div class="card">
                        <div class="card-body shadow">
                            <form action="{{ route('user#changePassword') }}" class="p-3 rounded" method="post">
                                @csrf


                                <div class="mb-3">
                                    <label for="exampleFormControlInpull" class="form-lable">New Password</label>
                                    <input type="password" name="oldPassword"
                                        class="form-control  @error('oldPassword') is-invalid @enderror "
                                        id="exampleFormControlInput1" placeholder="Enter Old Password ...">

                                    @error('oldPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInpull" class="form-lable">New Password</label>
                                    <input type="password" name="newPassword"
                                        class="form-control @error('newPassword') is-invalid @enderror"
                                        id="exampleFormControlInput1" placeholder="Enter New Password ...">

                                    @error('newPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleFormControlInpull" class="form-lable">Confirm Password</label>
                                    <input type="password" name="confirmPassword"
                                        class="form-control @error('confirmPassword') is-invalid @enderror"
                                        id="exampleFormControlInput1" placeholder="Enter Confirm Password ...">

                                    @error('confirmPassword')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input type="submit" class="btn btn-primary text-white" value="Change">
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                {{-- <div class="col">

                    <table class="table table-hover  table-bordered border text-center shadow-sm">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created Date</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr>
                                    <td>{{ $item->category_id }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                    <td>
                                        <a href="{{ route('category#updatePage', $item->category_id) }}"><i
                                                class="fas fa-pen-to-square btn btn-sm btn-outline-primary"></i></a>
                                        <a href="{{ route('category#delete', $item->category_id) }}"
                                            class="btn btn-sm  btn-outline-danger"><i class="fas fa-trash "></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <span class="d-flex justify-end text-black">{{ $categories->links() }}</span>
                </div> --}}

            </div>
        </div>


    </div>
@endsection
