<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'is_closed'];
    public $timestamps = false;

    public function trackers()
    {
        return $this->hasMany(Tracker::class);
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
    protected static function booted()
    {
        static::updating(function ($project) {
            if ($project->isDirty('is_closed')) {
                $project->trackers()->update(['is_closed' => $project->is_closed]);
                $project->roles()->update(['is_closed' => $project->is_closed]);
            }
        });
    }
}
