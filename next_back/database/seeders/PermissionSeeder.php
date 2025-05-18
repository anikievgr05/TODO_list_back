<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $model = User::find(1);
        $routePermissions = [
            //super-admin
            'all',

            // role
            'role.index',
            'role.store',
            'role.show',
            'role.update',
            'role.closed',

            // project
            'project.index',
            'project.store',
            'project.show',
            'project.update',
            'project.closed',

            // task
            'task.index',
            'task.store',
            'task.show',
            'task.update',
            'task.change_status',

            // status
            'status.index',
            'status.store',
            'status.show',
            'status.update',
            'status.closed',
            'status.change_order',

            // priority
            'priority.index',
            'priority.store',
            'priority.show',
            'priority.update',
            'priority.closed',
            'priority.change_order',

            // tracker
            'tracker.index',
            'tracker.store',
            'tracker.show',
            'tracker.update',
            'tracker.closed',

            // user_project
            'user_project.index',
            'user_project.store',
            'user_project.show',
            'user_project.update',
            'user_project.fire',
            'user_project.fire_all',
            'user_project.update_role',
        ];
        foreach ($routePermissions as $key => $name) {
            Permission::firstOrCreate(['id'=> $key+1, 'name' => $name]);
        }
//        UserPermission::create(['user_id'=> $model->id, 'permission_id' => 1 ]);

    }
}
