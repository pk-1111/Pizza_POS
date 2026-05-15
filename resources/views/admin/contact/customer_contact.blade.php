@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid px-4">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-3">
            <h1 class="h3 mb-0 text-gray-800 font-weight-bold">Customer Contact Feedback</h1>
        </div>

        <div class="card shadow border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 text-center">
                        <thead class="bg-light text-primary">
                            <tr>
                                <th class="border-0">Customer Name</th>
                                <th class="border-0 text-nowrap">Phone Number</th>
                                <th class="border-0">Address</th>

                                <th class="border-0">Reason / Message</th>
                                <th class="border-0 text-nowrap">Submitted Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($customer_contacts) > 0)
                                @foreach ($customer_contacts as $item)
                                    <tr>
                                        <td class="align-middle text-center font-weight-bold text-dark text-left pl-4">
                                            {{ $item->user_name }}
                                        </td>
                                        <td class="align-middle text-nowrap">
                                            <i class="fa-solid fa-phone"></i> {{ $item->phone }}
                                        </td>
                                        <td class="align-middle text-muted small">
                                            <i class="fa-solid fa-location-dot"></i> {{ Str::limit($item->address, 30) }}
                                        </td>

                                        <td class="align-middle text-center">
                                            <div class="small text-black" style="max-width: 250px; line-height: 1.4;">
                                                {{ $item->contact_reason }}
                                            </div>
                                        </td>
                                        <td class="align-middle text-nowrap small text-muted">
                                            {{ $item->created_at->format('j M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="py-5 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 d-block opacity-25"></i>
                                        No customer contacts found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-end">
            {{-- {{ $customer_contacts->links() }} --}}
        </div>
    </div>
@endsection
