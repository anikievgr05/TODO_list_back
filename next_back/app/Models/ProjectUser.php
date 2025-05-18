<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $fillable = ['user_id', 'project_id', 'is_fired'];

    protected $table = 'project_user';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
