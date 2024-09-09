@extends('layouts.app')

@section('content')
    <h2>New Project</h2>
    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Images</label>
            <input class="form-control" type="file" name="images[]" multiple required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
