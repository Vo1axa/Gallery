@extends('layouts.app')
<title>Admin Dashboard</title>

@section('content')
<div class="container mx-auto mt-10">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-slate-700 dark:text-white">Admin Dashboard</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-gray-50 dark:bg-slate-700 rounded-lg shadow-lg p-6 text-center transition-transform transform hover:scale-105">
            <div class="flex justify-center items-center mb-4">
                <div class="bg-blue-500 text-white rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-12 h-12">
                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                    </svg>
                </div>
            </div>
            <h5 class="text-xl font-semibold text-slate-700 dark:text-white">Users</h5>
            <p class="text-gray-600 dark:text-gray-300">Total Users: {{ $userCount }}</p>
            <a href="{{ route('admin.users') }}" class="mt-4 inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 dark:bg-blue-700 dark:hover:bg-blue-800 transition">
                Manage Users
            </a>
        </div>
        <div class="bg-gray-50 dark:bg-slate-700 rounded-lg shadow-lg p-6 text-center transition-transform transform hover:scale-105">
            <div class="flex justify-center items-center mb-4">
                <div class="bg-green-500 text-white rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12">
                        <path d="M64 480H448c35.3 0 64-28.7 64-64V160c0-35.3-28.7-64-64-64H288c-10.1 0-19.6-4.7-25.6-12.8L243.2 57.6C231.1 41.5 212.1 32 192 32H64C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64z"/>
                    </svg>
                </div>
            </div>
            <h5 class="text-xl font-semibold text-slate-700 dark:text-white">Albums</h5>
            <p class="text-gray-600 dark:text-gray-300">Total Albums: {{ $albumCount }}</p>
            <a href="{{ route('admin.albums.index') }}" class="mt-4 inline-block bg-green-500 text-white font-semibold py-2 px-4 rounded hover:bg-green-600 dark:bg-green-700 dark:hover:bg-green-800 transition">
                Manage Albums
            </a>
        </div>
        <div class="bg-gray-50 dark:bg-slate-700 rounded-lg shadow-lg p-6 text-center transition-transform transform hover:scale-105">
            <div class="flex justify-center items-center mb-4">
                <div class="bg-red-500 text-white rounded-full p-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-12 h-12">
                        <path d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/>
                    </svg>
                </div>
            </div>
            <h5 class="text-xl font-semibold text-slate-700 dark:text-white">Galleries</h5>
            <p class="text-gray-600 dark:text-gray-300">Total Galleries: {{ $galleryCount }}</p>
            <a href="{{ route('admin.galleries.index') }}" class="mt-4 inline-block bg-red-500 text-white font-semibold py-2 px-4 rounded hover:bg-red-600 dark:bg-red-700 dark:hover:bg-red-800 transition">
                Manage Galleries
            </a>
        </div>
    </div>

    <div class="mt-10">
        <h2 class="text-2xl font-semibold mb-4 text-slate-700 dark:text-white">User and Gallery Charts</h2>
        <form action="{{ route('admin.dashboard') }}" method="get">
            <select name="year" class="bg-gray-50 dark:bg-slate-800 text-slate-700 dark:text-gray-300 rounded border border-gray-300 dark:border-slate-700" onchange="this.form.submit()">
                @foreach($years as $y)
                    <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                @endforeach
            </select>
        </form>

        <div class="bg-gray-50 dark:bg-slate-400 rounded-lg shadow-lg p-6 mt-6">
            <canvas id="registrationChart" class="w-full h-48"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('registrationChart').getContext('2d');
    const registrationChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ],
            datasets: [
                {
                    label: 'New Users',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    pointRadius: 5,
                    data: {{ json_encode($newUsersData) }}
                },
                {
                    label: 'New Galleries',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    pointRadius: 5,
                    data: {{ json_encode($newGalleriesData) }}
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection

