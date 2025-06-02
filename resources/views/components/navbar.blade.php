<!-- Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<nav class="bg-white shadow-md py-4 fixed top-0 w-full z-50">
    <div class="container mx-auto px-8 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
            <img src="{{ asset('images/logo.png') }}" class="h-6 mr-1" alt="Logo">
            <div class="ml-2 text-xl font-bold">Grocery</div>
        </div>

        <!-- Navigasi + Search + Cart + Profile -->
        <div class="flex items-center space-x-10">
            <!-- Navigasi -->
            <div class="hidden md:flex space-x-7">
                <a href="{{route('pages.home')}}" class="text-[#777E90] font-medium hover:text-[#2A933C]">Home</a>
                <a href="{{route('pages.shop')}}" class="text-[#777E90] font-medium hover:text-[#2A933C]">Shop</a>
                <a href="{{route('pages.contactus')}}" class="text-[#777E90] font-medium hover:text-[#2A933C]">Contact Us</a>
            </div>

            <!-- Search Bar -->
            <div class="relative hidden md:block">
                <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#2A933C] focus:border-transparent text-sm text-gray-700" />
                <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
            </div>

            <!-- Cart Icon -->
            <div class="relative">
                <a href="{{ route('pages.cart') }}" class="relative bg-white rounded-full p-2 hover:bg-gray-100 transition duration-150 ease-in-out" aria-label="Open cart">
                    <i class="fas fa-shopping-cart text-gray-500 text-xl"></i>
                    <!-- Cart Badge (Optional) -->
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ count(session('cart')) }}
                        </span>
                    @endif
                </a>
            </div>

            <!-- Ikon Profil + Popup Logout -->
            <div class="relative">
                @auth
                    <button id="profileButton" class="text-[#777E90] font-medium hover:text-[#2A933C] text-2xl focus:outline-none">
                        <i class="fas fa-user-circle"></i>
                    </button>

                    <!-- Popup profil -->
                    <div id="logoutPopup" class="absolute right-0 mt-2 w-56 bg-white rounded shadow-md p-4 hidden z-50">
                        <div class="mb-3">
                            <p class="text-sm text-gray-500 mb-1">Login sebagai:</p>
                            <p class="text-sm font-semibold text-gray-800">
                                {{ Auth::user()->name ?? Auth::user()->name ?? 'User' }}
                            </p>
                            @if(Auth::user()->email)
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                            @endif
                        </div>
                        <hr class="mb-3">
                        <button id="logoutConfirmBtn" class="w-full text-left text-red-600 hover:bg-red-50 px-2 py-1 rounded transition">
                            <i class="fas fa-sign-out-alt mr-2"></i>Logout
                        </button>
                    </div>
                @else
                    <!-- Jika user belum login -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('login') }}" class="text-[#777E90] hover:text-[#2A933C] text-sm font-medium">
                            <i class="fas fa-sign-in-alt mr-1"></i>Login
                        </a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('register') }}" class="text-[#777E90] hover:text-[#2A933C] text-sm font-medium">
                            <i class="fas fa-user-plus mr-1"></i>Register
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Spacer agar konten tidak tertutup navbar -->
<div class="mt-20"></div>

<!-- Modal Konfirmasi Logout -->
<div id="confirmLogoutModal" class="fixed inset-0 flex items-center justify-center bg-black/50 hidden z-50">
    <div class="bg-white rounded-lg p-6 w-[90%] max-w-sm shadow-xl text-center">
        <div class="mb-4">
            <i class="fas fa-exclamation-triangle text-yellow-500 text-3xl mb-2"></i>
            <p class="text-lg text-gray-800">Apakah Anda yakin ingin logout?</p>
        </div>
        <div class="flex justify-center space-x-4">
            <!-- Form untuk logout yang proper -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <button id="confirmLogoutYes" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
                <i class="fas fa-check mr-1"></i>Ya, Logout
            </button>
            <button id="confirmLogoutCancel" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
                <i class="fas fa-times mr-1"></i>Batal
            </button>
        </div>
    </div>
</div>

<!-- Script: Toggle popup & konfirmasi logout -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const profileButton = document.getElementById('profileButton');
        const logoutPopup = document.getElementById('logoutPopup');
        const logoutConfirmBtn = document.getElementById('logoutConfirmBtn');
        const confirmModal = document.getElementById('confirmLogoutModal');
        const confirmYes = document.getElementById('confirmLogoutYes');
        const confirmCancel = document.getElementById('confirmLogoutCancel');

        // Toggle popup profil
        profileButton?.addEventListener('click', function (event) {
            event.stopPropagation();
            logoutPopup.classList.toggle('hidden');
        });

        // Close popup when clicking outside
        window.addEventListener('click', function () {
            if (logoutPopup) {
                logoutPopup.classList.add('hidden');
            }
        });

        // Prevent popup from closing when clicking inside
        logoutPopup?.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        // Show confirmation modal
        logoutConfirmBtn?.addEventListener('click', function () {
            confirmModal.classList.remove('hidden');
            logoutPopup.classList.add('hidden');
        });

        // Cancel logout
        confirmCancel?.addEventListener('click', function () {
            confirmModal.classList.add('hidden');
        });

        // Confirm logout
        confirmYes?.addEventListener('click', function () {
            confirmModal.classList.add('hidden');
            // Submit the logout form
            document.getElementById('logout-form').submit();
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !confirmModal.classList.contains('hidden')) {
                confirmModal.classList.add('hidden');
            }
        });
    });
</script>
