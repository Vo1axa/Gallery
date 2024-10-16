@extends('layouts.app')
<title>Gallery</title>

@section('content')
<style>
    body {
        background-color: #1e1e1e;
    }
    .custom-bounce {
        transition: background-color 0.3s, color 0.3s;
        transition: transform 0.3s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }
</style>

<div class="w-full dark:bg-white/90 bg-slate-300/90 xl:-mt-32 h-36 blur-[170px] z-[0]"></div>
<div class="container mt-4">

<!-- Profile Section -->
<div class="flex justify-center mb-4">
    @if($user->profile_image)
        <img class="rounded-full w-32 h-32 object-cover" 
             src="{{ asset('images/profile/' . $user->profile_image) }}" 
             alt="Profile Picture">
    @else
        <div class="flex items-center justify-center w-32 h-32 bg-gray-300 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="w-16 h-16 text-gray-500">
                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
            </svg>
        </div>
    @endif
</div>
<h2 class="text-center font-light text-black dark:text-white font-barlow text-7xl">{{ $user->username }}</h2>
@if($user->bio != null)
    <p class="text-center">{{ $user->bio }}</p>
@else
    <p class="text-center text-gray-500">This user has no bio yet.</p>
@endif

<!-- Tabs for Posts and Albums -->
<div class="flex justify-center mt-6">
    <a href="{{ route('profile.show', $user->id) }}?section=posts" class="px-4 py-2 mx-2 bg-blue-600 text-white rounded-lg {{ request('section') == 'posts' || request('section') == null ? 'bg-blue-900' : '' }}">
        Posts
    </a>
    <a href="{{ route('profile.show', $user->id) }}?section=albums" class="px-4 py-2 mx-2 bg-blue-600 text-white rounded-lg {{ request('section') == 'albums' ? 'bg-blue-900' : '' }}">
        Albums
    </a>
</div>

<!-- Content Section: Show Posts or Albums -->
@if(request('section') == 'albums')
<h3 class="text-black dark:text-white font-barlow text-3xl ml-4 pl-10">Albums:</h3>
    @if(count($albums) > 0)       
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
            @foreach($albums as $album)
            <div class="flex items-center justify-center">
                <div class="relative w-full bg-white border border-gray-100 rounded-lg text-center hover:shadow-lg transition-transform transform hover:scale-105 duration-300">
                    <a href="{{ route('albums.show', $album->id) }}">
                        @if ($album->galleries->count() > 0)
                            <div class="relative overflow-hidden rounded-t-lg h-48">
                                <img src="{{ asset('images/' . $album->galleries->first()->image) }}" class="w-full h-full object-cover overflow-hidden blur-sm" alt="{{ $album->name }}"/>
                            </div>
                        @else
                            <div class="h-48 w-full bg-gray-200 flex items-center justify-center rounded-t-lg">
                                <span class="text-gray-500 italic">This album is empty...</span>
                            </div>
                        @endif
                    </a>
                    
                    <!-- Profile Image Overlay -->
                    <div class="absolute w-16 h-16 rounded-full bg-white border-4 border-white flex items-center justify-center -mt-8 left-1/2 transform -translate-x-1/2 shadow-lg z-10">
                        @if($album->user->profile_image)
                            <img src="{{ asset('images/profile/' . $album->user->profile_image) }}" class="rounded-full w-full h-full" alt="{{ $album->user->name }}'s Profile Picture" />
                        @else
                            <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 448 512">
                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                                </svg>
                            </div>
                        @endif
                    </div>

                    <div class="pt-12 pb-4">
                        <p class="font-bold text-lg">{{ $album->name }}</p>
                        <p class="text-sm text-gray-500">By <a href="{{ route('profile.show', $album->user->id) }}" class="text-blue-500 hover:text-blue-700">{{ $album->user->username }}</a></p>
                        <p class="text-xs text-gray-400">Posted on: {{ $album->created_at->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <p class="text-black dark:text-white ml-4 text-center">No albums found.</p>
    @endif
@else
    <h3 class="text-black dark:text-white font-barlow text-3xl ml-4 pl-10">Posts:</h3>
    @if(count($galleries) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4" style="grid-auto-flow: dense;">
            @foreach ($galleries as $index => $gallery)
                <div class="group cursor-pointer relative {{ $loop->index % 8 == 0 ? 'md:col-span-2 md:row-span-2' : '' }}">
                    <a href="{{ route('galleries.show', $gallery->id) }}">
                        <div class="relative w-full h-48 md:h-72 lg:h-full overflow-hidden rounded-lg shadow-md">
                            <img src="{{ asset('images/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="h-full w-full object-cover object-center rounded-lg transition-transform duration-1000 transform scale-100 group-hover:scale-150 group-hover:blur-sm"/>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-white font-barlow text-3xl">
                                {{$gallery->title}}
                                <div class="absolute bottom-2 right-2 flex items-center space-x-2">
                                    <svg class="w-6 h-6 fill-red-600" viewBox="0 0 512 512"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                                    <span class="pl-1">{{ $gallery->likes->count() }}</span>
                                    <svg class="w-6 h-6 fill-gray-500" viewBox="0 0 512 512"><path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c0 0 0 0 0 0s0 0 0 0s0 0 0 0c0 0 0 0 0 0l.3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/></svg>
                                    <span class="pl-1">{{ $gallery->comments->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="opacity-0 font-semibold group-hover:opacity-100 transform -translate-y-10 group-hover:-translate-y-12 transition-all duration-300 ease-out custom-bounce text-white mt-2 p-2 rounded-xl shadow-md flex items-center">
                        <p class="text-sm">
                            @if($gallery->user->profile_image)
                                <img class="w-12 h-12 rounded-full" 
                                     src="{{ asset('images/profile/' . $gallery->user->profile_image) }}" 
                                     alt="{{ $gallery->user->name }}'s Profile Picture">
                            @else
                                <div class="w-6 h-6 rounded-full bg-gray-300  flex items-center justify-center mr-1 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 448 512">
                                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                                    </svg>
                                </div>
                            @endif
                            <a class="pl-1" href="{{ route('profile.show', $gallery->user->id) }}">{{ $gallery->user->name }}</a>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-black dark:text-white ml-4 text-center">No Photos have been posted by this user.</p>
    @endif
@endif
</div>
@endsection