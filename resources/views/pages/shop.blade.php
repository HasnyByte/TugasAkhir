@extends('layouts.app')

@section('content')
    @php
        $selectedCategory = request()->query('category');
        $categories = \App\Models\Product::getCategories();

        // Mengambil produk dari database
        if ($selectedCategory) {
            $products = \App\Models\Product::byCategory($selectedCategory)->available()->get();
        } else {
            $products = \App\Models\Product::available()->get();
        }
    @endphp

    <div class="container py-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="font-bold text-gray-800 mb-4">Kategori Produk</h2>
                    <div class="space-y-2">
                        <a href="{{ url()->current() }}" class="block py-2 px-3 rounded hover:bg-gray-100 transition {{ !$selectedCategory ? 'bg-green-100 text-green-700 font-medium' : 'text-gray-700' }}">
                            <i class="fas fa-th-large mr-2"></i>Semua Produk
                        </a>
                        @foreach($categories as $category)
                            <a href="?category={{ urlencode($category) }}" class="block py-2 px-3 rounded hover:bg-gray-100 transition {{ $selectedCategory === $category ? 'bg-green-100 text-green-700 font-medium' : 'text-gray-700' }}">
                                @switch($category)
                                    @case('Fresh Fruit')
                                        <i class="fas fa-apple-alt mr-2"></i>
                                        @break
                                    @case('Fresh Vegetables')
                                        <i class="fas fa-carrot mr-2"></i>
                                        @break
                                    @case('Meat & Fish')
                                        <i class="fas fa-fish mr-2"></i>
                                        @break
                                    @case('Snacks')
                                        <i class="fas fa-cookie-bite mr-2"></i>
                                        @break
                                    @case('Eggs & Dairy')
                                        <i class="fas fa-cheese mr-2"></i>
                                        @break
                                    @case('Bakery & Pastry')
                                        <i class="fas fa-bread-slice mr-2"></i>
                                        @break
                                    @case('Honey & Jam')
                                        <i class="fas fa-jar mr-2"></i>
                                        @break
                                    @case('Cooking')
                                        <i class="fas fa-utensils mr-2"></i>
                                        @break
                                    @case('Breakfast')
                                        <i class="fas fa-coffee mr-2"></i>
                                        @break
                                    @case('Beverages')
                                        <i class="fas fa-glass-water mr-2"></i>
                                        @break
                                    @case('Fruits Juice')
                                        <i class="fas fa-glass-water mr-2"></i>
                                        @break
                                    @case('Tea')
                                        <i class="fas fa-mug-hot mr-2"></i>
                                        @break
                                    @default
                                        <i class="fas fa-box mr-2"></i>
                                @endswitch
                                {{ $category }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Filter tambahan -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="font-bold text-gray-800 mb-4">Filter</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kualitas</label>
                            <select class="w-full border border-gray-300 rounded-md px-3 py-2" id="qualityFilter">
                                <option value="">Semua Kualitas</option>
                                <option value="Premium">Premium</option>
                                <option value="Fresh">Fresh</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
                            <select class="w-full border border-gray-300 rounded-md px-3 py-2" id="priceFilter">
                                <option value="">Semua Harga</option>
                                <option value="low">Di bawah Rp 25.000</option>
                                <option value="medium">Rp 25.000 - Rp 50.000</option>
                                <option value="high">Di atas Rp 50.000</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid Produk -->
            <div class="lg:w-3/4">
                <!-- Header dengan jumlah produk -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">
                        @if($selectedCategory)
                            {{ $selectedCategory }}
                        @else
                            Semua Produk
                        @endif
                    </h1>
                    <p class="text-gray-600">Menampilkan {{ $products->count() }} produk</p>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-6" id="productsGrid">
                    @forelse($products as $product)
                        @php
                            $productData = [
                                'id' => $product->id,
                                'name' => $product->name,
                                'price' => $product->price,
                                'description' => $product->description,
                                'quality' => $product->quality,
                                'image_url' => asset('images/products/' . $product->image),
                                'category' => $product->category,
                                'origin' => $product->origin,
                                'status' => $product->status,
                                'unit' => $product->unit,
                                'stock_quantity' => $product->stock_quantity,
                                'stock_status' => $product->stock_status
                            ];
                        @endphp

                        <div onclick='openPopup(@json($productData))'
                             class="cursor-pointer border rounded-lg p-3 shadow hover:shadow-lg text-center bg-white transition-all duration-300 hover:scale-105 product-card"
                             data-category="{{ $product->category }}"
                             data-quality="{{ $product->quality }}"
                             data-price="{{ $product->price }}">

                            <!-- Badge untuk status stok -->
                            @if($product->stock_quantity <= 0)
                                <div class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                                    Habis
                                </div>
                            @elseif($product->stock_quantity <= 10)
                                <div class="absolute top-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">
                                    Stok Terbatas
                                </div>
                            @endif

                            <div class="relative">
                                <img src="{{ asset('images/products/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-32 object-cover mb-2 rounded"
                                     onerror="this.src='{{ asset('images/products/default.jpg') }}'" />

                                <!-- Badge kualitas -->
                                @if($product->quality === 'Premium')
                                    <div class="absolute top-2 right-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-crown"></i>
                                    </div>
                                @endif
                            </div>

                            <h3 class="font-semibold text-gray-800 text-sm">{{ $product->name }}</h3>
                            <p class="text-green-600 font-bold">{{ $product->price_formatted }}/{{ $product->unit }}</p>
                            <p class="text-xs text-gray-500 mb-1">{{ $product->category }}</p>

                            <!-- Status dan asal -->
                            <div class="flex justify-between items-center mt-2">
                                <span class="inline-block px-2 py-1 text-xs bg-green-100 text-green-700 rounded-full">
                                    {{ $product->status }}
                                </span>
                                @if($product->origin)
                                    <span class="text-xs text-gray-400">{{ Str::limit($product->origin, 15) }}</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-5 text-center py-12">
                            <div class="mb-4">
                                <i class="fas fa-box-open text-6xl text-gray-300"></i>
                            </div>
                            <h3 class="text-xl font-medium text-gray-800 mb-2">Tidak ada produk ditemukan</h3>
                            <p class="text-gray-500">Coba ubah filter atau kategori yang dipilih</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Popup Detail Produk -->
    <div id="product-popup" class="fixed inset-0 bg-black/30 backdrop-blur-sm hidden items-center justify-center z-50 transition-all">
        <div class="bg-white w-full max-w-5xl mx-4 rounded-lg shadow-lg relative p-6 grid md:grid-cols-2 gap-6 max-h-[90vh] overflow-y-auto">
            <button onclick="closePopup()" class="absolute top-3 right-4 text-3xl text-gray-500 hover:text-gray-800 z-10">&times;</button>

            <!-- Gambar Produk -->
            <div class="flex flex-col items-center">
                <img id="popup-image" src="" alt="Product" class="w-full h-auto max-h-80 object-cover rounded mb-4 shadow-md">

                <!-- Thumbnail images (placeholder) -->
                <div class="flex gap-2 mt-2">
                    <img src="https://via.placeholder.com/60x40" class="w-16 h-16 object-cover border-2 border-gray-200 rounded cursor-pointer hover:border-green-500" />
                    <img src="https://via.placeholder.com/60x40" class="w-16 h-16 object-cover border-2 border-gray-200 rounded cursor-pointer hover:border-green-500" />
                    <img src="https://via.placeholder.com/60x40" class="w-16 h-16 object-cover border-2 border-gray-200 rounded cursor-pointer hover:border-green-500" />
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="flex flex-col justify-between">
                <div>
                    <!-- Header -->
                    <div class="mb-4">
                        <h2 id="popup-name" class="text-2xl font-bold text-gray-800 mb-2">Nama Produk</h2>
                        <div class="flex items-center gap-2 mb-2">
                            <span id="popup-status" class="inline-block px-3 py-1 text-sm font-semibold bg-green-100 text-green-700 rounded-full">Fresh</span>
                            <span id="popup-quality" class="inline-block px-3 py-1 text-sm font-semibold bg-yellow-100 text-yellow-700 rounded-full">Premium</span>
                        </div>
                        <p id="popup-description" class="text-gray-600 leading-relaxed">Deskripsi Produk</p>
                    </div>

                    <!-- Detail Info -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between">
                            <strong class="text-sm text-gray-500">Kategori:</strong>
                            <span id="popup-category" class="text-sm text-gray-800 font-medium">Kategori</span>
                        </div>
                        <div class="flex justify-between">
                            <strong class="text-sm text-gray-500">Asal Daerah:</strong>
                            <span id="popup-origin" class="text-sm text-gray-800">Asal</span>
                        </div>
                        <div class="flex justify-between">
                            <strong class="text-sm text-gray-500">Satuan:</strong>
                            <span id="popup-unit" class="text-sm text-gray-800">kg</span>
                        </div>
                        <div class="flex justify-between">
                            <strong class="text-sm text-gray-500">Stok:</strong>
                            <span id="popup-stock" class="text-sm text-gray-800">0</span>
                        </div>
                        <div class="flex justify-between">
                            <strong class="text-sm text-gray-500">Status Stok:</strong>
                            <span id="popup-stock-status" class="text-sm font-medium">In Stock</span>
                        </div>
                    </div>
                </div>

                <!-- Price and Cart Section -->
                <div class="border-t pt-4">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div>
                            <span id="popup-price" class="text-3xl font-bold text-green-600">Rp 0</span>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                            <!-- Quantity selector -->
                            <div class="flex items-center border rounded-lg">
                                <button onclick="decreaseQuantity()" class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" id="quantity" value="1" min="1" class="w-16 text-center border-0 focus:ring-0">
                                <button onclick="increaseQuantity()" class="px-3 py-2 text-gray-600 hover:bg-gray-100">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>

                            <button onclick="addToCart()" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow transition-all duration-300 flex items-center gap-2">
                                <i class="fas fa-shopping-cart"></i>
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </div>
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
            document.getElementById('popup-price').textContent = "Rp " + new Intl.NumberFormat('id-ID').format(product.price) + "/" + product.unit;
            document.getElementById('popup-category').textContent = product.category;
            document.getElementById('popup-quality').textContent = product.quality;
            document.getElementById('popup-origin').textContent = product.origin;
            document.getElementById('popup-status').textContent = product.status;
            document.getElementById('popup-unit').textContent = product.unit;
            document.getElementById('product-popup').classList.remove('hidden');
            document.getElementById('product-popup').classList.add('flex');
        }

        function closePopup() {
            document.getElementById('product-popup').classList.remove('flex');
            document.getElementById('product-popup').classList.add('hidden');
        }

        function addToCart() {
            if (!currentProduct) {
                console.error('No product selected');
                alert('Tidak ada produk yang dipilih');
                return;
            }

            const quantity = parseInt(document.getElementById('quantity').value) || 1;

            // Bersihkan data dan pastikan format yang benar
            const requestData = {
                id: String(currentProduct.id), // Pastikan ID adalah string
                name: String(currentProduct.name || ''),
                price: parseFloat(currentProduct.price) || 0,
                image: String(currentProduct.image_url || '').replace(/.*\//, ''), // Ambil hanya nama file
                unit: String(currentProduct.unit || 'pcs'),
                quantity: quantity
            };

            console.log('Sending data to cart:', requestData);

            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },
                body: JSON.stringify(requestData),
            })
                .then(response => {
                    console.log('Response status:', response.status);
                    console.log('Response headers:', response.headers);

                    // Cek jika response bukan JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        return response.text().then(text => {
                            console.log('Non-JSON response:', text);
                            throw new Error('Server returned non-JSON response: ' + text.substring(0, 100));
                        });
                    }

                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);

                    if (data.success) {
                        alert(data.message || 'Produk berhasil ditambahkan ke keranjang!');
                        closePopup();
                        // Reset quantity to 1
                        document.getElementById('quantity').value = 1;
                    } else {
                        alert(data.message || 'Gagal menambahkan produk ke keranjang');
                    }
                })
                .catch(error => {
                    console.error('Error adding to cart:', error);
                    alert('Terjadi kesalahan: ' + error.message);
                });
        }

        // Filter functionality
        document.getElementById('qualityFilter').addEventListener('change', function() {
            filterProducts();
        });

        document.getElementById('priceFilter').addEventListener('change', function() {
            filterProducts();
        });

        function filterProducts() {
            const qualityFilter = document.getElementById('qualityFilter').value;
            const priceFilter = document.getElementById('priceFilter').value;
            const productCards = document.querySelectorAll('.product-card');

            productCards.forEach(card => {
                let showCard = true;

                // Quality filter
                if (qualityFilter && card.dataset.quality !== qualityFilter) {
                    showCard = false;
                }

                // Price filter
                if (priceFilter) {
                    const price = parseFloat(card.dataset.price);
                    switch(priceFilter) {
                        case 'low':
                            if (price >= 25000) showCard = false;
                            break;
                        case 'medium':
                            if (price < 25000 || price > 50000) showCard = false;
                            break;
                        case 'high':
                            if (price <= 50000) showCard = false;
                            break;
                    }
                }

                card.style.display = showCard ? 'block' : 'none';
            });
        }

        // Close popup when clicking outside
        document.getElementById('product-popup').addEventListener('click', function(e) {
            if (e.target === this) {
                closePopup();
            }
        });

        // Close popup with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePopup();
            }
        });
    </script>
    @include('components.footer')
@endsection
