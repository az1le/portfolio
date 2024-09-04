@extends('layouts.app')

@section('content')
    <div class="row align-items-center">
        <div class="col-auto">
            <h2>My Projects</h2>
        </div>
        <div class="col-auto ms-auto">
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Project</a>
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
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
@endsection
