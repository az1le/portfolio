@extends('layouts.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-auto">
            <h2 class="mb-0">My Projects</h2>
        </div>

        <div class="col-auto ms-auto">
            <div class="row align-items-center">
                <div class="col-auto">
                    <form action="{{ route('projects.index') }}" method="GET">
                        <input type="text" name="overview_filter" class="form-control" placeholder="Filter by name or tag" value="{{ old('overview_filter', request()->query('overview_filter')) }}">
                    </form>
                </div>
                @auth
                <div class="col-auto ps-0">
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Project</a>
                </div>
                @endauth
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($projects as $project)
        <div class="col-md-6 col-lg-4 mb-4">
            <a href="{{ route('projects.show', $project) }}" class="text-decoration-none">
                <div class="card shadow-sm">
                    @php
                        $firstImage = $project->images->first();
                    @endphp
                    <img src="{{ $firstImage ? asset('storage/' . $firstImage->file_path) : 'default-image.jpg' }}" class="card-img-top" alt="Project Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ $project->description }}</p>
                        @foreach($project->tags as $tag)
                            <span class="badge text-bg-dark">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection
