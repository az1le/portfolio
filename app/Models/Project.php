<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function images() {
        return $this->hasMany(ProjectImage::class);
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }
}
