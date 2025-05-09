<?php

namespace App\Repositories;

use App\Models\ProjectUser;
use App\Models\RoleUsers;

class UserRoleRepositories
{
    public function __construct()
    {
        $this->model = new RoleUsers;
    }

    public function update_or_create_role_for_user(int $user_id, int $new_role, int $old_role) {
        return $this->model
            ->updateOrCreate(
                ['user_id' => $user_id, 'role_id' => $old_role],
                ['role_id' => $new_role]
            );
    }}
