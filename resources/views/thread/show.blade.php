@extends('layouts.app')

@section('title', $thread->title)

@section('content')
<div class="container py-5">
  <div class="card shadow-sm p-4">
    <h2 class="card-title mb-3">{{ $thread->title }}</h2>
    <p class="text-muted mb-1">Posted by <strong>{{ $thread->author }}</strong> on {{ $thread->created_at->format('M d, Y') }}</p>
    <hr>
    <div class="mt-3">
      {!! nl2br(e($thread->content)) !!}
    </div>

    <div class="mt-4">
      <a href="{{ url()->previous() }}" class="btn btn-secondary">← Back to Category</a>
    </div>
  </div>
</div>
@endsection
