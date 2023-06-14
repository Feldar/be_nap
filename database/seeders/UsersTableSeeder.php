<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        self::seedUsers();
        $this->command->alert('Tabla users inicializada con datos!');
    }
    private function seedUsers() {

        $userAdmin = User::create([
            'name' => env('ADMIN_NAME'),
            'email' => env('ADMIN_EMAIL'),
            'password' => Hash::make(env('ADMIN_PASS')),
            'email_verified_at' => now()
        ]);

        $roleAdmin = Role::create([
            'name' => 'Admin'
        ]);

        $userAdmin->roles()->attach($roleAdmin->id);

    }
}
