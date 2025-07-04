
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Register</title>
</head>

<body class="bg-gray-100 h-screen">
<div class="min-h-screen flex flex-col md:flex-row w-full">
    <div class="relative w-full md:w-1/2 h-screen bg-green-900">
        <div class="h-full relative">
            <img src="{{asset('images/background.jpg')}}" class="object-cover w-full h-full" />
        </div>
    </div>

    <div class="w-full md:w-1/2 h-screen p-8 md:p-12 flex flex-col justify-center bg-white relative">
        <div class="max-w-md mx-auto w-full">
            <h2 class="text-5xl font-bold text-gray-800 mb-12">Create<br />Account</h2>

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
                <script>
                    setTimeout(function() {
                        window.location.href = "{{ route('login') }}";
                    }, 2000);
                </script>
            @endif

            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <div class="mb-6">
                    <label for="nama_user" class="block text-gray-700 mb-2">Nama</label>
                    <input type="text" name="nama_user" id="nama_user" autocomplete="name"
                           value="{{ old('nama_user') }}"
                           placeholder="Enter your name"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('nama_user') border-red-500 @enderror"
                           required />
                    @error('nama_user')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email_user" class="block text-gray-700 mb-2">Email</label>
                    <input type="email" name="email_user" id="email_user" autocomplete="email"
                           value="{{ old('email_user') }}"
                           placeholder="Enter your email"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('email_user') border-red-500 @enderror"
                           required />
                    @error('email_user')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_user" class="block text-gray-700 mb-2">Password</label>
                    <input type="password" name="password_user" id="password_user" autocomplete="new-password"
                           placeholder="Enter your password"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600 @error('password_user') border-red-500 @enderror"
                           required />
                    @error('password_user')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_user_confirmation" class="block text-gray-700 mb-2">Confirm Password</label>
                    <input type="password" name="password_user_confirmation" id="password_user_confirmation" autocomplete="new-password"
                           placeholder="Reenter your password"
                           class="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-600"
                           required />
                </div>

                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center">
                        <input type="checkbox" id="terms"
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded" required />
                        <label for="terms" class="ml-2 block text-sm text-gray-700">Accept all terms & Conditions</label>
                    </div>
                </div>

                <button type="submit"
                        class="block text-center w-full bg-green-800 text-white py-3 rounded-md hover:bg-green-900 transition duration-300 font-normal">
                    Create Account
                </button>
            </form>
        </div>
        <div class="text-sm text-gray-700 flex justify-center p-4">
            Already have account?
            <a href="{{route('login')}}" class="ml-1 font-medium hover:underline text-green-800">Login</a>
        </div>
    </div>
</div>
</body>
</html>
