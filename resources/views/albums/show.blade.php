@extends('layouts.app')
<title>{{ $album->name }} By: {{ $album->user->username }}</title>

@section('content')
<div class="container mx-auto mt-12 px-6">
    <!-- Album Title -->
    <h1 class="text-8xl font-bold mb-5 text-center font-barlow text-black dark:text-white">{{ $album->name }}</h1>
    
    <!-- Profile Image Overlay -->
    <div class="absolute w-20 h-20 rounded-full bg-white border-4 border-gray-200 dark:border-gray-700 flex items-center justify-center -mt-12 left-1/2 transform -translate-x-1/2 z-10 shadow-lg">
        @if($album->user->profile_image)
            <img src="{{ asset('images/profile/' . $album->user->profile_image) }}" class="rounded-full w-full h-full" alt="{{ $album->user->name }}'s Profile Picture" />
        @else
            <div class="w-full h-full bg-gray-300 flex items-center rounded-full justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 448 512">
                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                </svg>
            </div>
        @endif
    </div>
    <a href="{{ route('profile.show', $album->user->id) }}" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-200 text-center block mt-4">{{ $album->user->username }}</a>
    
    <!-- Edit Album Button -->
    @if (Auth::user()->id == $album->user->id)
        <div class="mt-8">
            <a href="{{ route('albums.edit', $album->id) }}" class="text-blue-600 hover:underline">
                Edit Album
            </a>
        </div>
    @endif
    
    <!-- Link to go back to albums -->
    <div class="mt-8">
        <a href="{{ route('albums.index') }}" class="text-blue-600 hover:underline">
            ← Back to Albums
        </a>
    </div>

    <!-- Display all galleries in the album -->
    @if($album->galleries->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-4">
            @foreach($album->galleries as $index => $gallery)
                <div class="group cursor-pointer relative {{ $loop->index % 8 == 0 ? 'md:col-span-2 md:row-span-2' : '' }}">
                    <a href="{{ route('galleries.show', $gallery->id) }}">
                        <div class="relative w-full h-48 md:h-72 lg:h-full overflow-hidden rounded-lg shadow-lg transition-transform duration-500 transform group-hover:scale-105">
                            <img src="{{ asset('images/' . $gallery->image) }}" 
                                 alt="{{ $gallery->title }}" 
                                 class="h-full w-full object-cover object-center rounded-lg"/>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-white font-barlow text-3xl bg-black bg-opacity-50 rounded-lg">
                                {{$gallery->title}}
                                <div class="absolute bottom-2 right-2 flex items-center space-x-2">
                                    <svg class="w-6 h-6 fill-red-600" viewBox="0 0 512 512">
                                        <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/>
                                    </svg>
                                    <span class="pl-1">{{ $gallery->likes->count() }}</span>
                                    <svg class="w-6 h-6 fill-gray-500" viewBox="0 0 512 512">
                                        <path d="M512 240c0 114.9-114.6 208-256 208c-37.1 0-72.3-6.4-104.1-17.9c-11.9 8.7-31.3 20.6-54.3 30.6C73.6 471.1 44.7 480 16 480c-6.5 0-12.3-3.9-14.8-9.9c-2.5-6-1.1-12.8 3.4-17.4c0 0 0 0 0 0s0 0 0 0s0 0 0 0c0 0 0 0 0 0l.3-.3c.3-.3 .7-.7 1.3-1.4c1.1-1.2 2.8-3.1 4.9-5.7c4.1-5 9.6-12.4 15.2-21.6c10-16.6 19.5-38.4 21.4-62.9C17.7 326.8 0 285.1 0 240C0 125.1 114.6 32 256 32s256 93.1 256 208z"/>
                                    </svg>
                                    <span class="pl-1">{{ $gallery->comments->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="opacity-0 font-semibold group-hover:opacity-100 transform -translate-y-10 group-hover:-translate-y-12 transition-all duration-300 ease-out text-white mt-2 p-2 rounded-xl shadow-md flex items-center">
                        <p class="text-sm flex items-center">
                            @if($gallery->user->profile_image)
                                <img class="w-12 h-12 rounded-full" 
                                     src="{{ asset('images/profile/' . $gallery->user->profile_image) }}" 
                                     alt="{{ $gallery->user->username }}'s Profile Picture">
                            @else
                                <div class="w-6 h-6 rounded-full bg-gray-300 flex items-center justify-center mr-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 448 512">
                                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                                    </svg>
                                </div>
                            @endif
                            <a class="pl-1" href="{{ route('profile.show', $gallery->user->id) }}">{{ $gallery->user->username }}</a>
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-center text-gray-500 mt-8">No images found in this album.</p>
    @endif
</div>
@endsection