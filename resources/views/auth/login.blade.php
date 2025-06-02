<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>

<body class="bg-gray-100 h-screen">
<div class="min-h-screen flex flex-col md:flex-row w-full">
    <div class="relative w-full md:w-1/2 h-screen bg-green-900">
        <div class="h-full relative">
            <img src="{{asset('images/background.jpg')}}" class="object-cover w-full h-full" />
        </div>
    </div>

    <div class="w-full md:w-1/2 h-screen p-8 md:p-12 flex flex-col justify-center bg-white relative">
        <div class="mb-4 flex justify-end">

        </div>

        <div class="max-w-md mx-auto w-full">
            <h2 class="text-5xl font-bold text-gray-800 mb-12">Welcome<br />Back</h2>

            <!-- Display Errors -->
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Display Success Message -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}">
                @csrf
                <!-- Email/ID Admin -->
                <div class="mb-6">
                    <label for="email" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                           value="{{ old('email') }}"
                           placeholder="Enter your email"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('email') border-red-500 @enderror" />
                    @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required
                               placeholder="Enter your password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('password') border-red-500 @enderror" />
                        <!-- Toggle Password Visibility -->
                        <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <svg id="eye-open" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg id="eye-closed" class="h-5 w-5 text-gray-400 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L8.464 8.464M14.12 14.12l1.415 1.415M14.12 14.12L9.878 9.878M14.12 14.12l1.415 1.415"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember me & Forgot password -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}
                        class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded" />
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-gray-700 hover:underline">Forgot Password?</a>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="block text-center w-full bg-green-800 text-white py-3 rounded-md hover:bg-green-900 transition duration-300 font-normal">
                    Login
                </button>
            </form>
        </div>
        <div class="text-sm text-gray-700 flex justify-center p-4">
            Don't have an account?
            <a href="{{route('register')}}" class="ml-1 font-medium hover:underline text-green-800">Register</a>
        </div>
    </div>
</div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eye-open');
        const eyeClosed = document.getElementById('eye-closed');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }
</script>
</body>
</html>
