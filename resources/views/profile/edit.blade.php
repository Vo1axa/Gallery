<!-- profile/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="text-4xl font-bold mb-5 text-center font-barlow text-black dark:text-white">Edit Profile: {{ $user->name }}</h1>
        
        <form method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="flex flex-col space-y-3">
                <label for="profile_image" class="text-lg font-medium text-black dark:text-white">Profile Image:</label>
                <div class="flex items-center justify-center w-full">
                    @if($user->profile_image)
                        <img src="{{ asset('images/profile/' . $user->profile_image) }}" class="w-40 h-40 rounded-full object-cover" alt="{{ $user->name }}'s Profile Picture" />
                    @else
                        <div class="w-40 h-40 bg-gray-300 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 448 512">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                        </div>
                    @endif
                </div>
                <input type="file" class="form-control dark:bg-gray-700 dark:text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-700" id="profile_image" name="profile_image">
            </div>

            
            <div class="flex flex-col space-y-3">
                <label for="username" class="text-lg font-medium text-black dark:text-white">Username:</label>
                <input type="text" class="form-control dark:bg-gray-700 dark:text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-700" id="username" name="username" value="{{ $user->username }}">
            </div>

            <div class="flex flex-col space-y-3">
                <label for="bio" class="text-lg font-medium text-black dark:text-white">Bio:</label>
                <textarea class="form-control dark:bg-gray-700 dark:text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-700" id="bio" name="bio" rows="5">{{ $user->bio }}</textarea>
            </div>

            <div class="flex flex-col space-y-3">
                <label for="fullname" class="text-lg font-medium text-black dark:text-white">Full Name:</label>
                <input type="text" class="form-control dark:bg-gray-700 dark:text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-700" id="fullname" name="fullname" value="{{ $user->fullname }}">
            </div>

            <div class="flex flex-col space-y-3">
                <label for="address" class="text-lg font-medium text-black dark:text-white">Address:</label>
                <input type="text" class="form-control dark:bg-gray-700 dark:text-white px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-700" id="address" name="address" value="{{ $user->address }}">
            </div>

            <button type="submit" class="w-full bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-md">
                Update Profile
            </button>
        </form>
    </div>
@endsection

