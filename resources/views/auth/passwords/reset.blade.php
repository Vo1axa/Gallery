@extends('layouts.app')
<title>Confirm Password Reset</title>
@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-4 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Reset Password</h2>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Email Field -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="example@example.com" 
                    required>
            </div>

            <!-- New Password Field -->
            <div class="mt-4">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-700">New Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Enter new password" 
                    required>
            </div>

            <!-- Confirm Password Field -->
            <div class="mt-4">
                <label for="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700">Confirm New Password</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-blue-500 focus:border-blue-500" 
                    placeholder="Confirm new password" 
                    required>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button 
                    type="submit" 
                    class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 transition ease-in-out duration-150">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
