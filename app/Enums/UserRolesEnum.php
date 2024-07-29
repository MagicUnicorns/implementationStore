<?php

namespace App\Enums;

enum UserRolesEnum: string {
    case Admin = 'ADMIN';
    case Manager = 'MANAGER';
    case User = 'USER';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}