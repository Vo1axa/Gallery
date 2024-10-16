@extends('layouts.app')
<title>Password reset</title>
@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 space-y-4 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Reset Password</h2>

        @if (session('status'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <!-- Email Field -->
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" id="email" name="email" class="block w-full px-4 py-2 border border-gray-300 rounded-lg text-gray-700 focus:ring-blue-500 focus:border-blue-500" placeholder="example@example.com" required>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button 
                    type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:bg-blue-600 transition ease-in-out duration-150">
                    Send Password Reset Link
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
