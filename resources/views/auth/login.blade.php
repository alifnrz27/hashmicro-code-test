@extends('layouts.app')

@section('title', 'Login')

@section('content')
<form action="{{ route('login') }}" method="POST" class="mt-4">
    @csrf
    <div>
        <label class="block text-gray-700">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        @error('email')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <div class="mt-4">
        <label class="block text-gray-700">Password</label>
        <input type="password" name="password" class="w-full p-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <button type="submit" class="w-full px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Login</button>
</form>

<p class="mt-4 text-sm text-center text-gray-600">
    Don't have an account? 
    <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a>
</p>
@endsection
