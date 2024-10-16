@extends('layouts.app')
<title>{{ $gallery->title }} by {{ $gallery->user->username }}</title>

@section('content')
<div class="container mx-auto mt-12 px-6">
    <div class="bg-white/50 shadow-lg rounded-lg overflow-hidden flex flex-col lg:flex-row">

        <!-- Left Side: Image -->
        <div class="lg:w-1/2 flex justify-center items-center p-6 bg-gray-100 dark:bg-slate-700">
            <img src="{{ asset('images/' . $gallery->image) }}" alt="{{ $gallery->title }}" 
                 class="cursor-pointer rounded-lg shadow-lg transition duration-300 hover:opacity-90" 
                 id="galleryImage" style="max-width: 100%; height: auto;">
        </div>

        <!-- Right Side: Details -->
        <div class="lg:w-1/2 p-8 flex flex-col relative bg-slate-50 dark:bg-slate-500">
            <!-- Title Section -->
            <div class="flex justify-between mb-4">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-slate-100">{{ $gallery->title }}</h1>
                
                
                <!-- Print button -->
                <div>
                    <button onclick="window.print()" class="absolute  text-sm text-white px-3 py-1 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M128 0C92.7 0 64 28.7 64 64l0 96 64 0 0-96 226.7 0L384 93.3l0 66.7 64 0 0-66.7c0-17-6.7-33.3-18.7-45.3L400 18.7C388 6.7 371.7 0 354.7 0L128 0zM384 352l0 32 0 64-256 0 0-64 0-16 0-16 256 0zm64 32l32 0c17.7 0 32-14.3 32-32l0-96c0-35.3-28.7-64-64-64L64 192c-35.3 0-64 28.7-64 64l0 96c0 17.7 14.3 32 32 32l32 0 0 64c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-64zM432 248a24 24 0 1 1 0 48 24 24 0 1 1 0-48z"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Download function -->
                <div>
                  <a href="{{ route('galleries.download', $gallery->id) }}" class="absolute  text-sm text-white px-3 py-1 rounded-full">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-6 h-6">
                          <path d="M256 0a256 256 0 1 0 0 512A256 256 0 1 0 256 0zM244.7 395.3l-112-112c-4.6-4.6-5.9-11.5-3.5-17.4s8.3-9.9 14.8-9.9l64 0 0-96c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 96 64 0c6.5 0 12.3 3.9 14.8 9.9s1.1 12.9-3.5 17.4l-112 112c-6.2 6.2-16.4 6.2-22.6 0z"/>
                      </svg>
                  </a>
            </div>


               <!-- Dropdown for 3-dot menu -->
                <div class="relative inline-block text-left">
                    <button type="button" class="inline-flex justify-center w-full rounded-md px-4 py-2 text-sm font-medium text-gray-700 dropdowntoggle" aria-haspopup="true" aria-expanded="true">
                        <svg class="w-5 h-5" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 8a2 2 0 100-4 2 2 0 000 4zm0 4a2 2 0 100-4 2 2 0 000 4zm0 4a2 2 0 100-4 2 2 0 000 4z"/>
                        </svg>
                    </button>
                
                    <!-- Dropdown content -->
                <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-slate-50 dark:bg-slate-700 text-gray-900 ring-1 ring-black ring-opacity-5 dropdownIn hidden" role="menu" aria-orientation="vertical">
                    <div class="py-1" role="none">
                        <div class="relative">
                            <button id="saveToAlbum" class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">Save to Album</button>
                            <div id="albumOptions" class="hidden origin-top-left absolute left-0 mt-1 w-48 rounded-md shadow-lg bg-slate-50 dark:bg-slate-700 ring-1 ring-black ring-opacity-5 z-10 album-options">
                                @foreach($albums as $album)
                                    @if($album->user_id == Auth::id())
                                        <form action="{{ route('albums.saveToAlbum', $album->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="image_id" value="{{ $gallery->id }}">
                                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 dark:text-gray-50  hover:bg-gray-100 dark:hover:bg-gray-500">To: {{ $album->name }}</button>
                                        </form>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        @if((Auth::check() && Auth::user()->id == $gallery->user_id) || (Auth::check() && Auth::user()->is_admin))
                            <div class="border-t mt-2"></div>
                            <div class="mt-2">
                                <a href="{{ route('galleries.edit', $gallery->id) }}" class="block w-full text-left px-4 py-2 text-indigo-600 hover:bg-gray-100 dark:hover:bg-gray-800">Edit</a>
                                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100 dark:hover:bg-gray-800">Delete</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
                                </div>
                            </div>
                        
              <!-- Posted by Section -->
             <div class="flex items-center mb-4">
                 @if($gallery->user->profile_image)
                    <img class="w-12 h-12 rounded-full mr-4 shadow-lg" 
                         src="{{ asset('images/profile/' . $gallery->user->profile_image) }}" 
                         alt="{{ $gallery->user->name }}'s Profile Picture">
                @else
                    <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center mr-4 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 448 512">
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                        </svg>
                    </div>
                @endif

                <div>
                    <a href="{{ route('profile.show', $gallery->user->id) }}" class="text-gray-700 dark:text-gray-300 font-semibold hover:text-blue-600">
                        {{ $gallery->user->username }}
                    </a>
                    <p class="text-gray-500 dark:text-gray-300 text-sm">Posted on: {{ $gallery->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>

            <!-- Like Button -->
            <div class="mb-6">
                <form action="{{ route('galleries.like', $gallery->id) }}" method="POST">
                    @csrf
                    <button type="submit">
                        @if($gallery->likes->where('user_id', auth()->id())->count())
                            <svg class="w-6 h-6 fill-red-600" viewBox="0 0 512 512"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                        @else
                            <svg class="w-6 h-6 fill-gray-600" viewBox="0 0 512 512"><path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"/></svg>
                        @endif
                        {{ $gallery->likes->count() }}
                    </button>
                </form>

                <h2 class="text-lg font-semibold text-gray-700">Description:</h2>
                <p class="mt-2 text-gray-700 leading-relaxed">{{ $gallery->description }}</p>
            </div>

            <div class="mt-4">
                <a href="{{ route('galleries.index') }}" class="text-blue-600 hover:underline">
                    ← Back to Gallery
                </a>
            </div>


            <!-- Form Comment -->
<div class="mt-6">
    <form action="{{ route('galleries.comment', $gallery->id) }}" method="POST" class="bg-slate-50 dark:bg-slate-800 p-4 rounded-lg shadow-md">
        @csrf
        <label for="comment" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Comment:</label>
        <textarea name="body" id="comment" rows="4" class="border rounded-md w-full p-2 bg-slate-50 dark:bg-slate-700 text-gray-900 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400" placeholder="Add a comment..."></textarea>
        <button type="submit" class="mt-3 w-full p-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">Post Comment</button>
    </form>
</div>


            <!-- Comments -->
            @foreach($gallery->comments as $comment)
            <div class="border bg-slate-50 dark:bg-slate-800 text-gray-800 dark:text-gray-100 rounded p-2 mb-2 flex items-start">
                @if($comment->user->profile_image)
                    <img class="w-12 h-12 rounded-full mr-4 shadow-lg" 
                         src="{{ asset('images/profile/' . $comment->user->profile_image) }}" 
                         alt="{{ $comment->user->username }}'s Profile Picture">
                @else
                    <div class="w-12 h-12 rounded-full bg-gray-300 flex items-center justify-center mr-4 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-500" fill="currentColor" viewBox="0 0 448 512">
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                        </svg>
                    </div>
                @endif
                <div>
                    <p class="font-semibold"><a href="{{ route('profile.show', $comment->user->id) }}">{{ $comment->user->username }}</a></p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $comment->created_at->format('d M Y H:i') }}</p>
                    <p>{{ $comment->body }}</p>
                </div>
           
            

                @if(Auth::check() && Auth::user()->is_admin)
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Delete</button>
                    </form>
                @endif
            </div>
            @endforeach

        </div>
    </div>
    
    <!-- Modal for Image Preview -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 hidden justify-center items-center z-50 overflow-auto">
        <div class="relative p-4">
            <img src="{{ asset('images/' . $gallery->image) }}" alt="Image Preview" id="modalImage" class="block">
            <button id="closeModal" class="fixed top-10 right-4 text-white text-6xl p-4 focus:outline-none bg-gray-700 rounded-full">
                ×
            </button>
        </div>
    </div>
