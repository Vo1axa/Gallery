@extends('layouts.app')
<title>Admin - Manage Albums</title>
@section('content')
<div class="container mx-auto mt-10">
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold mb-4 text-center text-slate-500 dark:text-gray-50">Manage Albums</h1>

        {{-- Showing rows info --}}
        <div class="mb-3">
            <p class="text-slate-500 dark:text-gray-50">
                Showing {{ $albums->count() }} out of {{ $albums->total() }} albums
            </p>
        </div>
        
        <div class="overflow-hidden border-b border-gray-200 dark:border-gray-700 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Album Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Images</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-50 divide-y divide-gray-200 dark:bg-gray-600 dark:divide-gray-700">
                    @foreach($albums as $album)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $album->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $album->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $album->user->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $album->galleries->count() }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.albums.edit', $album->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                                <form action="{{ route('admin.albums.destroy', $album->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Showing pagination --}}
        <div class="mt-4">
            {{ $albums->links() }} <!-- Pagination -->
        </div>


       {{-- Dropdown to select an album and view images --}}
        <div class="mt-6">
            <h2 class="text-xl font-bold mb-4 text-center text-slate-500 dark:text-gray-50">View Images in Album</h2>
            <form action="" method="GET" class="flex justify-center mb-4" id="albumForm">
                <select name="album_id" id="albumSelect" class="border text-slate-500 dark:text-gray-50 border-gray-300 rounded-md p-2 dark:border-gray-700 dark:bg-gray-800">
                    <option value="">Select an Album</option>
                    @foreach($albums as $album)
                        <option value="{{ $album->id }}">{{ $album->name }}</option>
                    @endforeach
                </select>
                <noscript><button type="submit" class="ml-2 bg-blue-600 text-white rounded-md p-2 hover:bg-blue-700">View Images</button></noscript>
            </form>
        </div>





                {{-- Display Images if an album is selected --}}
        @if(isset($album) && $images->isNotEmpty())
        <h3 class="text-lg font-semibold mb-2 text-slate-500 dark:text-gray-50">Images in Album: {{ $album->name }}</h3>
        <div class="overflow-hidden border-b border-gray-200 dark:border-gray-700 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-50 divide-y divide-gray-200 dark:bg-gray-600 dark:divide-gray-700">
                    @foreach($images as $image)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $image->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $image->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ asset('images/' . $album->path) }}" alt="{{ $album->title }}" class="h-24 w-24 object-cover">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <form action="{{ route('admin.galleries.destroy', $album->id) }}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>
      @endif
    </div>
</div>
        {{-- Select Album Script --}}

<script>
    document.getElementById('albumSelect').addEventListener('change', function() {
        const albumId = this.value;
        const form = document.getElementById('albumForm');
        if (albumId) {
            // Update the action URL to include the album ID
            form.action = "{{ url('admin/albums') }}/" + albumId + "/images";
            form.submit();
        } else {
            form.action = ""; // Reset action if no album is selected
        }
    });
</script>
@endsection
