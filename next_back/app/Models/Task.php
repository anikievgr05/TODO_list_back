<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['brief_description', 'project_id',  'author_id', 'responsible_id', 'reviewer_id', 'tracker_id', 'status_id', 'date_end', 'priority_id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function tracker()
    {
        return $this->belongsTo(Tracker::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function files()
    {
        return $this->hasMany(TaskFile::class);
    }
}
