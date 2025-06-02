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
            max-width: 1200px;
            margin: 0 auto;
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

        .quantity-controls button {
            width: 40px;
            height: 40px;
            font-size: 1.25rem;
            background-color: #f9f9f9;
            color: #444;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .quantity-controls button:hover {
            background-color: #e9e9e9;
            color: #222;
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
            background: none;
            border: none;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .remove-btn:hover {
            color: #ff4d4d;
        }

        .cart-total-box {
            background-color: #fff;
            padding: 2rem;
            border: 1px solid #eee;
            border-radius: 12px;
            margin-top: 1rem;
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
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #009900;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 8px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .shopping-cart-section {
                padding: 2rem 1rem;
            }

            .table {
                font-size: 0.9rem;
            }

            .product-cell img {
                width: 60px;
                height: 60px;
            }
        }
    </style>

    <div class="shopping-cart-section">
        <div class="container">
            <h2 class="shopping-cart-title">My Shopping Cart</h2>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12">
                    <div class="table-responsive">
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
                                    <td>Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td>
                                        <div class="quantity-controls">
                                            <!-- Form untuk decrease quantity -->
                                            <form action="{{ route('cart.decrease', $item['id']) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" title="Decrease quantity">−</button>
                                            </form>

                                            <input type="text" value="{{ $item['quantity'] }}" readonly>

                                            <!-- Form untuk increase quantity -->
                                            <form action="{{ route('cart.increase', $item['id']) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" title="Increase quantity">+</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>Rp{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                                    <td>
                                        <!-- Form untuk remove item -->
                                        <form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="remove-btn"
                                                    title="Remove item"
                                                    onclick="return confirm('Are you sure you want to remove this item?')">×</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Your cart is empty.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="cart-total-box">
                        <h5>Cart Total</h5>
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span style="color: #28a745;">Free</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span>Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        @if(!empty($cart))
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="checkout-btn" onclick="return confirm('Proceed with checkout?')">
                                    Proceed to checkout
                                </button>
                            </form>
                        @else
                            <button class="checkout-btn" disabled style="background-color: #ccc;">
                                Cart is empty
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
