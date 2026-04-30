<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;

class UserGeneratorService
{
    // Genera contraseña: CI + extensión (ej: 12345678LP)
    public static function generatePassword(string $ci, ?string $extension = null): string
    {
        return $ci . strtoupper($extension ?? '');
    }

    // Genera username: iniciales de nombres + apellidos (ej: jbarros, jmbarrosg)
    public static function generateUsername(string $firstName, ?string $lastFather = null, ?string $lastMother = null): string
    {
        // Tomar primera letra de cada nombre
        $nameParts  = explode(' ', trim($firstName));
        $initials   = implode('', array_map(fn($p) => strtolower($p[0]), $nameParts));

        // Apellido paterno completo (o solo inicial si hay materno)
        $father = $lastFather ? strtolower(Str::ascii($lastFather)) : '';
        $mother = $lastMother ? strtolower($lastMother[0]) : '';

        $base = $initials . $father . $mother;
        $base = preg_replace('/[^a-z0-9]/', '', $base);

        $username = $base;
        

        return $username;
    }
}