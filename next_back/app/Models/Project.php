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

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function priorities()
    {
        return $this->hasMany(Priority::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_fired');
    }

    public function project_user()
    {
        return $this->belongsToMany(ProjectUser::class);
    }

    protected static function booted()
    {
        static::updating(function ($project) {
            if ($project->isDirty('is_closed')) {
                $project->trackers()->update(['is_closed' => $project->is_closed]);
                $project->roles()->update(['is_closed' => $project->is_closed]);
                $project->statuses()->update(['is_closed' => $project->is_closed]);
                $project->project_user()->update(['is_fired' => $project->is_closed]);
            }
        });
    }
}
