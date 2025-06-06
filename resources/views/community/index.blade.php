@extends('layouts.app')

@section('title', 'Community')

@section('content')
  <div class="container mx-auto py-8">
    <div class="bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-3">Indie GameDev Community</h1>
    <p class="mb-4 text-gray-700">
      Welcome to the Indie GameDev community! Please take a moment to review
      <a href="#" class="text-red-600 underline">the community rules</a>.
    </p>

    <div class="flex gap-2 mb-4">
      <button class="px-4 py-2 border border-gray-800 text-gray-800 rounded bg-gray-100">All categories</button>
      <button class="px-4 py-2 border border-gray-300 text-gray-600 rounded hover:bg-gray-100">Recent posts</button>
    </div>

    <div>
      <div class="bg-gray-100 px-4 py-2 text-sm text-gray-500 uppercase">General</div>
      <div class="divide-y border rounded-b-lg bg-white">
      <!-- General Discussion -->
      <div class="p-4" x-data="{ open: false }">
        <div class="flex justify-between items-start">
        <div>
          <a href="#" @click.prevent="open = !open" class="text-red-600 font-bold cursor-pointer">
          General Discussion
          </a>
          <p class="text-sm text-gray-600 mt-1">Talk about things that don't quite fit into the other categories</p>
          <div class="text-xs text-gray-500 mt-1">3,379 topics</div>
        </div>
        <button @click="open = !open" class="text-gray-500 text-sm">▼</button>
        </div>

        <!-- Collapsible Content -->
        <div x-show="open" x-transition class="mt-4 bg-gray-50 rounded p-4">
        <ul class="space-y-2 text-sm">
          <li><a href="{{ url('/thread/favorite-game-engine') }}"><strong>Thread:</strong> What's your favorite game
            engine?</a></li>
          <li><a href="{{ url('/thread/first-game-dev-experience') }}"><strong>Thread:</strong> Share your first
            game dev experience</a></li>
          <li><a href="{{ url('/thread/unity-vs-unreal') }}"><strong>Thread:</strong> Unity vs Unreal:
            Discussion</a></li>
          <li><a href="{{ url('/category/general') }}" class="text-blue-500 font-semibold">See More</a></li>
        </ul>
        </div>
      </div>

      <!-- Release Announcements -->
      <div class="p-4" x-data="{ open: false }">
        <div class="flex justify-between items-start">
        <div>
          <a href="#" @click.prevent="open = !open" class="text-red-600 font-bold cursor-pointer">
          Release Announcements
          </a>
          <p class="text-sm text-gray-600 mt-1">Announce and promote your own projects here</p>
          <div class="text-xs text-gray-500 mt-1">165 updates</div>
        </div>
        <button @click="open = !open" class="text-gray-500 text-sm">▼</button>
        </div>

        <!-- Collapsible Content -->
        <div x-show="open" x-transition class="mt-4 bg-gray-50 rounded p-4">
        <ul class="space-y-2 text-sm">
          <li><a href="{{ url('/thread/update-11-3-fly-bird') }}"><strong>Thread:</strong> Update 11.3 Indie GameDev
            Fly Bird</a></li>
          <li><a href="{{ url('/thread/update-11-2-fly-bird') }}"><strong>Thread:</strong> Update 11.2 Indie GameDev
            Fly Bird</a></li>
          <li><a href="{{ url('/thread/update-11-1-fly-bird') }}"><strong>Thread:</strong> Update 11.1 Indie GameDev
            Fly Bird</a></li>
          <li><a href="{{ url('/category/releases') }}" class="text-blue-500 font-semibold">See More</a></li>
        </ul>
        </div>
      </div>

      </div>
    </div>
    </div>
  </div>
@endsection