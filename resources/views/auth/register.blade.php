@extends('layouts.app')
<title>Sign up</title>
@section('content')
<div>
    <div class="dark:bg-[#1e1e1e] ">
      <div class="flex justify-center h-screen">
          <div class="hidden bg-cover lg:block lg:w-2/4" style="background-image: url(https://thejapanbox.com/cdn/shop/articles/sakura-tree.webp?v=1667676962)">
              <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                  <div>
                      <h2 class="text-4xl px-2 font-bold text-white box-decoration-clone bg-gradient-to-r from-indigo-600">
                          Join Us For<br/> 
                          Free
                      </h2>
                      <p class="max-w-xl mt-3 text-gray-200">Sign up to create your account and enjoy personalized content, updates, and features.</p>
                  </div>
              </div>
          </div>
  
          <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
              <div class="flex-1">
                  <div class="text-center">
                    <h2 class="text-4xl font-bold text-center text-gray-700  dark:text-gray-300">Sign up here</h2>
                  </div>
  
                  <div class="mt-8 dark:text-gray-200 text-gray-600 ">
                      <form action="{{ route('register.submit') }}" method="POST">
                          @csrf
  
                          <!-- Username and Full Name -->
                          <div class="grid grid-cols-2 gap-4">
                              <div>
                                  <label for="name" class="block mb-2 text-sm">Username</label>
                                  <input type="text" name="username" id="username" placeholder="Your Username" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-400 focus:ring-opacity-40" required />
                                  @error('name')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                              </div>
                              <div>
                                  <label for="fullname" class="block mb-2 text-sm">Full Name</label>
                                  <input type="text" name="fullname" id="fullname" placeholder="Your Full Name" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-400 focus:ring-opacity-40" required />
                                  @error('fullname')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                              </div>
                          </div>
  
                          <!-- Address -->
                          <div class="mt-6">
                              <label for="address" class="block mb-2 text-sm">Address</label>
                              <input type="text" name="address" id="address" placeholder="Seven Street" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-400 focus:ring-opacity-40" required />
                              @error('address')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                          </div>
  
                          <!-- Email -->
                          <div class="mt-6">
                              <label for="email" class="block mb-2 text-sm">Email Address</label>
                              <input type="email" name="email" id="email" placeholder="example@example.com" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md placeholder-gray-400 focus:border-blue-400 focus:ring-blue-400 focus:ring-opacity-40" required />
                              @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                          </div>
  
                          <!-- Password -->
                          <div class="mt-6">
                              <label for="password" class="block mb-2 text-sm">Password</label>
                              <input type="password" name="password" id="password" placeholder="Your Password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md placeholder-gray-400 focus:border-blue-400 focus:ring-blue-400 focus:ring-opacity-40" required />
                          </div>
  
                          <!-- Confirm Password -->
                          <div class="mt-6">
                              <label for="password_confirmation" class="block mb-2 text-sm">Confirm Password</label>
                              <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Your Password" class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-200 rounded-md focus:border-blue-400 focus:ring-blue-400 focus:ring-opacity-40" required />
                          </div>
                                
                          <!-- Submit Button -->
                          <div class="mt-6">
                              <button type="submit" class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                  Register
                              </button>
                          </div>
                      </form>

                      
  
                      <!-- Link to Login -->
                      <p class="mt-6 text-sm text-center text-gray-400">Already have an account? <a href="{{ route('login') }}" class="text-blue-500 focus:outline-none focus:underline hover:underline">Login here!</a>.</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  
@endsection
