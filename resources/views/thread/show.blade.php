@extends('layouts.app')

@section('title', $thread->title)

@section('content')
<div class="container mx-auto px-4 py-8">
  <div class="bg-white shadow-lg rounded-lg p-6">
    <h2 class="text-2xl font-bold mb-3">{{ $thread->title }}</h2>
    
    <p class="text-sm text-gray-500 mb-1">
      Posted by <span class="font-semibold text-gray-700">{{ $thread->author }}</span> 
      on {{ $thread->created_at->format('M d, Y') }}
    </p>

    <hr class="my-4 border-gray-200">

    <div class="text-gray-800 leading-relaxed">
      {!! nl2br(e($thread->content)) !!}
    </div>

    <div class="mt-6">
      <a href="{{ url()->previous() }}" 
         class="inline-block px-4 py-2 text-sm text-gray-700 bg-gray-200 hover:bg-gray-300 rounded">
        ← Back to Category
      </a>
    </div>
  </div>
</div>
@endsection
