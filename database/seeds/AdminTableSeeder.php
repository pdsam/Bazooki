<?php

use App\Administrator;
use App\Moderator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newMod = Moderator::create([
            'email' => 'admin@bazooki.com',
            'password' => Hash::make('admin')
        ]);
        Administrator::create([
            'mod_id' => $newMod->id
        ]);
    }
}
