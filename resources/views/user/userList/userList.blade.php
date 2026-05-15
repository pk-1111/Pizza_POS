@extends('admin.layouts.master')



@section('content')
    <div class="container">
        <div class=" d-flex justify-content-between my-2">
            <a href=""> <button class=" btn btn-sm btn-secondary  "> User List</button> </a>
            <div class="">
                <form action="" method="get">

                    <div class="input-group">
                        <input type="text" name="searchKey" value="" class=" form-control"
                            placeholder="Enter Search Key...">
                        <button type="submit" class=" btn bg-dark text-white"> <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover shadow-sm ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Created Date</th>
                            <th> Platform</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($user as $item)
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['email'] }}</td>
                                <td>{{ $item['phone'] }}</td>
                                <td>{{ $item['address'] }}</td>
                                <td><span class="text-danger">{{ $item['role'] }}</span></td>

                                <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                <td>

                                    {{ $item['provider'] }}
                                    {{-- @if ($item['provider'] == 'google')
                                        <i class="fas-brands fa-google"></i>
                                    @endif
                                    @if ($item['provider'] == 'simple')
                                        <i class="fas fa-right-to-bracket"></i>
                                    @endif --}}
                                </td>
                                <td>

                                    <a href="{{ route('profile#delete', $item['id']) }}"
                                        class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

                <span class=" d-flex justify-content-end"></span>

            </div>
        </div>
    </div>
@endsection
