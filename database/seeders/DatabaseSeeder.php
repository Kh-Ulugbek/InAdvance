<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create(
            [
                'role_id' => 1,
                'full_name' => 'admin',
                'login' => 'in_advance.admin',
                'phone' => '998991234567',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );
        User::query()->create(
            [
                'role_id' => 2,
                'full_name' => 'owner',
                'login' => 'in_advance.owner',
                'phone' => '998991234567',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );
        User::query()->create(
            [
                'role_id' => 3,
                'full_name' => 'customer',
                'login' => 'in_advance.customer',
                'phone' => '998991234567',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]
        );
    }
}
