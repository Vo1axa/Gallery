@extends('layouts.app')
<title>Welcome to Galley</title>
@section('content')

<div class="w-full bg-slate-100  ">

<section class="bg-slate-100 dark:bg-gray-900">
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none md:text-5xl xl:text-6xl dark:text-white">Welcome To <span class="text-indigo-600  font-monoton"><strong>GALLEY</strong></span></h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Galley is a free, open-source webiste for you to share and find interesting photos.</p>
            <a href="/login" class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                Get started
                <svg class="w-5 h-5 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
            <a href="/galleries" class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                I'll Look around.
            </a> 
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/phone-mockup.png" alt="mockup">
        </div>                
    </div>
</section>


  <section class="dark:bg-gray-800 bg-slate-50">
    <div class="gap-16 items-center py-8 px-4 mx-auto max-w-screen-xl lg:grid lg:grid-cols-2 lg:py-16 lg:px-6">
        <div class="font-light text-gray-500 sm:text-lg dark:text-gray-400">
            <h2 class="mb-4 text-4xl font-extrabold text-gray-900 dark:text-white">Why <span class="text-indigo-600  font-monoton">GALLEY</span>?</h2>
            <p class="mb-4">Galley is a free, open-source platform for sharing and finding interesting photos. It is easy to use, and it is a great way to connect with other people who share your interests.</p>
            <p>Galley is a simple, fast, and secure way to share your photos with others. It is also a great way to find new photos and connect with other people who share your interests.</p>
        </div>
        <div class="grid grid-cols-2 gap-4 mt-8">
            <img class="w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-2.png" alt="office content 1">
            <img class="mt-4 w-full lg:mt-10 rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/content/office-long-1.png" alt="office content 2">
        </div>
    </div>
</section>

<section class="bg-gray-50  dark:bg-gray-800">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
        <div class="max-w-screen-lg text-gray-500 sm:text-lg dark:text-gray-400">
            <h2 class="mb-4 text-4xl font-bold text-gray-900 dark:text-white">Did you know?</h2>
            <p class="mb-4 font-light">Galley is a platform for sharing and finding interesting photos. It is easy to use, and it is a great way to connect with other people who share your interests. In fact, a random fact about Galley is that it was built by a solo developer in just 2 months.</p>
            
        </div>
    </div>
  </section>

  <section class="bg-slate-100 dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl sm:py-16 lg:px-6">
        <div class="mx-auto max-w-screen-sm text-center">
            <h2 class="mb-4 text-4xl font-extrabold leading-tight text-gray-900 dark:text-white">What are you waiting for?</h2>
            <p class="mb-6 font-light text-gray-500 dark:text-gray-400 md:text-lg">Start Saving and Posting images!</p>
            <a href="/register" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Sign up here.</a>
        </div>
    </div>
</section>

@endsection