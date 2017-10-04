<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class UpdateUserPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:updatepassword {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates a user password';

    /**
     * User to persist in database
     *
     * @var User
     */
    protected $user;

    /**
     * Create a new command instance.
     *
     * @param  User  $user
     * @return void
     */
    public function __construct(User $user)
    {
        parent::__construct();

        $this->user = $user;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = $this->user->where('email', $this->argument('email'))->firstOrFail();
        $user->password = \Hash::make($this->argument('password'));
        $user->save();

        $this->info('User[' . $user->email . '] password updated.');
    }
}
