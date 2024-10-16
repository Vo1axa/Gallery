@extends('layouts.app')
<title>Admin - Album Edit : {{ $album->name }} </title>
@section('content')
<div class="container mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4 text-center text-slate-500 dark:text-gray-50">Edit Album</h1>

    <form action="{{ route('admin.albums.update', $album->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Album Name</label>
            <input type="text" name="name" id="name" value="{{ $album->name }}" required class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-600">
        </div>

        <div class="mb-4">
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Update Album</button>
        </div>
    </form>

    <a href="{{ route('admin.albums.index') }}" class="text-sm text-gray-600 hover:underline">Back to Albums</a>
</div>
@endsection
