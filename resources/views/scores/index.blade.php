@extends('layouts.app')

@section('content')
<div class="w-full p-6 bg-white rounded-lg shadow-md pt-20">
    <h2 class="text-2xl font-bold text-center text-gray-700 mb-4">Leaderboard Nilai Siswa</h2>
    
    <a href="{{ route('scores.create') }}" class="px-4 py-2 text-white bg-blue-500 rounded-lg mb-4">Tambah Nilai</a>

    <table class="mt-4 min-w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">Peringkat</th>
                <th class="border border-gray-300 px-4 py-2">Nama</th>
                <th class="border border-gray-300 px-4 py-2">Mata Pelajaran</th>
                <th class="border border-gray-300 px-4 py-2">Rata-rata</th>
                <th class="border border-gray-300 px-4 py-2">Nilai Huruf</th>
                <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $rank = 1;
                $sortedScores = $scores->map(function ($score) {
                    $subjects = json_decode($score->subjects, true);
                    $totalScore = 0;
                    $subjectCount = count($subjects);

                    foreach ($subjects as $subject) {
                        $totalScore += $subject['score'];
                    }

                    $averageScore = $subjectCount > 0 ? $totalScore / $subjectCount : 0;
                    $score->averageScore = $averageScore;
                    return $score;
                })->sortByDesc('averageScore');
            @endphp

            @foreach ($sortedScores as $score)
                @php
                    $subjects = json_decode($score->subjects, true);
                    $totalScore = 0;
                    $subjectCount = count($subjects);
                    
                    foreach ($subjects as $subject) {
                        $totalScore += $subject['score'];
                    }

                    $averageScore = $subjectCount > 0 ? $totalScore / $subjectCount : 0;

                    if ($averageScore >= 90) {
                        $grade = "A";
                    } elseif ($averageScore >= 80) {
                        $grade = "B";
                    } elseif ($averageScore >= 70) {
                        $grade = "C";
                    } elseif ($averageScore >= 60) {
                        $grade = "D";
                    } else {
                        $grade = "E";
                    }
                @endphp

                <tr class="bg-white border-b hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2 font-bold text-center">{{ $rank++ }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $score->student_name }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @foreach ($subjects as $subject)
                            <strong>{{ $subject['name'] }}</strong>: {{ $subject['score'] }} <br>
                        @endforeach
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center font-semibold">
                        {{ number_format($averageScore, 2) }}
                    </td>
                    <td class="border border-gray-300 px-4 py-2 text-center font-bold">
                        @if ($grade == "A")
                            <span class="px-3 py-1 bg-green-500 text-white rounded-lg">A</span>
                        @elseif ($grade == "B")
                            <span class="px-3 py-1 bg-blue-500 text-white rounded-lg">B</span>
                        @elseif ($grade == "C")
                            <span class="px-3 py-1 bg-yellow-500 text-white rounded-lg">C</span>
                        @elseif ($grade == "D")
                            <span class="px-3 py-1 bg-orange-500 text-white rounded-lg">D</span>
                        @else
                            <span class="px-3 py-1 bg-red-500 text-white rounded-lg">E</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('scores.edit', $score->id) }}" class="bg-blue-500 hover:scale-105 duration-300 px-4 py-2 rounded-lg text-white">Edit</a> |
                        <form action="{{ route('scores.destroy', $score->id) }}" method="POST" class="inline-block">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:scale-105 duration-300 px-4 py-2 rounded-lg text-white">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
