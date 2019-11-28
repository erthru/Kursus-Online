<?php

use App\Admin;
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
        Admin::create([
            'nama_depan' => 'Fal',
            'nama_belakang' => 'Tohru',
            'email' => 'manager@gmail.com',
            'password' => 'asdasd',
            'role' => 'MANAGER'
        ]);
    }
}
