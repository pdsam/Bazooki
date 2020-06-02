<?php

namespace App\Console\Commands;

use App\Administrator;
use App\Moderator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Create a new system admin, supply: [admin_email] [password]";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mod = Moderator::create([
            'email'=>$this->argument('email'),
            'password'=>Hash::make($this->argument('password'))
        ]);

        Administrator::create(['mod_id'=>$mod->id]);
    }
}
