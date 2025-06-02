<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display cart page
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('pages.cart', compact('cart'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'id' => 'required',
                'name' => 'required|string',
                'price' => 'required|numeric',
                'image' => 'required|string',
                'unit' => 'required|string',
                'quantity' => 'required|integer|min:1'
            ]);

            $productId = $request->input('id');
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                // Jika produk sudah ada di cart, tambah quantity
                $cart[$productId]['quantity'] += $request->input('quantity');
            } else {
                // Jika produk belum ada di cart, tambah produk baru
                $cart[$productId] = [
                    'id' => $request->input('id'),
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'image' => $request->input('image'),
                    'unit' => $request->input('unit'),
                    'quantity' => $request->input('quantity')
                ];
            }

            session()->put('cart', $cart);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan ke keranjang!',
                'cart_count' => count($cart)
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk ke keranjang: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Increase quantity
     */
    public function increase($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Quantity increased successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    /**
     * Decrease quantity
     */
    public function decrease($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Quantity decreased successfully!');
            } else {
                // Jika quantity = 1, hapus item dari cart
                unset($cart[$id]);
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product removed from cart successfully!');
            }
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    /**
     * Remove item from cart
     */
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in cart.');
    }

    /**
     * Process checkout
     */
    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        try {
            // Hitung total untuk validasi
            $total = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

            // Di sini Anda bisa implementasi logic checkout
            // Misalnya: simpan order ke database, proses pembayaran, dll.

            // Clear cart setelah checkout berhasil
            session()->forget('cart');

            return redirect()->route('pages.home')->with('success', 'Order placed successfully! Total: Rp' . number_format($total, 0, ',', '.'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Checkout failed. Please try again.');
        }
    }
}
