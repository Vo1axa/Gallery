@extends('layouts.app')
<title>{{ $user->name }}'s Profile</title>
@section('content')

<div class="container mx-auto mt-5">
    <div class="w-full bg-white/90 xl:-mt-32 h-32 blur-[170px] "></div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Profile Section -->
        <div class="md:col-span-1 bg-white p-6 rounded-lg shadow-lg">
            <!-- Profile Image -->
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
            <!-- User Info -->
            <h2 class="text-center text-xl font-bold">{{ $user->name }}</h2>
            <p class="text-center text-gray-600">{{ $user->bio }}</p>
        </div>

        <!-- Gallery Section -->
        <div class="md:col-span-2 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-bold mb-4">{{$user->name}}'s Posts </h3>

            @if($galleries->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($galleries as $gallery)
                    <div class="group cursor-pointer relative">
                        <div class="relative w-full h-48 bg-gray-100 overflow-hidden">
                            <img
                                src="{{ asset('images/' . $gallery->image) }}"
                                alt="{{ $gallery->title }}"
                                class="w-full h-full object-contain rounded-lg transition-transform transform scale-100 group-hover:scale-105"/>

                            <!-- Title in bottom left of the image -->
                            <div class="italic absolute bottom-0 left-0 bg-black bg-opacity-50 text-white text-sm p-2">
                                {{ $gallery->title }}
                            </div>

                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('galleries.show', $gallery->id) }}" class="bg-white/45 text-gray-800/50 px-4 py-2 rounded-lg hover:bg-gray-200 transition-colors">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-600">This user hasn't posted any images yet.</p>
            @endif
        </div>

    </div>
</div>
@endsection
