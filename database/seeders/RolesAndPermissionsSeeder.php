<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            //Pacientes
            'view.patients',
            'create.patients',
            'edit.patients',
            'delete.patients',

            //Áreas de atención
            'view.areas',
            'create.areas',
            'edit.areas',
            'delete.areas',

            //Agenda / citas
            'view.appointments',
            'create.appointments',
            'edit.appointments',
            'delete.appointments',
            'cancel.appointments',

            //Historial Clinico
            'view.clinical_sessions',
            'create.clinical_sessions',
            'edit.clinical_sessions',
            'delete.clinical_sessions',
            
            //Pagos
            'view.payments',
            'create.payments',
            'edit.payments',
            'delete.payments',
            
            'view.payment_plans',
            'create.payment_plans',
            'edit.payment_plans',

            //Personal / usuarios
            'view.staff',
            'create.staff',
            'edit.staff',
            'delete.staff',

            //Reportes
            'view.reports',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //Limpiar caché despues de crear los permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //Rol: Administrador - acceso total
        $admin = Role::create(['name' => 'admin']);
        $admin->syncPermissions($permissions);

        //Rol: Terapeuta
        $therapist = Role::create(['name' => 'therapist']);
        $therapist->syncPermissions([
            'view.patients',
            'view.areas',
            'view.appointments',
            'create.appointments',
            'edit.appointments',
            'cancel.appointments',
            'view.clinical_sessions',
            'create.clinical_sessions',
            'edit.clinical_sessions',

        ]);
    }
}
