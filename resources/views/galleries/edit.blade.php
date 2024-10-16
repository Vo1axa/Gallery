@extends('layouts.app')
<title>Edit {{ old('title', $gallery->title) }}</title>
@section('content')
<div class="sm:max-w-4xl w-full mx-auto p-11 bg-white dark:bg-[#3f3f3f] flex flex-row space-x-8"> <!-- Flexbox added -->
    <div class="sm:max-w-4xl w-full mx-auto p-10 bg-white flex flex-row space-x-8"> <!-- Flexbox added here -->
        
        <!-- Form Section -->
        <div class="w-2/3">
            <div class="text-center">
                <h2 class="mt-5 text-3xl font-bold text-gray-900 font-barlow">Edit Here!</h2>
                <p class="mt-2 text-sm text-gray-400">Edit your post here...</p>
            </div>
            <form class="mt-8 space-y-3" action="{{ route('galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title Field -->
                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Title</label>
                    <input class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                           type="text"
                           id="title"
                           name="title"
                           value="{{ old('title', $gallery->title) }}"
                           placeholder="My Adventure!">
                </div>

                <!-- Description Field -->
                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Description</label>
                    <textarea class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500"
                              id="description"
                              name="description"
                              placeholder="Describe your adventure...">{{ old('description', $gallery->description) }}</textarea>
                </div>

                <!-- File Input Field -->
                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Change The File</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                            <div class="h-full w-full text-center flex flex-col items-center justify-center">
                                <p class="pointer-none text-gray-500">
                                    <span class="text-sm">Drag and drop</span> files here <br /> or 
                                </p>
                            </div>
                            <input type="file" id="image" name="image" class="flex justify-center" accept="image/*" onchange="loadPreview(event)">
                        </label>
                    </div>
                </div>

                <!-- File Type Information -->
                <p class="text-sm text-gray-300">
                    <span>File type: PNG, JPG, JPEG, SVG, GIF</span>
                </p>

                <!-- Save Button -->
                <div>
                    <button type="submit" class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4 rounded-full tracking-wide font-semibold focus:outline-none hover:bg-blue-600 cursor-pointer transition ease-in duration-300">
                        Save Edits
                    </button>
                    <a href="{{ route('galleries.index') }}" class="text-blue-500 hover:underline">Back to Gallery</a>
                </div>
            </form>
        </div>

        <!-- Image Preview Section -->
        <div class="w-1/3">
            <h3 class="text-center text-lg font-bold text-gray-700 mb-4">Image Preview</h3>
            <img id="preview-image" class="w-full h-auto rounded-lg shadow-lg" 
                 src="{{ asset('images/' . $gallery->image) }}" 
                 alt="Current image">
        </div>

    </div>
</div>

<script>
    // Image Preview Script
    function loadPreview(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview-image');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
