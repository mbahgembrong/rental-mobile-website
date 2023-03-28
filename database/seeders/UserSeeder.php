<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        foreach ($roles as $role) {
            User::create([
                'role_id' => $role->id,
                'nama' => $role->nama,
                'email' => $role->nama . '@gmail.com',
                'password' => bcrypt($role->nama),
                'jenis_kelamin' => 'L',
                'alamat' => 'Jl. ' . $role->nama,
            ]);
        }
    }
}