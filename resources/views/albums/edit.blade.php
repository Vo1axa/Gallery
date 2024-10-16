@extends('layouts.app')

@section('content')
    <div class="container max-w-md mx-auto mt-10">
        <h1 class="text-4xl font-bold text-center">Edit Album: </h1>
        <h1 class="text-4xl font-bold text-center">{{ $album->name }}</h1>

        <div class="container max-w-md mx-auto mt-10">
        <form method="POST" action="{{ route('albums.update', $album->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Album Name:</label>
                <input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" value="{{ $album->name }}">
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">
                Update Album
            </button>
        </form>
        </div>
    </div>
@endsection
