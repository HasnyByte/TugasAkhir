@extends('layouts.app')

@section('content')
     <!-- Hero Slider -->
        <div class="relative w-full overflow-hidden h-[500px]">
            <div id="heroSlider" class="relative h-full">
                <!-- Slide 1 -->
                <div class="absolute inset-0 transition-opacity duration-1000 opacity-100 slide">
                    <div class="flex h-full bg-[#1A5632] text-white">
                        <div class="p-10 md:p-16 flex flex-col justify-center flex-1">
                            <h2 class="text-3xl md:text-5xl font-bold mb-4">Fresh & Healthy</h2>
                            <h1 class="text-3xl md:text-5xl font-bold mb-6">Organic Food</h1>
                            <p class="text-xl mb-2">SALE UP TO</p>
                            <p class="text-4xl font-bold mb-8">48% OFF</p>
                            <a href="/shop" class="bg-green-600 hover:bg-green-700 rounded-full py-2 px-5 text-white inline-flex items-center text-sm md:text-base whitespace-nowrap max-w-fit">
                                Shop now
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        <img src="{{ asset('images/salad.png') }}" class="w-1/2 h-full object-cover object-left" />
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="absolute inset-0 transition-opacity duration-1000 opacity-0 slide">
                    <div class="relative w-full h-full">
                        <img src="{{ asset('images/bread.jpg') }}" class="absolute inset-0 w-full h-full object-cover z-0" alt="Bread Background" />
                        <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-transparent z-10"></div>
                        <div class="relative z-20 h-full flex flex-col justify-center items-start p-10 md:p-16 text-white">
                            <h2 class="text-3xl md:text-5xl font-bold mb-4">Tasty & Warm</h2>
                            <h1 class="text-3xl md:text-5xl font-bold mb-6">Fresh Bread</h1>
                            <p class="text-xl mb-2">SAVE UP TO</p>
                            <p class="text-4xl font-bold mb-8">30% OFF</p>
                            <a href="/shop" class="bg-yellow-600 hover:bg-yellow-700 rounded-full py-2 px-5 text-white inline-flex items-center text-sm md:text-base whitespace-nowrap max-w-fit">
                                Shop now
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="absolute inset-0 transition-opacity duration-1000 opacity-0 slide">
                    <div class="relative w-full h-full">
                        <img src="{{ asset('images/juice.jpg.webp') }}" class="absolute inset-0 w-full h-full object-cover z-0" />
                        <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-transparent z-10"></div>
                        <div class="relative z-20 h-full flex flex-col justify-center items-start p-10 md:p-16 text-white">
                            <h2 class="text-3xl md:text-5xl font-bold mb-4">Fresh Drinks</h2>
                            <h1 class="text-3xl md:text-5xl font-bold mb-6">Cold & Juicy</h1>
                            <p class="text-xl mb-2">GET NOW</p>
                            <p class="text-4xl font-bold mb-8">Buy 1 Get 1</p>
                            <a href="/shop" class="bg-red-900 hover:bg-blue-700 rounded-full py-2 px-5 text-white inline-flex items-center text-sm md:text-base whitespace-nowrap max-w-fit">
                                Shop now
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dot navigation -->
                <div class="absolute bottom-6 left-16 flex space-x-2 z-20">
                    <span class="w-2 h-2 bg-white rounded-full opacity-100 dot"></span>
                    <span class="w-2 h-2 bg-white rounded-full opacity-50 dot"></span>
                    <span class="w-2 h-2 bg-white rounded-full opacity-50 dot"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const slides = document.querySelectorAll("#heroSlider .slide");
            const dots = document.querySelectorAll(".dot");
            let current = 0;

            setInterval(() => {
                slides[current].classList.remove("opacity-100");
                slides[current].classList.add("opacity-0");
                dots[current].classList.remove("opacity-100");
                dots[current].classList.add("opacity-50");

                current = (current + 1) % slides.length;

                slides[current].classList.remove("opacity-0");
                slides[current].classList.add("opacity-100");
                dots[current].classList.remove("opacity-50");
                dots[current].classList.add("opacity-100");
            }, 5000);
        });
    </script>

    <!-- Features Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-12">
        @foreach ([
     ['icon' => 'delivery-truck.png', 'title' => 'Free Shipping', 'desc' => 'Free shipping with discount'],
     ['icon' => 'headphones.png', 'title' => 'Great Support 24/7', 'desc' => 'Instant access to Contact'],
     ['icon' => 'shopping-bag1.png', 'title' => '100% Secure Payment', 'desc' => 'We ensure your money is safe'],
     ['icon' => 'package.png', 'title' => 'Money-Back Guarantee', 'desc' => '30 days money-back'],
 ] as $feature)

            <div class="flex items-center justify-center bg-gray-50 p-6 rounded-md border border-gray-100">
                <div class="p-3 bg-gray-100 rounded-full mr-4">
                    <img src="{{ asset('images/' . $feature['icon']) }}" class="w-10 h-10" />
                </div>

                <div>
                    <h3 class="font-bold text-lg">{{ $feature['title'] }}</h3>
                    <p class="text-sm text-gray-500">{{ $feature['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</main>
    <section class="py-10">
    <div class="container mx-auto px-4">
        <h4 style="color: #71B53A; "class="font-bold text-center">Categories</h4>
        <h2 class="text-2xl font-bold text-center mb-8">Shop by Top Categories</h2>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @php
                $categories = [
                    ['name' => 'Fresh Fruit', 'image' => asset('images/fresh-fruits.jpeg')],
                    ['name' => 'Fresh Vegetables', 'image' => asset('images/Fresh-Vegetables.jpg')],
                    ['name' => 'Meat & Fish', 'image' => asset('images/meat-fish.jpg')],
                    ['name' => 'Snacks', 'image' => asset('images/snack.jpg.webp')],
                    ['name' => 'Eggs & Dairy', 'image' => asset('images/egg-dairy.jpg')],
                    ['name' => 'Bakery & Pastry', 'image' => asset('images/bakery.jpg')],
                    ['name' => 'Honey & Jam', 'image' => asset('images/honey-jam.jpg')],
                    ['name' => 'Cooking', 'image' => asset('images/cooking.jpg')],
                    ['name' => 'Breakfast', 'image' => asset('images/Breakfast.jpg')],
                    ['name' => 'Beverages', 'image' => asset('images/beverages.jpg')],
                    ['name' => 'Fruits Juice', 'image' => asset('images/fresh-fruit-juice.jpg')],
                    ['name' => 'Tea', 'image' => asset('images/tea.jpg')],
                ];
            @endphp


            @foreach($categories as $category)
                <a href="#" class="flex flex-col items-center p-4 border rounded-md transition-all hover:shadow-md">
                    <div class="w-16 h-16 rounded-full mb-3 overflow-hidden">
                        <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}" class="w-full h-full object-cover" />
                    </div>
                    <h3 class="text-sm text-center font-medium">{{ $category['name'] }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</section>

    @php
    $featuredProducts = [
        ['name' => 'Chinese Cabbage', 'price' => 14.99, 'image' => asset('images/cabbage.png'), 'sku' => '2,51,594', 'discount' => 64],
        ['name' => 'Green Lettuce', 'price' => 14.99, 'image' => asset('images/lettuce.png')],
        ['name' => 'Green Chili', 'price' => 14.99, 'image' => asset('images/chili.png')],
        ['name' => 'Corn', 'price' => 14.99, 'image' => asset('images/corn.png')],
    ];

    $tabs = [
        'Hot Deals' => [
            ['name' => 'Green Apple', 'price' => 14.99, 'image' => asset('images/greenapple.png')],
            ['name' => 'Indian Malta', 'price' => 14.99, 'image' => asset('images/indianmalta.png')],
            ['name' => 'Green Lettuce', 'price' => 14.99, 'image' => asset('images/lettuce.png')],
        ],
        'Best Seller' => [
            ['name' => 'Eggplant', 'price' => 14.99, 'image' => asset('images/eggplant.png')],
            ['name' => 'Red Capsicum', 'price' => 14.99, 'old_price' => 20.99, 'image' => asset('images/redcapsicum.png')],
            ['name' => 'Red Tomatos', 'price' => 14.99, 'image' => asset('images/redtomatos.png')],
        ],
        'Top Rated' => [
            ['name' => 'Big Potatos', 'price' => 14.99, 'image' => asset('images/bigpotatos.png')],
            ['name' => 'Corn', 'price' => 14.99, 'old_price' => 20.99, 'image' => asset('images/corn.png')],
            ['name' => 'Fresh cauliflower', 'price' => 14.99, 'image' => asset('images/freshcauliflower.png')],
        ],
    ];
@endphp

<section class="container mx-auto px-4 py-12">
    <!-- Header -->
    <div class="text-center mb-10">
        <h4 class="font-bold text-center text-green-600">PRODUCTS</h4>
        <h2 class="text-2xl font-bold text-center mb-8">Our Featured Products</h2>
    </div>

    <!-- Featured Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-16">
        <!-- Summer Sale Banner -->
        <div class="col-span-1 md:col-span-1 bg-gray-100 rounded-lg overflow-hidden relative">
            <!-- Image as background -->
            <img src="{{ asset('images/summer.png') }}" class="absolute inset-0 w-full h-full object-cover" alt="Summer sale">

            <!-- Text overlay (in front of image) -->
            <div class="p-6 relative z-10 text-center flex items-center flex-col pt-10 mt-8">
                <h3 class="text-sm font-bold uppercase text-black mb-2 text-center">SUMMER SALE</h3>
                <h1 class="text-4xl text-green-600 font-bold mb-4">75% off</h1>
            </div>

            <!-- Shop Now button (centered) -->
            <div class="relative z-10 flex justify-center pb-10 mt-12">
                <a href="#" class="bg-white text-green-600 px-6 py-3 rounded-full font-semibold hover:bg-green-50 transition-colors flex items-center">
                    Shop Now
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Featured Products -->
        @foreach ($featuredProducts as $product)
            <div
                class="border rounded-lg p-4 transition-all duration-200 hover:border-green-500 relative group cursor-pointer"
                onclick="showProductDetail(
                    '{{ $product['name'] }}',
                    {{ $product['price'] }},
                    '{{ $product['image'] }}',
                    '{{ $product['sku'] ?? '2,51,594' }}',
                    {{ isset($product['discount']) ? $product['discount'] : 'null' }},
                    {{ isset($product['old_price']) ? $product['old_price'] : 'null' }}
                )"
            >
                <div class="mb-4 relative">
                    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-full h-48 object-contain">
                </div>

                <h4 class="text-gray-800 font-medium mb-1">{{ $product['name'] }}</h4>
                <p class="text-gray-900 font-semibold mb-2">${{ number_format($product['price'], 2) }}</p>

                <div class="text-amber-400 flex mb-4">
                    <span>★</span>
                    <span>★</span>
                    <span>★</span>
                    <span>★</span>
                    <span class="text-gray-300">★</span>
                </div>

                <!-- Product Actions -->
                <div class="absolute bottom-4 right-4">
                    <button class="bg-gray-100 text-gray-400 p-2 rounded-full hover:bg-green-50 hover:text-green-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Category Tabs Section -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Category Columns -->
        @foreach ($tabs as $category => $products)
            <div class="col-span-1">
                <h3 class="text-xl font-bold mb-6">{{ $category }}</h3>
                <div class="space-y-6">
                    @foreach ($products as $product)
                        <div
                            class="flex items-center gap-4 border rounded-lg p-3 transition-all duration-200 hover:border-green-500 cursor-pointer group"
                            onclick="showProductDetail(
                                '{{ $product['name'] }}',
                                {{ $product['price'] }},
                                '{{ $product['image'] }}',
                                '{{ $product['sku'] ?? '2,51,594' }}',
                                {{ isset($product['discount']) ? $product['discount'] : 'null' }},
                                {{ isset($product['old_price']) ? $product['old_price'] : 'null' }}
                            )"
                        >
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-20 h-20 object-contain">

                            <div class="flex-1">
                                <h4 class="font-medium text-gray-800">{{ $product['name'] }}</h4>
                                <div class="flex items-center gap-2 mt-1">
                                    @if (!empty($product['old_price']))
                                        <span class="line-through text-gray-400">${{ number_format($product['old_price'], 2) }}</span>
                                    @endif
                                    <span class="font-semibold">${{ number_format($product['price'], 2) }}</span>
                                </div>

                                <div class="text-amber-400 flex text-sm mt-1">
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span>★</span>
                                    <span class="text-gray-300">★</span>
                                </div>
                            </div>

                            <!-- Product Actions -->
                            <div class="flex flex-col gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="text-gray-400 hover:text-green-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <!-- Promo Banner -->
        <div class="relative col-span-1 rounded-lg overflow-hidden border border-yellow-300 flex flex-col justify-between max-h-[420px] h-[420px]">
        <img src="{{ asset('images/37%.png') }}" class="w-full h-full object-cover" alt="Promo banner">

            {{-- Gradient Overlay --}}
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/20 to-transparent p-4 flex flex-col justify-center text-center text-white">
            <h1 class=" uppercase font-bold text-black text-3xl">HOT SALE</h1>
                <h3 class="text-3xl font-bold my-4">Save 37% on<br>Every Order</h3>
                <a href="/shop"
                   class="bg-white text-green-600 px-6 py-3 rounded-full font-semibold inline-flex items-center justify-center mt-4 hover:bg-green-50 transition-colors mx-auto">
                    Shop Now
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Include Product Detail Modal Component -->
    {{-- @include('components.detail') --}}
</section>

    <section class="bg-black text-white py-8">
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row items-center justify-between px-4">
            <div class="flex items-center mb-4 md:mb-0">
                <div class="bg-[#71B53A] rounded-full p-3 mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6 text-white" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-semibold">Subscribe to our newsletter</h3>
                    <p class="text-sm text-gray-300">Get updates about our latest products</p>
                </div>
            </div>

            <div class="flex w-full md:w-auto">
                <input type="email"
                       placeholder="Your email address"
                       class="px-4 py-2 rounded-l-md w-full md:w-64 text-black  bg-white" />
                <button class="rounded-l-none bg-[#71B53A] hover:bg-green-700 text-white px-4 py-2 rounded-r-md">
                    Subscribe
                </button>
            </div>

            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="#" class="text-white hover:text-[#71B53A]">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="text-white hover:text-[#71B53A]">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="text-white hover:text-[#71B53A]">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