</div>

<script>
    // Get the gallery image and modal elements
    const galleryImage = document.getElementById('galleryImage');
    const imageModal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const closeModal = document.getElementById('closeModal');

    // Open modal when the image is clicked
    galleryImage.addEventListener('click', () => {
        imageModal.classList.remove('hidden');
        imageModal.classList.add('flex');
    });

    // Close modal when the close button is clicked
    closeModal.addEventListener('click', () => {
        imageModal.classList.add('hidden');
        imageModal.classList.remove('flex');
    });

    // Close modal when clicking outside the image
    imageModal.addEventListener('click', (e) => {
        if (e.target === imageModal) {
            imageModal.classList.add('hidden');
            imageModal.classList.remove('flex');
        }
    });

</script>

<script>
    document.getElementById('saveToAlbum').addEventListener('click', function(event) {
        const albumOptions = document.getElementById('albumOptions');
        albumOptions.classList.toggle('hidden');
        event.stopPropagation();
    });

    window.addEventListener('click', function(event) {
        const albumOptions = document.getElementById('albumOptions');
        if (!event.target.closest('#saveToAlbum') && !albumOptions.contains(event.target)) {
            albumOptions.classList.add('hidden');
        }
    });
</script>


<!-- Script Dropdown -->
<script>
    // Get all dropdown buttons and menus
    const dropdownButtons = document.querySelectorAll('.dropdowntoggle');
    const dropdownMenus = document.querySelectorAll('.dropdownIn');

    dropdownButtons.forEach((button, index) => {
        button.addEventListener('click', (e) => {
            // Toggle the corresponding dropdown menu
            dropdownMenus[index].classList.toggle('hidden');
        });
    });

    // Close dropdown if clicked outside
    window.addEventListener('click', (e) => {
        dropdownMenus.forEach((menu, index) => {
            if (!menu.classList.contains('hidden') && !dropdownButtons[index].contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    });
</script>
@endsection