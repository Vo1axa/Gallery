@extends('layouts.app')
<title>Albums</title>

@section('content')
<div class="w-full dark:bg-white/90 bg-slate-300/90 xl:-mt-32 h-36 blur-[170px] z-[0]"></div>
<div class="container mt-8">

    <!--Fungsi Searc ketika ada di halaman album-->
    <div class="grid grid-cols-1 grid-rows-2 w-full items-center justify-center font-semibold text-5xl flex-wrap">
        @php
            $searchInput = request()->input('search');
            $results = $albums->isNotEmpty(); // Pastikan $albums diisi dengan hasil pencarian
        
            // Check if there's an album that matches the search input
            $album = \App\Models\Album::where('name', 'like', '%' . $searchInput . '%')->first();
        @endphp
    
        <h1 class="justify-self-center mx-auto text-white font-barlow text-7xl font-light {{ $searchInput ? '-mb-7 pt-12' : '' }}">
            {{ ucfirst($searchInput) }}
        </h1>
        
        @if($searchInput)
            @if($album)
                <div class="flex items-center justify-center">
                    @if($album->cover_image)
                        <img class="rounded-full w-16 h-16 object-cover mr-2" 
                             src="{{ asset('images/albums/' . $album->cover_image) }}" 
                             alt="{{ $album->name }}'s Album Cover">
                    @endif
                    <p class="text-white font-barlow font-thin text-xl">Results</p>
                </div>
            @elseif($results)
                <p class="justify-self-center mx-auto text-white/50 font-barlow font-thin text-xl">Results</p>
            @else
                <p class="justify-self-center mx-auto text-white/50 font-barlow font-thin text-xl">No results found</p>
            @endif
        @endif
    </div>
    
    <!-- Albums grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($albums as $album)
        <div class="flex items-center justify-center">
            <div class="relative w-full bg-slate-50 dark:bg-gray-700  rounded-lg text-center hover:shadow-lg transition-transform transform hover:scale-105 duration-300">
                <a href="{{ route('albums.show', $album->id) }}">
                    @if ($album->galleries->count() > 0)
                        <div class="relative overflow-hidden rounded-t-lg h-48">
                            <img src="{{ asset('images/' . $album->galleries->first()->image) }}" class="w-full h-full object-cover overflow-hidden blur-sm" alt="{{ $album->name }}"/>
                        </div>
                    @else
                        <div class="h-48 w-full bg-gray-200 dark:bg-gray-400 flex items-center justify-center rounded-t-lg">
                            <span class="text-gray-500 dark:text-gray-200 italic">This album is empty...</span>
                        </div>
                    @endif
                </a>
                
                <!-- Profile Image Overlay -->
                <div class="absolute w-16 h-16 rounded-full bg-white border-4 border-slate-50 dark:border-gray-700 flex items-center justify-center -mt-8 left-1/2 transform -translate-x-1/2 z-10">
                    @if($album->user->profile_image)
                        <img src="{{ asset('images/profile/' . $album->user->profile_image) }}" class="rounded-full w-full h-full" alt="{{ $album->user->username }}'s Profile Picture" />
                    @else
                        <div class="w-full h-full bg-gray-300 flex items-center rounded-full justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 448 512">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                        </div>
                    @endif
                </div>

                <div class="pt-12 pb-4">
                    <p class="font-bold text-lg text text-gray-900 dark:text-slate-200 font-barlow">{{ $album->name }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-300">By <a href="{{ route('profile.show', $album->user->id) }}" class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-100">{{ $album->user->username }}</a></p>
                    <p class="text-xs text-gray-400 dark:text-slate-400">Posted on: {{ $album->created_at->format('d M Y') }}</p>
                    <p class="text-xs text-gray-400 dark:text-slate-400">Pictures: {{ $album->galleries->count() }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection