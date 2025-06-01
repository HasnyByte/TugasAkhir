@extends('layouts.app')

@section('content')
@php
    $selectedCategory = request()->query('category');
    $categories = ['Laptop', 'Smartphone', 'Accessories'];

    $products = [
        [
            'name' => 'Laptop ASUS ROG',
            'price' => 1599.99,
            'description' => 'Laptop gaming dengan performa tinggi.',
            'quality' => 'Premium',
            'image' => 'Apple.png',
            'category' => 'Laptop',
            'brand' => 'ASUS',
            'status' => 'In Stock'
        ],
        [
            'name' => 'iPhone 14 Pro',
            'price' => 1199.99,
            'description' => 'Smartphone flagship dari Apple.',
            'quality' => 'High-end',
            'image' => 'iphone14.png',
            'category' => 'Smartphone',
            'brand' => 'Apple',
            'status' => 'In Stock'
        ],
        [
            'name' => 'Mouse Wireless Logitech',
            'price' => 29.99,
            'description' => 'Mouse nyaman dan responsif.',
            'quality' => 'Standard',
            'image' => 'mouse.png',
            'category' => 'Accessories',
            'brand' => 'Logitech',
            'status' => 'In Stock'
        ],
    ];

    if ($selectedCategory) {
        $products = array_filter($products, fn($product) => $product['category'] === $selectedCategory);
    }
@endphp

<div class="container py-4">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="font-bold text-gray-800 mb-4">Categories</h2>
                <div class="space-y-2">
                    <a href="{{ url()->current() }}" class="block py-1 px-2 rounded {{ !$selectedCategory ? 'bg-gray-200 font-medium' : '' }}">
                        All Products
                    </a>
                    @foreach($categories as $category)
                        <a href="?category={{ $category }}" class="block py-1 px-2 rounded {{ $selectedCategory === $category ? 'bg-gray-200 font-medium' : '' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Produk Grid -->
        <div class="lg:w-3/4">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-6">
                @forelse($products as $product)
                    @php
                        $productData = [
                            'name' => $product['name'],
                            'price' => $product['price'],
                            'description' => $product['description'],
                            'quality' => $product['quality'],
                            'image_url' => asset('images/products/' . $product['image']),
                            'category' => $product['category'],
                            'brand' => $product['brand'],
                            'status' => $product['status']
                        ];
                    @endphp

                    <div onclick='openPopup(@json($productData))'
                         class="cursor-pointer border rounded-lg p-3 shadow hover:shadow-lg text-center bg-white">
                        <img src="{{ asset('images/products/' . $product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-32 object-contain mb-2" />
                        <h3 class="font-semibold text-gray-800">{{ $product['name'] }}</h3>
                        <p class="text-green-600 font-bold">${{ number_format($product['price'], 2) }}</p>
                        <p class="text-sm text-gray-500">{{ $product['category'] }}</p>
                    </div>
                @empty
                    <div class="col-span-5 text-center py-12">
                        <h3 class="text-xl font-medium text-gray-800">No products found</h3>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Popup Detail Produk -->
<div id="product-popup" class="fixed inset-0 bg-black/30 backdrop-blur-sm hidden items-center justify-center z-50 transition-all">
    <div class="bg-white w-full max-w-5xl rounded-lg shadow-lg relative p-6 grid md:grid-cols-2 gap-6">
        <button onclick="closePopup()" class="absolute top-3 right-4 text-3xl text-gray-500 hover:text-gray-800">&times;</button>

        <!-- Gambar Produk -->
        <div class="flex flex-col items-center">
            <img id="popup-image" src="" alt="Product" class="w-full h-auto max-h-80 object-contain rounded mb-4">
            <div class="flex gap-2">
                <img src="https://via.placeholder.com/60x40" class="w-16 h-16 object-cover border rounded" />
                <img src="https://via.placeholder.com/60x40" class="w-16 h-16 object-cover border rounded" />
            </div>
        </div>

        <!-- Detail Produk -->
        <div class="flex flex-col justify-between">
            <div>
                <h2 id="popup-name" class="text-2xl font-bold text-gray-800 mb-1">Nama Produk</h2>
                <span id="popup-status" class="inline-block px-2 py-0.5 text-xs font-semibold bg-green-100 text-green-700 rounded mb-2">In Stock</span>
                <p id="popup-description" class="text-gray-600 mb-4">Deskripsi Produk</p>

                <div class="mb-1">
                    <strong class="text-sm text-gray-500">Brand:</strong>
                    <span id="popup-brand" class="text-sm text-gray-800">Brand</span>
                </div>
                <div class="mb-1">
                    <strong class="text-sm text-gray-500">Category:</strong>
                    <span id="popup-category" class="text-sm text-gray-800">Kategori</span>
                </div>
                <div class="mb-3">
                    <strong class="text-sm text-gray-500">Quality:</strong>
                    <span id="popup-quality" class="text-sm text-gray-800">Kualitas</span>
                </div>
            </div>
            <div class="mt-4 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <span id="popup-price" class="text-3xl font-bold text-green-600">$0.00</span>
                <button onclick="addToCart()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded shadow transition">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

<!-- Script -->
<script>
    let currentProduct = null;

    function openPopup(product) {
        currentProduct = product;

        document.getElementById('popup-name').textContent = product.name;
        document.getElementById('popup-description').textContent = product.description;
        document.getElementById('popup-image').src = product.image_url;
        document.getElementById('popup-price').textContent = "$" + parseFloat(product.price).toFixed(2);
        document.getElementById('popup-category').textContent = product.category;
        document.getElementById('popup-quality').textContent = product.quality;
        document.getElementById('popup-brand').textContent = product.brand;
        document.getElementById('popup-status').textContent = product.status;
        document.getElementById('product-popup').classList.remove('hidden');
        document.getElementById('product-popup').classList.add('flex');
    }

    function closePopup() {
        document.getElementById('product-popup').classList.remove('flex');
        document.getElementById('product-popup').classList.add('hidden');
    }

    function addToCart() {
        if (!currentProduct) return;

        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                name: currentProduct.name,
                price: currentProduct.price,
                image: currentProduct.image_url
            }),
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
            closePopup();
        });
    }
</script>
@endsection
