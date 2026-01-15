<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Clear existing permissions and roles
        \Spatie\Permission\Models\Permission::query()->delete();
        \Spatie\Permission\Models\Role::query()->delete();

        // Define all permissions
        $permissions = [
            // Users
            'users.view',
            'users.create',
            'users.update',
            'users.delete',

            // Categories
            'categories.view',
            'categories.create',
            'categories.update',
            'categories.delete',

            // Levels
            'levels.view',
            'levels.create',
            'levels.update',
            'levels.delete',

            // Questions
            'questions.view',
            'questions.create',
            'questions.update',
            'questions.delete',

            // Answers
            'answers.view',
            'answers.create',
            'answers.update',
            'answers.delete',

            // Tests
            'tests.view',
            'tests.create',
            'tests.update',
            'tests.delete',

            // Specialities
            'specialities.view',
            'specialities.create',
            'specialities.update',
            'specialities.delete',

            // Test Sessions
            'test-sessions.view',
            'test-sessions.create',
            'test-sessions.update',
            'test-sessions.delete',

            // User Test Answers
            'test-answers.view',
            'test-answers.create',
            'test-answers.update',
            'test-answers.delete',

            // Roles & Permissions Management
            'roles.view',
            'roles.create',
            'roles.update',
            'roles.delete',
            'permissions.view',
            'permissions.assign',

            // Menu Permissions
            'menu.categories',
            'menu.media',
            'menu.users',
            'menu.roles',
        ];

        // Create all permissions with api guard
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'api']);
        }

        // Create Admin Role with all permissions
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $adminRole->givePermissionTo(Permission::all());

        // Create Client Role with limited permissions
        $clientRole = Role::create(['name' => 'client', 'guard_name' => 'api']);
        $clientRole->givePermissionTo([
            'categories.view',
            'levels.view',
            'tests.view',
            'questions.view',
            'specialities.view',
            'test-sessions.view',
            'test-sessions.create',
            'test-answers.create',
        ]);

        // Create or update default admin user
        $adminUser = User::where('login', 'admin')->first();
        if (!$adminUser) {
            $adminUser = User::create([
                'name' => 'Admin User',
                'login' => 'admin',
                'email' => 'admin@duocard.com',
                'password' => Hash::make('admin'),
                'status' => User::STATUS_ACTIVE,
            ]);
        }

        // Sync admin role to admin user
        $adminUser->syncRoles(['admin']);

        $this->command->info('Roles and permissions created successfully!');
        $this->command->info('Admin role: all permissions');
        $this->command->info('Client role: limited permissions');
        $this->command->info('Admin user: login=admin, password=admin');
    }
}
