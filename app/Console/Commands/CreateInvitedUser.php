<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateInvitedUser extends Command
{
    protected $signature = 'user:invite {email} {name}';
    protected $description = 'Create an invited user';

    public function handle()
    {
        $email = $this->argument('email');
        $name = $this->argument('name');
        $password = $this->ask('Enter password for the user');

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info("User {$email} created successfully!");
        return 0;
    }
}












/*
php artisan user:invite kodex@yandex.ru "kodex"
*/



/*

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CreateInvitedUser extends Command
{
	*/
	
	
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
	 
/*	 
    protected $signature = 'command:name';


*/
    /**
     * The console command description.
     *
     * @var string
     */
	 
	 /*
    protected $description = 'Command description';
*/


    /**
     * Execute the console command.
     *
     * @return int
     */
	 
/*	 
    public function handle()
    {
        return Command::SUCCESS;
    }
}
*/