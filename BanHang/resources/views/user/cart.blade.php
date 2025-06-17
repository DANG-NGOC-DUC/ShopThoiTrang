@extends('layout.UserLayout')

@section('content')
<section class="shopping-cart spad mt-5">
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            {{-- Cart items --}}
            <div class="col-lg-8">
                <div class="shopping__cart__table mb-4">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                            <tr>
                                <td class="product__cart__item">
                                    <div class="d-flex">
                                        <img src="{{ asset('storage/' . $item->product->thumbnail) }}" alt="" style="width: 80px; margin-right: 15px;">
                                        <div>
                                            <h6>{{ $item->product->title }}</h6>
                                            <h5>{{ number_format($item->price, 0, ',', '.') }} VNĐ</h5>
                                        </div>
                                    </div>
                                </td>
                                <td class="quantity__item align-middle">
                                    <form action="{{ route('user.cart.update', $item->id) }}" method="POST" class="d-flex align-items-center cart-update-form">
                                        @csrf
                                        @method('PUT')
                                        <input
                                            type="number"
                                            name="quantity"
                                            value="{{ $item->quantity }}"
                                            min="1"
                                            class="form-control form-control-sm quantity-input"
                                            style="width: 60px;"
                                            data-price="{{ $item->price }}"
                                            data-id="{{ $item->id }}"
                                        >
                                    </form>
                                </td>
                                <td class="cart__price align-middle" id="total-{{ $item->id }}">
                                    {{ number_format($item->price * $item->quantity, 0, ',', '.') }} VNĐ
                                </td>
                                <td class="cart__close align-middle">
                                    <form action="{{ route('user.cart.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <a href="{{ route('user.shop') }}" class="btn btn-outline-dark">Continue Shopping</a>
                    </div>
                    <div class="col-sm-6 text-end">
                        <a href="{{ route('user.cart') }}" class="btn btn-dark"><i class="fa fa-spinner"></i> Refresh Cart</a>
                    </div>
                </div>
            </div>

            {{-- Tổng tiền và mã giảm giá --}}
            <div class="col-lg-4">
                <div class="cart__discount mb-4">
                    <h6>Discount codes</h6>
                    <form action="#" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="coupon_code" class="form-control" placeholder="Coupon code">
                            <button type="submit" class="btn btn-dark">Apply</button>
                        </div>
                    </form>
                </div>
                <div class="cart__total bg-light p-4 rounded">
                    <h6>Cart total</h6>
                    @php
                        $total = $cartItems->sum(fn($item) => $item->price * $item->quantity);
                    @endphp
                    <ul class="list-unstyled mb-3">
                        <li class="d-flex justify-content-between">
                            Subtotal
                            <span id="cart-subtotal">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
                        </li>
                        <li class="d-flex justify-content-between">
                            Total
                            <span id="cart-total" class="text-danger fw-bold">{{ number_format($total, 0, ',', '.') }} VNĐ</span>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-danger w-100">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const quantityInputs = document.querySelectorAll('.quantity-input');

    function formatVND(amount) {
        return new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND'
        }).format(amount);
    }

    let debounceTimers = {};

    quantityInputs.forEach(input => {
        input.addEventListener('input', function () {
            const id = this.dataset.id;
            const price = parseFloat(this.dataset.price);
            const quantity = parseInt(this.value);

            if (!isNaN(price) && !isNaN(quantity) && quantity > 0) {
                // Xoá timer cũ nếu có
                clearTimeout(debounceTimers[id]);

                // Đợi 300ms sau lần nhập cuối mới gửi request
                debounceTimers[id] = setTimeout(() => {
                    fetch(`/cart/ajax-update/${id}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ quantity: quantity })
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('total-' + id).innerText = formatVND(data.item_total);
                        document.getElementById('cart-subtotal').innerText = formatVND(data.cart_total);
                        document.getElementById('cart-total').innerText = formatVND(data.cart_total);
                    })
                    .catch(error => console.error('Lỗi:', error));
                }, 300);
            }
        });
    });
});
</script>
@endpush



<style>

.product__cart__item h6 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 5px;
}

.product__cart__item h5 {
    font-weight: 700;
    color: #e53637;
}

.cart__discount h6,
.cart__total h6 {
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 15px;
}

.cart__total ul li span {
    font-weight: 700;
}

.cart__close i {
    font-size: 18px;
    background: #f3f2ee;
    border-radius: 50%;
    height: 40px;
    width: 40px;
    text-align: center;
    line-height: 40px;
    display: inline-block;
}
</style>
