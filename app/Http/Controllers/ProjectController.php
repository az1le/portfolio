<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);;
    }

    public function index(Request $request) {
        $query = Project::with(['images', 'tags']);

        if ($request->has('overview_filter')) {
            $filter = $request->input('overview_filter');

            $query->where(function ($q) use ($filter) {
                $q->where('title', 'LIKE', "%{$filter}%")
                  ->orWhereHas('tags', function ($q) use ($filter) {
                      $q->where('name', 'LIKE', "%{$filter}%");
                  });
            });
        }

        $projects = $query->get();

        return view('projects.index', compact('projects'));
    }

    public function create() {
        $tags = Tag::all();
        return view('projects.create', compact('tags'));
    }

    public function store(Request $request) {
        $project = Project::create($request->all());

        if ($request->has('tags')) {
            $project->tags()->attach($request->input('tags'));
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('project_images', 'public');

                ProjectImage::create([
                    'project_id' => $project->id,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('projects.index')->with('success', 'Project successfully created!');
    }

    public function show(Project $project) {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project) {
        $tags = Tag::all();
        return view('projects.edit', compact('project', 'tags'));
    }

    public function update(Request $request, Project $project) {
        $project->update($request->all());

        // Update tags
        if ($request->has('tags')) {
            // Detach all existing tags
            $project->tags()->detach();

            // Attach new tags
            $project->tags()->attach($request->input('tags'));
        }

        // Update images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('project_images', 'public');

                ProjectImage::create([
                    'project_id' => $project->id,
                    'file_path' => $path,
                ]);
            }
        }

        return redirect()->route('projects.show', $project->id)->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project) {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
