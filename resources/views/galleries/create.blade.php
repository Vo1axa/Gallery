@extends('layouts.app')
<title>Create</title>
@section('content')

 <div>
    <div class="sm:max-w-4xl w-full mx-auto p-11 bg-white dark:bg-[#3f3f3f] flex flex-row space-x-8"> 
        
        <!-- Form Section -->
        <div class="w-2/3">
            <div class="text-center">
                <h2 class="mt-5 text-3xl font-bold text-gray-900 font-barlow">
                    Upload Here!
                </h2>
                <p class="mt-2 text-sm text-gray-400">Upload your image here...</p>
            </div>
            <form class="mt-8 space-y-3" action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Title</label>
                    <input class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" type="text" class="form-control" id="title" name="title" required placeholder="My Adventure!">
                </div>

                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Description</label>
                    <textarea class="text-base p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-indigo-500" class="form-control" id="description" name="description" required placeholder="The story of my..."></textarea>
                </div>

                <div class="grid grid-cols-1 space-y-2">
                    <label class="text-sm font-bold text-gray-500 tracking-wide">Pick the File</label>
                    <div class="flex items-center justify-center w-full">
                        <label class="flex flex-col rounded-lg border-4 border-dashed w-full h-60 p-10 group text-center">
                            <div class="h-full w-full text-center flex flex-col items-center justify-center ">
                                <div class="mt-4">
                                    <p class="pointer-none text-gray-500 "><span class="text-sm">Drag and drop</span> files here <br /> or </p>
                                    <input type="file" class="flex justify-center" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <p class="text-sm text-gray-300">
                    <span>File type: PNG, JPG, JPEG, SVG, GIF</span>
                </p>
                <div>
                    <button type="submit" class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4 rounded-full tracking-wide font-semibold focus:outline-none hover:bg-blue-600 cursor-pointer transition ease-in duration-300">
                        Upload
                    </button>
                    <a href="{{ route('galleries.index') }}" class="text-blue-500 hover:underline">Back to Gallery</a>
                </div>
            </form>
        </div>

        <!-- Image Preview Section -->
        <div class="w-1/3">
            <h3 class="text-center text-lg font-bold text-gray-700 mb-4">Image Preview</h3>
            <img id="image-preview" class="h-auto rounded-lg shadow-lg" style="display: none;">
        </div>

    </div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        const imageField = document.getElementById('image-preview');
        
        reader.onload = function() {
            if (reader.readyState === 2) {
                imageField.src = reader.result;
                imageField.style.display = 'block'; // Show the image preview
            }
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
