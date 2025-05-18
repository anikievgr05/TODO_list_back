<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['project_id', 'name', 'is_closed'];

    public $timestamps = false;


    public function project()
    {
        return $this->belongsTo(Project::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
