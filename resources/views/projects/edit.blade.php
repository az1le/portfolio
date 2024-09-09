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
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"><i class="fas fa-trash"></i></button>
            </div>
        </div>
    </form>

    <form action="{{ route('projects.destroy', $project) }}" method="post" id="delete-form">
        @csrf
        @method('DELETE')
        <input type="hidden" name="project_name_confirmation" id="project-name-confirmation">
        <button type="submit" class="d-none"></button>
    </form>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>To delete this project, type the project name: <strong>{{ $project->title }}</strong></p>
                    <input type="text" class="form-control" id="projectNameInput" placeholder="Type project name to confirm">
                    <div id="error-message" class="text-danger mt-2" style="display: none;">The project name is incorrect.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="confirmDeletion()">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDeletion() {
            const projectNameInput = document.getElementById('projectNameInput').value;
            const projectTitle = "{{ $project->title }}";

            if (projectNameInput === projectTitle) {
                document.getElementById('project-name-confirmation').value = projectNameInput;
                document.getElementById('delete-form').submit();
            } else {
                document.getElementById('error-message').style.display = 'block';
            }
        }
    </script>
@endsection
