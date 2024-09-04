@extends('layouts.app')

@section('content')
    <h2>Edit Project</h2>
    <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title', $project->title) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description', $project->description) }}</textarea>
        </div>

        {{-- <div class="mb-3">
            <label for="formFileMultiple" class="form-label">Images</label>
            <input class="form-control" type="file" name="images[]" multiple>
        </div> --}}

        <div class="row align-items-center">
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-auto ms-auto">
                <button type="button" onclick="confirmDelete()" class="btn btn-danger"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </form>
    <form action="{{ route('projects.destroy', $project) }}" method="post" id="delete-form">
        @csrf
        @method('DELETE')
        <button type="submit" class="d-none"></button>
    </form>

    <script>
        function confirmDelete() {
            if (confirm('Weet je zeker dat je deze project wilt verwijderen?')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
@endsection
