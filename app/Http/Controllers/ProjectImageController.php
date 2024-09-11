<?php

namespace App\Http\Controllers;

use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectImageController extends Controller
{
    public function destroy(ProjectImage $image)
    {
        Storage::disk('public')->delete($image->file_path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }
}
