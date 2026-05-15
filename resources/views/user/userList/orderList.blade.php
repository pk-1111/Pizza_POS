@extends('user.layouts.master')

@section('content')
    <div class="container py-5 mt-5  ">
        <div class="row py-5">
            <div class="card  col-12 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-hover table-bordered border text-center shadow-sm ">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <th>Date</th>
                                        <th>Order Code</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($order as $item)
                                        <tr>
                                            <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                            <td>{{ $item['order_code'] }}</td>
                                            <td>
                                                @if ($item['status'] == 0)
                                                    <span class="btn btn-warning btn-sm rounded shadow-sm">
                                                        Pending
                                                    </span>
                                                @elseif ($item['status'] == 1)
                                                    <span class="btn btn-success btn-sm rounded shadow-sm">
                                                        Accept
                                                    </span> <span>(<i class="fa-regular fa-clock"></i>Waiting Time for <b> 3
                                                            day </b>)</span>
                                                @else
                                                    <span class="btn btn-danger btn-sm rounded shadow-sm">
                                                        Reject
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <span class=" d-flex justify-content-end"></span>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
