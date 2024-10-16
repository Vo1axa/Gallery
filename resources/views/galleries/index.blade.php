@extends('layouts.app')
<title>Gallery</title>

@section('content')
<style>

    body{
        background-color: #1e1e1e;
    }

    .custom-bounce {
        transition: background-color 0.3s, color 0.3s;
        transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }
</style>

<div class="w-full dark:bg-white/90 bg-slate-300/90 xl:-mt-32 h-36 blur-[170px] z-[0]"></div>
<div class="container mt-4">
    

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <!--Fungsi Search ketika ada di halaman Gallery-->
    <div class="grid grid-cols-1 grid-rows-2 w-full items-center justify-center font-semibold text-5xl flex-wrap">
        @php
            $searchInput = request()->input('search');
            $results = $galleries->isNotEmpty();
            $user = \App\Models\User::where('username', 'like', '%' . $searchInput . '%')->first();
        @endphp

        <h1 class="justify-self-center mx-auto text-slate-700 dark:text-slate-50/80  font-barlow text-7xl font-light {{ $searchInput ? '-mb-7 pt-12' : '' }}">
            {{ ucfirst($searchInput) }}
        </h1>
    
        @if($searchInput)
            @if($user)
                <div class="flex items-center justify-center">
                    @if($user->profile_image)
                        <img class="rounded-full w-16 h-16 object-cover mr-2" 
                             src="{{ asset('images/profile/' . $user->profile_image) }}" 
                             alt="{{ $user->username }}'s Profile Picture">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gray-300 flex items-center justify-center mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-8 h-8 text-gray-500">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                        </div>
                    @endif
                    <p class="text-white font-barlow font-thin text-xl">{{ $user->username }}</p>
                </div>
            @elseif($results)
                <p class="justify-self-center mx-auto text-slate-900 dark:text-white/50 font-barlow font-thin text-xl">Results</p>
            @else
                <p class="justify-self-center mx-auto text-slate-900 dark:text-white/50 font-barlow font-thin text-xl">No results found</p>
            @endif
        @endif
    </div>
    
    <!-- Card Grid Layout -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4" style="grid-auto-flow: dense;">

        @foreach ($galleries as $index => $gallery)
            <!-- Condition to enlarge specific images -->
            <div class="group cursor-pointer relative {{ $loop->index % 8 == 0 ? 'md:col-span-2 md:row-span-2' : '' }}">
                <!-- Image -->
                <a href="{{ route('galleries.show', $gallery->id) }}">
                    <div class="relative w-full h-48 md:h-72 lg:h-full overflow-hidden rounded-lg shadow-md">
                        <img src="{{ asset('images/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="h-full w-full object-cover object-center rounded-lg transition-transform duration-1000 transform scale-100 group-hover:scale-150 group-hover:blur-sm"/>

                        
                        <!-- Eye icon and Like count on hover -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-white font-barlow text-3xl">
                            {{$gallery->title}}

                            <div class="absolute bottom-2 right-2 flex items-center space-x-2">
                                <svg class="w-6 h-6 fill-red-600" viewBox="0 0 512 512">
                                    <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                </svg>
                                <span class="pl-1">{{ $gallery->likes->count() }}</span>

                                <svg class="w-6 h-6 fill-gray-500" viewBox="0 0 512 512">
                                    <path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c0 0 0 0 0 0s0 0 0 0c0 0 0 0 0 0l.3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/>
                                </svg>
                                <span class="pl-1">{{ $gallery->comments->count() }}</span>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Content -->
                <div class="opacity-0 font-semibold group-hover:opacity-100 transform -translate-y-10 group-hover:-translate-y-12 transition-all duration-300 ease-out custom-bounce text-white mt-2 p-2 rounded-xl shadow-md flex items-center">
                    <!-- Download button positioned at the top right -->
                    <a href="{{ route('galleries.download', $gallery->id) }}" class="absolute bottom-12 right-2 text-sm text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded-full">
                        Download
                    </a>
                    <p class="text-sm"><span class="font-bold pl-1"></span>
                        @if($gallery->user->profile_image)
                        <img class="w-12 h-12 rounded-full " 
                             src="{{ asset('images/profile/' . $gallery->user->profile_image) }}" 
                             alt="{{ $gallery->user->username }}'s Profile Picture">
                    @else
                        <div class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center mr-1 ">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 448 512">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                        </div>
                    @endif
                    <a class="pl-1" href="{{ route('profile.show', $gallery->user->id) }}"> {{ $gallery->user->username }}</a></p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
