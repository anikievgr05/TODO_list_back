<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('is_fired');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function hasPermission(string $permissionName, ?int $projectId = null): bool
    {
        if ($this->hasSuperPermission()) {
            return true;
        }
        if ($projectId && $this->hasRolePermission($permissionName, $projectId)) {
            return true;
        }

        // Нет прав
        return false;
    }

    private function hasSuperPermission(): bool
    {
        return $this->permissions()->where('name', 'all')->exists();
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'user_permissions');
    }
    private function hasRolePermission(string $permissionName, int $projectId): bool
    {
        $role = $this->roles()
            ->where('project_id', $projectId)
            ->first();

        if ($role->permissions()->where('name', $permissionName)->first()) {
            return true;
        } else {
            return false;
        }
    }
}
