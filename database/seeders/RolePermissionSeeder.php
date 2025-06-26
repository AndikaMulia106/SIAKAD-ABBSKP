<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Create Permissions
        $permissions = [
            // Dashboard
            'view-dashboard',
            
            // User Management
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            
            // Student Management
            'view-students',
            'create-students',
            'edit-students',
            'delete-students',
            'import-students',
            'export-students',
            
            // Teacher Management
            'view-teachers',
            'create-teachers',
            'edit-teachers',
            'delete-teachers',
            
            // Academic
            'view-subjects',
            'manage-subjects',
            'view-classes',
            'manage-classes',
            'view-schedules',
            'manage-schedules',
            
            // Attendance
            'view-attendance',
            'take-attendance',
            'edit-attendance',
            'export-attendance',
            
            // Grades
            'view-grades',
            'input-grades',
            'edit-grades',
            'export-grades',
            
            // Reports
            'view-reports',
            'generate-reports',
            
            // System
            'manage-settings',
            'backup-database'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // 2. Create Roles and Assign Permissions
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleAdmin->givePermissionTo([
            'view-dashboard',
            'view-users',
            'create-users',
            'edit-users',
            'delete-users',
            'view-students',
            'create-students',
            'edit-students',
            'delete-students',
            'import-students',
            'export-students',
            'view-teachers',
            'create-teachers',
            'edit-teachers',
            'delete-teachers',
            'view-subjects',
            'manage-subjects',
            'view-classes',
            'manage-classes',
            'view-schedules',
            'manage-schedules',
            'view-attendance',
            'export-attendance',
            'view-grades',
            'export-grades',
            'view-reports',
            'generate-reports',
            'manage-settings',
            'backup-database'
        ]);

        $roleTeacher = Role::firstOrCreate(['name' => 'guru']);
        $roleTeacher->givePermissionTo([
            'view-dashboard',
            'view-students',
            'view-subjects',
            'view-classes',
            'view-schedules',
            'view-attendance',
            'take-attendance',
            'edit-attendance',
            'view-grades',
            'input-grades',
            'edit-grades'
        ]);

        $roleStudent = Role::firstOrCreate(['name' => 'siswa']);
        $roleStudent->givePermissionTo([
            'view-dashboard',
            'view-attendance',
            'view-grades'
        ]);

        // 3. Create or retrieve admin user and assign admin role
        $admin = \App\Models\User::firstOrCreate(
            ['email' => 'admin@siakad-abbskp.test'],
            [
            'name' => 'Super Admin',
            'password' => bcrypt('password123'),
            ]
        );
        $admin->assignRole('admin');

        // Create sample teacher
        $guru = \App\Models\User::firstOrCreate(
            ['email' => 'guru@siakad-abbskp.test'],
            [
                'name' => 'Guru Contoh',
                'password' => bcrypt('password123'),
            ]
        );
        $guru->assignRole('guru');

        // Create sample student
        $siswa = \App\Models\User::firstOrCreate(
            ['email' => 'siswa@siakad-abbskp.test'],
            [
                'name' => 'Siswa Contoh',
                'password' => bcrypt('password123'),
            ]
        );
        $siswa->assignRole('siswa');

    }
}
