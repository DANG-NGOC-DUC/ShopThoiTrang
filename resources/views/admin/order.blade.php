@extends('layout.AdminLayout')

@section('title', 'Order Management')
@section('content')


<div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Order Management</li>
          </ol>
        </nav>
      </div>
    </div>
    <h2 class="mb-4 text-black">Order Management</h2>

<!-- Thanh tìm kiếm -->
    <div class="mb-3" style="width: 33%;">
        <form class="d-flex" role="search" method="GET" action="{{ route('admin.order') }}">
            @csrf
            <input class="form-control me-2" type="search" name="keyword" placeholder="Search by name" value="{{ request('keyword') }}" />
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>


<table class="table table-hover align-middle mt-0">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Phone</th>
            <th>Total</th>
            <th>Status</th>
            <th>Order Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->fullname }}</td>
                <td>{{ $order->phone_number }}</td>
                <td>${{ number_format($order->total_money, 2) }}</td>
                <td>
                    @switch($order->status)
                        @case(0) Pending @break
                        @case(1) Processing @break
                        @case(2) Completed @break
                        @case(3) Cancelled @break
                        @default Unknown
                    @endswitch
                </td>
                <td>{{ $order->order_date->format('Y-m-d H:i') }}</td>
                <td>
                    <!-- Details (Modal) -->
                        <a href="#"
                           class="text-decoration-none text-primary me-2"
                           data-bs-toggle="modal"
                           data-bs-target="#orderDetailModal{{ $order->id }}">
                            Details
                        </a>

                    <!-- Edit Button -->
                    <a href="#" class="text-decoration-none text-warning me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#editOrderModal{{ $order->id }}">
                        <span data-bs-toggle="tooltip" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                            </svg>
                    </a>
                    <!-- Delete -->
                    <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST"
                        style="display:inline-block;"
                        onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline text-danger text-decoration-none">
                            <span data-bs-toggle="tooltip" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5zm5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z"/>
                                    <path fill-rule="evenodd"
                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h4.793l.853-.854A.5.5 0 0 1 8.207 1h1.586a.5.5 0 0 1 .354.146l.853.854H14.5a1 1 0 0 1 1 1zM5.118 4 5 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L10.882 4H5.118z"/>
                                </svg>
                            </span>
                        </button>
                    </form>
                    
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        <!-- Edit Modal -->
    @foreach ($orders as $order)
    <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1" aria-labelledby="eeditOrderModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('admin.order.update', $order->id) }}" method="POST" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderEditLabel{{ $order->id }}">Edit Order #{{ $order->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fullname{{ $order->id }}" class="form-label">Fullname</label>
                            <input type="text" name="fullname" id="fullname{{ $order->id }}" class="form-control" value="{{ old('fullname', $order->fullname) }}" required maxlength="50" />
                        </div>

                        <div class="mb-3">
                            <label for="email{{ $order->id }}" class="form-label">Email</label>
                            <input type="email" name="email" id="email{{ $order->id }}" class="form-control" value="{{ old('email', $order->email) }}" required maxlength="150" />
                        </div>

                        <div class="mb-3">
                            <label for="phone_number{{ $order->id }}" class="form-label">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number{{ $order->id }}" class="form-control" value="{{ old('phone_number', $order->phone_number) }}" required maxlength="20" />
                        </div>

                        <div class="mb-3">
                            <label for="address{{ $order->id }}" class="form-label">Address</label>
                            <input type="text" name="address" id="address{{ $order->id }}" class="form-control" value="{{ old('address', $order->address) }}" required maxlength="200" />
                        </div>

                        <div class="mb-3">
                            <label for="note{{ $order->id }}" class="form-label">Note</label>
                            <textarea name="note" id="note{{ $order->id }}" class="form-control" maxlength="1000">{{ old('note', $order->note) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="total_money{{ $order->id }}" class="form-label">Total Money</label>
                            <input type="number" name="total_money" id="total_money{{ $order->id }}" class="form-control" value="{{ old('total_money', $order->total_money) }}" required min="0" />
                        </div>

                        <div class="mb-3">
                            <label for="status{{ $order->id }}" class="form-label">Status</label>
                            <select name="status" id="status{{ $order->id }}" class="form-select" required>
                                <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>Pending</option>
                                <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>Processing</option>
                                <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>Completed</option>
                                <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
        <!-- Order Details Modal -->
        @foreach ($orders as $order)
            
        <div class="modal fade" id="orderDetailModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Order Detail #{{ $order->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-person-circle fs-3 me-2"></i>
                            <div>
                                <h5 class="mb-0">{{ $order->fullname }}</h5>
                                <small class="text-muted">{{ $order->email }}</small>
                            </div>
                        </div>

                        <p><strong>Phone:</strong> {{ $order->phone_number }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>

                        <p><strong>Products:</strong></p>
                        <ul>
                            @foreach ($order->orderDetails as $detail)
                                <li>{{ $detail->product->title }} x {{ $detail->num }}</li>
                            @endforeach
                        </ul>

                        <p><strong>Amount:</strong> ${{ number_format($order->total_money, 2) }}</p>

                        <p><strong>Status:</strong> 
                            @switch($order->status)
                                @case(0) Pending @break
                                @case(1) Processing @break
                                @case(2) Completed @break
                                @case(3) Cancelled @break
                                @default Unknown
                            @endswitch
                        </p>

                        <p><strong>Note:</strong> {{ $order->note ?? 'N/A' }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
@endsection
