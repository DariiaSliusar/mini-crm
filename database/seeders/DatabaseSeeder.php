<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $manager = User::factory()->create([
            'name' => 'Manager User',
            'email' => 'manager@manager.com',
            'password' => bcrypt('password123'),
        ]);

        $manager->assignRole('manager');

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('admin');

        Customer::factory(10)
            ->has(Ticket::factory()->count(rand(2, 3)))
            ->create();
    }
}
