@extends('layout.AdminLayout')
@section('title', 'Quản lý người dùng')

@section('content')
<div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Management</li>
          </ol>
        </nav>
      </div>
    </div>
    <h2 class="mb-4 text-black">User Management</h2>
    <!-- Thanh tìm kiếm -->
    <div class="mb-3" style="width: 33%;">
        <form class="d-flex" role="search" method="GET" action="{{ route('admin.user') }}">
            @csrf
            <input class="form-control me-2" type="search" name="keyword" placeholder="Search by email" value="{{ request('keyword') }}" />
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <!-- Bảng dữ liệu -->
    <table class="table table-hover align-middle mt-0">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>#{{ $user->id }}</td>
                    <td>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                             class="bi bi-person-circle me-2" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path fill-rule="evenodd"
                                  d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                        </svg>
                        <strong>{{ $user->fullname }}</strong>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <!-- Details (Modal) -->
                        <a href="#"
                           class="text-decoration-none text-primary me-2"
                           data-bs-toggle="modal"
                           data-bs-target="#userModal{{ $user->id }}">
                            Details
                        </a>

                        <!-- Edit -->
                        <a href="#"
                        class="text-decoration-none text-warning me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#editUserModal{{ $user->id }}">
                            <span data-bs-toggle="tooltip" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                                </svg>
                            </span>
                        </a>

                        <!-- Delete -->
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
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
    <!-- Modal Edit User -->
    @foreach ($users as $user)
        <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form method="POST" action="{{ route('admin.user.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Chỉnh sửa người dùng</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col-12 mb-3">
                                <label for="fullname{{ $user->id }}" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullname{{ $user->id }}" name="fullname" value="{{ old('fullname', $user->fullname) }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="phone_number{{ $user->id }}" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number{{ $user->id }}" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="address{{ $user->id }}" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address{{ $user->id }}" name="address" value="{{ old('address', $user->address) }}">
                            </div>
                            <div class="col-12 mb-3">
                                <label for="role_id{{ $user->id }}" class="form-label">Role</label>
                                <select class="form-select" id="role_id{{ $user->id }}" name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    <!-- Modal hiển thị chi tiết người dùng -->
    @foreach ($users as $user)
        <div class="modal fade custom-centered-modal" id="userModal{{ $user->id }}" tabindex="-1" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel{{ $user->id }}">Chi tiết người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group">
                            <li class="list-group-item"><strong>ID:</strong> {{ $user->id }}</li>
                            <li class="list-group-item"><strong>Full Name:</strong> {{ $user->fullname }}</li>
                            <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                            <li class="list-group-item"><strong>Phone Number:</strong> {{ $user->phone_number }}</li>
                            <li class="list-group-item"><strong>Address:</strong> {{ $user->address }}</li>
                            <li class="list-group-item"><strong>Role:</strong> {{ $user->role->name }}</li>
                            <li class="list-group-item"><strong>Created At:</strong> {{ $user->created_at }}</li>
                            <li class="list-group-item"><strong>Updated At:</strong> {{ $user->updated_at }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
