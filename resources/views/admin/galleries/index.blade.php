@extends('layouts.app')
<title>Manage Galleries</title>

@section('content')
<div class="container mx-auto mt-10">
    <div class="container mx-auto mt-5">
        <h1 class="text-2xl font-bold mb-4 text-center text-slate-500 dark:text-gray-50">Manage Galleries</h1>

        {{-- Showing rows info --}}
        <div class="mb-3">
            <p class="text-slate-500 dark:text-gray-50">
                Showing {{ $galleries->count() }} out of {{ $galleries->total() }} galleries
            </p>
        </div>
        
        <div class="overflow-hidden border-b border-gray-200 dark:border-gray-700 shadow sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-slate-50 divide-y divide-gray-200 dark:bg-gray-600 dark:divide-gray-700">
                    @foreach($galleries as $gallery)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $gallery->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $gallery->user->username }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <img src="{{ asset('images/' . $gallery->image) }}" alt="{{ $gallery->title }}" class="h-24 w-24 object-cover">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $gallery->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">{{ $gallery->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">Edit</a>
                                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" style="display: inline-block">
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
            {{ $galleries->links() }} <!-- Pagination -->
        </div>
    </div>
</div>
@endsection
