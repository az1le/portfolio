@extends('layouts.app')

@section('content')
    <h2>
        {{ $project->title }}
        @auth
        <a href="{{ route('projects.edit', $project) }}"><i class="fa-solid fa-pen fs-5"></i></a>
        @endauth
    </h2>
    {{ $project->description }}
@endsection
