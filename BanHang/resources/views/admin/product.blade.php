@extends('layout.AdminLayout')
@section('title', 'Quản lý sản phẩm')

@section('content')
<div class="row">
      <div class="col">
        <nav aria-label="breadcrumb" class="bg-body-tertiary rounded-3 p-3 mb-4">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Product Management</li>
          </ol>
        </nav>
      </div>
    </div>
    <h1 class="mb-4 text-black">Product Management</h1>
<div class="d-flex justify-content-between mb-3">
    <!-- Thanh tìm kiếm -->
    <div class="mb-3" style="width: 33%;">
        <form class="d-flex" role="search" method="GET" action="{{ route('admin.product') }}">
            @csrf
            <input class="form-control me-2" type="search" name="keyword" placeholder="Search by name" value="{{ request('keyword') }}" />
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

    <!-- Nút thêm danh mục -->
    <div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            + Thêm danh mục
        </button>
    </div>
</div>

<!-- Bảng dữ liệu -->
<table class="table table-hover align-middle mt-0">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>#{{ $product->id }}</td>
            <td>
                <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Product Image" width="50" height="50">
            </td>
            <td>{{ $product->title }}</td>
            <td>{{ number_format($product->price) }}VNĐ</td>
            <td>{{ $product->quantity }}</td>
            <td>
                <!-- Details -->
                <a href="#" class="text-decoration-none text-primary me-2" data-bs-toggle="modal" data-bs-target="#productModal{{ $product->id }}">
                    Details
                </a>

                <!-- Edit -->
                <a href="#" class="text-decoration-none text-warning me-2"
                        data-bs-toggle="modal"
                        data-bs-target="#editProductModal{{ $product->id }}">
                        <span data-bs-toggle="tooltip" title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-pen" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
                            </svg>
                    </a>

                <!-- Delete -->
                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST"
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
<div class="d-flex justify-content-center mt-4">
    {{ $products->links() }}
</div>
<style>
    .pagination {
        --bs-pagination-color: #2575fc;
        --bs-pagination-hover-color: #fff;
        --bs-pagination-active-bg: #2575fc;
        --bs-pagination-active-border-color: #2575fc;
        --bs-pagination-hover-bg: #6a11cb;
        --bs-pagination-hover-border-color: #6a11cb;
        font-size: 1.1rem;
    }
    .pagination .page-link {
        border-radius: 8px !important;
        margin: 0 2px;
        transition: background 0.2s, color 0.2s;
    }
</style>
<!-- Modal Edit Product -->
@foreach ($products as $product)
<div class="modal fade" id="editProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('admin.product.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chỉnh sửa sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title', $product->title) }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" value="{{ old('quantity', $product->quantity) }}">
                    </div>
                    <div class="col-12 mb-3">
                            <label for="description{{ $product->id }}" class="form-label">Description</label>
                            <input type="text" name="description" id="description{{ $product->id }}" class="form-control" value="{{ old('description', $product->description) }}" required maxlength="200" />
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="thumbnail" accept="image/*">
                        @if ($product->thumbnail)
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Current  thumbnail" width="100" class="mt-2">
                        @endif
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

<!-- Modal Chi tiết sản phẩm -->
@foreach ($products as $product)
<div class="modal fade custom-centered-modal" id="productModal{{ $product->id }}" tabindex="-1" aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><strong>ID:</strong> {{ $product->id }}</li>
                    <li class="list-group-item"><strong>Title:</strong> {{ $product->title }}</li>
                    <li class="list-group-item"><strong>Price:</strong> {{ number_format($product->price)}}VNĐ</li>
                    <li class="list-group-item"><strong>Quantity:</strong> {{ $product->quantity }}</li>
                    <li class="list-group-item"><strong>Description:</strong> {{ $product->description }}</li>
                    <li class="list-group-item">
                        <strong>Image:</strong><br>
                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Product Image" width="150">
                    </li>
                    <li class="list-group-item"><strong>Created At:</strong> {{ $product->created_at }}</li>
                    <li class="list-group-item"><strong>Updated At:</strong> {{ $product->updated_at }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endforeach

<!-- Modal Thêm sản phẩm -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm sản phẩm mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số lượng</label>
                        <input type="number" class="form-control" name="quantity">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Danh mục</label>
                        <select class="form-select" name="category_id" required>
                            <option value="" disabled selected>-- Chọn danh mục --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả sản phẩm</label>
                        <input type="text" class="form-control" name="description" placeholder="Mô tả sản phẩm">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ảnh sản phẩm</label>
                        <input type="file" class="form-control" name="thumbnail" accept="image/*">
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
@endsection
