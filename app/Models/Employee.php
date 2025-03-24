<?php

namespace App\Models;

class Employee extends Model
{
    protected static string $table = 'employees';
    protected static string $primaryKey = 'id';

    public static function findByEmail($email)
    {
        return (new self())->where('email', '=', $email)
            ->join('info_employee', 'employees.user_id = info_employee.id', 'INNER')
            ->join('roles', 'info_employee.role_id = roles.role_id', 'INNER')
            ->first();
    }
}
