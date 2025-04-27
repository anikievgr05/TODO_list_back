<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $fillable = ['project_id', 'name', 'is_closed'];
    public $timestamps = false;

    // Связь многие к одному
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
