<?php
// filepath: /C:/Users/ycode/openCode/app/Services/RegisterService.php
<?php

namespace App\Services;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function register(array $data): User
    {
        $roleName = $data['role'] ?? 'user';
        $role = Role::firstOrCreate(
            ['name' => $roleName],
            ['name' => $roleName, 'display_name' => ucfirst($roleName)]
        );

        return User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $role->id,
        ]);
    }
}