<!-- Font Awesome untuk ikon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<nav class="bg-white shadow-md py-4 fixed top-0 w-full z-50">
    <div class="container mx-auto px-8 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
            <img src="{{ asset('images/') }}" class="h-auto" alt="Logo">
            <div class="ml-2 text-xl font-bold">
                Grocery
            </div>
        </div>

        <!-- Navigasi -->
        <div class="flex items-center space-x-24">
            <div class="hidden md:flex space-x-14">
                <a href="{{route('pages.home')}}" class="text-[#777E90] font-medium hover:text-[#2A933C]">Home</a>
                <a href="{{route('pages.shop')}}" class="text-[#777E90] font-medium hover:text-[#2A933C]">Shop</a>
                <a href="{{route('pages.contactus')}}" class="text-[#777E90] font-medium hover:text-[#2A933C]">Contact Us</a>
            </div>

            <!-- Ikon Profil + Popup Logout -->
            <div class="relative">
                <button id="profileButton" class="text-[#777E90] font-medium hover:text-[#2A933C] text-2xl focus:outline-none">
                    <i class="fas fa-user-circle"></i>
                </button>

                <!-- Popup profil -->
                <div id="logoutPopup" class="absolute right-0 mt-2 w-56 bg-white rounded shadow-md p-4 hidden z-50">
                    <p class="text-sm text-gray-700 mb-3">
                        Login sebagai <strong>NamaUser</strong>
                    </p>
                    <button id="logoutConfirmBtn" class="w-full text-left text-red-600 hover:underline">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer agar konten tidak tertutup navbar -->
<div class="mt-20"></div>

<!-- Modal Konfirmasi Logout -->
<div id="confirmLogoutModal" class="fixed inset-0 flex items-center justify-center bg-gradient-to-b from-black/20 via-black/30 to-black/20 hidden z-50">
    <div class="bg-white rounded-lg p-6 w-[90%] max-w-sm shadow-xl text-center">
        <p class="text-lg text-gray-800 mb-4">Apakah Anda yakin ingin logout?</p>
        <div class="flex justify-center space-x-4">
            <button id="confirmLogoutYes" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Ya</button>
            <button id="confirmLogoutCancel" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">Batal</button>
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

        // Tutup popup saat klik di luar
        window.addEventListener('click', function () {
            logoutPopup.classList.add('hidden');
        });

        logoutPopup?.addEventListener('click', function (event) {
            event.stopPropagation();
        });

        // Klik logout → tampilkan modal konfirmasi
        logoutConfirmBtn?.addEventListener('click', function () {
            confirmModal.classList.remove('hidden');
            logoutPopup.classList.add('hidden');
        });

        // Klik batal → sembunyikan modal
        confirmCancel?.addEventListener('click', function () {
            confirmModal.classList.add('hidden');
        });

        // Klik ya → aksi logout (kosong, bisa diarahkan nanti)
        confirmYes?.addEventListener('click', function () {
            confirmModal.classList.add('hidden');
            // Contoh: arahkan ke logout route nanti
            // window.location.href = "/logout";
        });
    });
</script>
