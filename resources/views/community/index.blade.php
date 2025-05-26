@extends('layouts.app')

@section('title', 'Community')

@section('content')
<div class="container py-5">
  <div class="card shadow-lg p-4">
    <h1 class="card-title mb-3">Indie GameDev Community</h1>
    <p class="mb-4">
      Welcome to the Indie GameDev community! Please take a moment to review
      <a href="#" class="text-danger text-decoration-underline">the community rules</a>.
    </p>

    <div class="btn-group mb-4">
      <button class="btn btn-outline-dark active" type="button">All categories</button>
      <button class="btn btn-outline-secondary" type="button">Recent posts</button>
    </div>

    <div>
      <div class="bg-light px-3 py-2 text-uppercase text-muted">General</div>
      <div class="border-top">
        <div class="list-group">

          <!-- General Discussion with collapse -->
          <div class="list-group-item">
            <a class="text-danger fw-bold" data-bs-toggle="collapse" href="#discussionDetail" role="button" aria-expanded="false" aria-controls="discussionDetail">
              General Discussion
            </a>
            <p class="text-muted mb-1">Talk about things that don't quite fit into the other categories</p>
            <div class="text-muted small mb-2">
              <div>3,379 topics</div>
            </div>

            <!-- Collapsible content -->
            <div class="collapse" id="discussionDetail">
              <div class="card card-body mt-3">
                <ul class="list-unstyled mb-0">
                  <li><a href="{{ url('/thread/favorite-game-engine') }}"><strong>Thread:</strong> What's your favorite game engine?</a></li>
                  <li><a href="{{ url('/thread/first-game-dev-experience') }}"><strong>Thread:</strong> Share your first game dev experience</a></li>
                  <li><a href="{{ url('/thread/unity-vs-unreal') }}"><strong>Thread:</strong> Unity vs Unreal: Discussion</a></li>
                  <li><a href="{{ url('/category/general') }}"><strong>See More</strong></a></li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Other static category -->
          <div class="list-group-item">
            <a class="text-danger fw-bold" data-bs-toggle="collapse" href="#announceDetail" role="button" aria-expanded="false" aria-controls="announceDetail">
              Release Announcements
            </a>
            <p class="text-muted">Announce and promote your own projects here</p>
            <div class="text-muted small">
              <div>165 updates</div>
            </div>
          </div>

          <!-- Collapsible content -->
          <div class="collapse" id="announceDetail">
            <div class="card card-body mt-3">
              <ul class="list-unstyled mb-0">
                <li><a href="{{ url('/thread/update-11-3-fly-bird') }}"><strong>Thread:</strong> Update 11.3 Indie GameDev Fly Bird</a></li>
                <li><a href="{{ url('/thread/update-11-2-fly-bird') }}"><strong>Thread:</strong> Update 11.2 Indie GameDev Fly Bird</a></li>
                <li><a href="{{ url('/thread/update-11-1-fly-bird') }}"><strong>Thread:</strong> Update 11.1 Indie GameDev Fly Bird</a></li>
                <li><a href="{{ url('/category/releases') }}"><strong>See More</strong></a></li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
