@extends('layouts.app')
<title>Sign in</title>
@section('content')
<div>
    <div class="dark:bg-[#1e1e1e] ">
      <div class="flex justify-center h-screen">
          <div class="hidden bg-cover lg:block lg:w-2/4" style="background-image: url(https://images.fineartamerica.com/images-medium-large-5/japanese-maple-tree-in-autumn-david-gn.jpg)">
              <div class="flex items-center h-full px-20 bg-gray-900 bg-opacity-40">
                  <div>
                      <h2 class="text-4xl px-2 font-bold text-white box-decoration-clone bg-gradient-to-r from-orange-600">
                          Welcome <br/> 
                          Back
                      </h2>
                      <p class="max-w-xl mt-3 text-gray-200">Please login to continue accessing your account and content. Enjoy personalized features and updates.</p>
                  </div>
              </div>
          </div>
          
          <div class="flex items-center w-full max-w-md px-6 mx-auto lg:w-2/6">
              <div class="flex-1">
                  <div class="text-center">
                      <h2 class="text-4xl font-bold text-center text-gray-700 dark:text-gray-300 ">Sign in here</h2>
               
                  </div>
  
                  <div class="mt-8 dark:text-gray-200 text-gray-600">
                    <form action="{{ route('login.submit') }}" method="POST">
                          @csrf
                          <!-- Email -->
                          <div>
                              <label for="email" class="block mb-2 text-sm ">Email Address</label>
                              <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus placeholder="example@example.com" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md  focus:border-blue-400 da focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                              @error('email')
                                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                            @enderror
                          </div>
  
                          <!-- Password -->
                          <div class="mt-6">
                            
                              <div class="flex justify-between mb-2">
                                  <label for="password" class="text-sm">Password</label>
                                  <a href="" class="text-sm text-gray-400 focus:text-blue-500 hover:text-blue-500 hover:underline">_</a>
                              </div>
  
                              <input type="password" name="password" id="password" required placeholder="Your Password" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-400 bg-white border border-gray-200 rounded-md   focus:border-blue-400  focus:ring-blue-400 focus:outline-none focus:ring focus:ring-opacity-40" />
                              @error('password')
                              <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                          @enderror
                             
                                <div class="flex justify-between mb-2">
                                    <a href="{{ route('password.request') }}" class="text-sm text-gray-400 focus:text-blue-500 hover:text-blue-500 hover:underline">Forgot Password?</a>
                                </div>
                          </div>
  
                          <!-- Remember Me -->
                          <div class="mt-4">
                              <label for="remember_me" class="inline-flex items-center">
                                  <input type="checkbox" name="remember" id="remember_me" class="rounded border-gray-300 text-blue-500 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                  <span class="ml-2 text-sm text-gray-600 dark:text-gray-300 ">Remember me</span>
                              </label>
                          </div>
  
                          <!-- Sign In Button -->
                          <div class="mt-6">
                              <button type="submit" class="w-full px-4 py-2 tracking-wide text-white transition-colors duration-200 transform bg-blue-500 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-400 focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                                  Sign in
                              </button>
                          </div>
  
                      </form>
                      
                
  
                      <!-- Register Link -->
                      <p class="mt-6 text-sm text-center text-gray-400">Don't have an account yet? <a href="{{ route('register') }}" class="text-blue-500 focus:outline-none focus:underline hover:underline">Sign up</a>.</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  


@endsection

