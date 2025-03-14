@extends('layouts.app')

@section('content')
    <div class="pt-20">
        <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
            <h2 class="text-2xl font-semibold text-gray-700 text-center mb-6">
                {{ isset($score) ? 'Edit Nilai Mahasiswa' : 'Tambah Nilai Mahasiswa' }}
            </h2>
    
            <form action="{{ isset($score) ? route('scores.update', $score->id) : route('scores.store') }}" method="POST" class="space-y-4">
                @csrf
                @isset($score) @method('PUT') @endisset
    
                <div>
                    <label class="block text-gray-600 font-medium">Nama Mahasiswa:</label>
                    <input type="text" name="student_name" value="{{ old('student_name', isset($score) ? $score->student_name : '') }}"
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-blue-300"
                        required>
                </div>
    
                <div x-data="{ subjects: {{ json_encode(old('subjects', isset($score) ? json_decode($score->subjects, true) : [['name' => '', 'score' => '']])) }} }">
                    <label class="block text-gray-600 font-medium">Mata Pelajaran & Nilai:</label>
                    <template x-for="(subject, index) in subjects" :key="index">
                        <div class="flex gap-2 items-center mb-2">
                            <input type="text" x-model="subject.name" :name="'subjects['+index+'][name]'" 
                                class="flex-1 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                                placeholder="Mata Pelajaran" required>
    
                            <input type="number" x-model="subject.score" :name="'subjects['+index+'][score]'" 
                                class="w-20 p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300"
                                placeholder="Nilai" required min="0" max="100">
    
                            <button type="button" @click="subjects.splice(index, 1)" x-show="subjects.length > 1"
                                class="px-3 py-1 text-sm bg-red-500 text-white rounded-md hover:bg-red-600">
                                Hapus
                            </button>
                        </div>
                    </template>
    
                    <button type="button" @click="subjects.push({ name: '', score: '' })"
                        class="mt-2 px-3 py-1 text-sm bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        + Tambah Mata Pelajaran
                    </button>
                </div>
    
                <div class="flex flex-col gap-2">
                    <button type="submit"
                        class="w-full bg-green-500 text-white py-2 rounded-md font-semibold hover:bg-green-600 transition">
                        Simpan
                    </button>
                    <a href="{{ route('scores.index') }}"
                        class="w-full text-center bg-gray-500 text-white py-2 rounded-md font-semibold hover:bg-gray-600 transition">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
