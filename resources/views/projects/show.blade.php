@extends('layouts.app')

@section('content')
    <h2 class="mb-4">
        {{ $project->title }}
        @auth
        <a href="{{ route('projects.edit', $project) }}"><i class="fa-solid fa-pen fs-5"></i></a>
        @endauth
    </h2>

    <div class="mb-3">
        {!! nl2br($project->description) !!}
    </div>

    @if($project->images->count() > 0)
        <div id="projectCarousel" class="carousel slide">
            <div class="carousel-indicators">
                @foreach($project->images as $index => $image)
                    <button type="button" data-bs-target="#projectCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                @foreach($project->images as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image->file_path) }}" class="d-block w-100 custom-carousel-image" alt="Project Image">
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    @else
        <p>No images available for this project.</p>
    @endif

    <style>
        .carousel-item {
            position: relative;
            height: 500px;
        }

        .carousel-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-item::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            pointer-events: none;
        }
    </style>
@endsection
