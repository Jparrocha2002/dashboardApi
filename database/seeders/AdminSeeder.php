<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
    * Run the database seeds.
    */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Jerry Molar Parrocha',
            'email' => 'j.parrocha@gmail.com',
            'address' => 'Western Poblacion',
            'phone_number' => '09638753244',
            'gender' => 'Male',
            'status' => 'Single',
            'password' => Hash::make('12345678'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
