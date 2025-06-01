@extends('layouts.app')

@section('content')
@php
    $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
@endphp

<style>
    body {
        background-color: #fff;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .shopping-cart-section {
        padding: 3rem 0;
    }

    .shopping-cart-title {
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 2rem;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1rem;
    }

    .table thead th {
        text-transform: uppercase;
        font-size: 0.85rem;
        background-color: #f8f8f8;
        color: #999;
        text-align: left;
        padding: 1rem;
        border-bottom: 1px solid #eee;
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #eee;
    }

    .product-cell {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .product-cell img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    .quantity-controls {
        display: inline-flex;
        align-items: center;
        border: 1px solid #eee;
        border-radius: 25px;
        overflow: hidden;
    }

    .quantity-controls a {
        width: 40px;
        height: 40px;
        font-size: 1.25rem;
        background-color: #f9f9f9;
        color: #444;
        text-align: center;
        line-height: 40px;
        text-decoration: none;
    }

    .quantity-controls input {
        width: 50px;
        height: 40px;
        text-align: center;
        border: none;
        font-weight: 600;
        background-color: #fff;
    }

    .remove-btn {
        font-size: 1.5rem;
        color: #bbb;
        text-decoration: none;
    }

    .remove-btn:hover {
        color: #ff4d4d;
    }

    .action-buttons {
        display: flex;
        justify-content: space-between;
        margin: 2rem 0;
    }

    .btn-light {
        background-color: #f5f5f5;
        color: #333;
        padding: 0.75rem 2rem;
        border-radius: 25px;
        font-weight: 600;
        border: none;
    }

    .cart-total-box {
        background-color: #fff;
        padding: 2rem;
        border: 1px solid #eee;
        border-radius: 12px;
    }

    .cart-total-box h5 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
        font-size: 1rem;
    }

    .summary-row.total {
        font-weight: bold;
        font-size: 1.1rem;
        border-top: 1px solid #eee;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .checkout-btn {
        background-color: #00b300;
        color: white;
        padding: 0.75rem;
        width: 100%;
        border: none;
        border-radius: 30px;
        font-weight: 600;
        margin-top: 1.5rem;
        transition: background-color 0.3s ease;
    }

    .checkout-btn:hover {
        background-color: #009900;
    }

    .coupon-section {
        margin-top: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border: 1px solid #eee;
        padding: 1rem;
        border-radius: 12px;
    }

    .coupon-section input {
        flex-grow: 1;
        padding: 0.75rem 1rem;
        border-radius: 30px;
        border: 1px solid #ddd;
    }

    .coupon-section button {
        padding: 0.75rem 1.5rem;
        background-color: #222;
        color: #fff;
        border: none;
        border-radius: 30px;
        font-weight: 600;
    }
</style>

<div class="shopping-cart-section">
    <div class="container">
        <h2 class="shopping-cart-title">My Shopping Cart</h2>

        <div class="row">
            <div class="col-lg-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cart as $item)
                            <tr>
                                <td>
                                    <div class="product-cell">
                                        <img src="{{ asset('images/products/' . $item['image']) }}" alt="{{ $item['name'] ?? 'Product' }}">
                                        <span>{{ $item['name'] ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>
                                    <div class="quantity-controls">
                                        <a href="{{ route('cart.update', $item['id']) }}">−</a>
                                        <input type="text" value="{{ $item['quantity'] }}" readonly>
                                        <a href="{{ route('cart.remove', $item['id']) }}">+</a>
                                    </div>
                                </td>
                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td><a href="{{ route('cart.remove', $item['id']) }}" class="remove-btn">×</a></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Your cart is empty.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="coupon-section">
                    <input type="text" placeholder="Enter code" disabled>
                    <button disabled>Apply Coupon</button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="cart-total-box">
                    <h5>Cart Total</h5>
                    <div class="summary-row">
                        <span>Subtotal:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping:</span>
                        <span style="color: #28a745;">Free</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <form action="{{ route('cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="checkout-btn">Proceed to checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
