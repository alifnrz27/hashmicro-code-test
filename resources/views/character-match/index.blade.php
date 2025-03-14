@extends('layouts.app')

@section('title', 'Character Match')

@section('content')
<div class="flex items-center justify-center h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Character Match</h2>
        <form action="{{ route('character.match.check') }}" method="POST" class="mt-4">
            @csrf
            <div>
                <label class="block text-gray-700">First Word</label>
                <input type="text" name="input1" value="{{ old('input1') }}" class="w-full p-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mt-4">
                <label class="block text-gray-700">Second Word</label>
                <input type="text" name="input2" value="{{ old('input2') }}" class="w-full p-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Check</button>
        </form>
    </div>
</div>
@endsection
