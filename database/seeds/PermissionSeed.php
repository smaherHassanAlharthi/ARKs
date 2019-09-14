<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'consumption_access',],
            ['id' => 18, 'title' => 'consumption_create',],
            ['id' => 19, 'title' => 'consumption_edit',],
            ['id' => 20, 'title' => 'consumption_view',],
            ['id' => 21, 'title' => 'consumption_delete',],
            ['id' => 22, 'title' => 'alert_access',],
            ['id' => 23, 'title' => 'alert_create',],
            ['id' => 24, 'title' => 'alert_edit',],
            ['id' => 25, 'title' => 'alert_view',],
            ['id' => 26, 'title' => 'alert_delete',],
            ['id' => 27, 'title' => 'control_access',],
            ['id' => 28, 'title' => 'control_create',],
            ['id' => 29, 'title' => 'control_edit',],
            ['id' => 30, 'title' => 'control_view',],
            ['id' => 31, 'title' => 'control_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
