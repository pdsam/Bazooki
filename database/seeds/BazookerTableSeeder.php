<?php

use App\Bazooker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BazookerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bazooker')->insert([
            'name' => 'Manuel Serafim',
            'username' => 'manuel',
            'email' => 'manuel@example.com',
            'password' => Hash::make('123456'),
        ]);
        factory(Bazooker::class, 10)->create();
    }
}
