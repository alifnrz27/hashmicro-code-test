@extends('layouts.app')

@section('title', 'Character Match')

@section('content')
<form action="{{ route('character.match.check') }}" method="POST" class="mt-4">
    @csrf
    <div>
        <label class="block text-gray-700">First Word</label>
        <input type="text" name="input1" value="{{ old('input1') }}" class="w-full p-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div class="mt-4">
        <label class="block text-gray-700">Password</label>
        <input type="text" name="input2" value="{{ old('input2') }}" class="w-full p-2 mt-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <button type="submit" class="w-full px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">Check</button>
</form>
@endsection
