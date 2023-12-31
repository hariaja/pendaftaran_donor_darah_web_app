<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    $permissions = [
      // Halaman Users
      'users.index',
      'users.create',
      'users.store',
      'users.show',
      'users.password',
      'users.status',
      'users.update',
      'users.destroy',

      // Halaman Role
      'roles.index',
      'roles.create',
      'roles.store',
      'roles.edit',
      'roles.update',
      'roles.destroy',

      // Halaman Donatur
      'donations.index',
      'donations.show',
      'donations.update',
      'donations.destroy',

      // Halaman Event/Acara
      'events.index',
      'events.create',
      'events.store',
      'events.show',
      'events.edit',
      'events.update',
      'events.destroy',
    ];

    $guardName = 'web';
    $permissionCategoryId = [
      'users' => 1,
      'roles' => 2,
      'donations' => 3,
      'events' => 4,
    ];

    foreach ($permissions as $permission) :
      Permission::firstOrCreate([
        'name' => $permission,
        'permission_category_id' => $permissionCategoryId[explode('.', $permission)[0]],
        'guard_name' => $guardName,
        'created_at' => now(),
        'updated_at' => now(),
      ]);
    endforeach;
  }
}
