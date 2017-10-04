<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class AddUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:add {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adds a new user';

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
        $this->user->name = $this->argument('name');
        $this->user->password = \Hash::make($this->argument('password'));
        $this->user->email = $this->argument('email');
        $this->user->scopes = json_encode(['*']);
        $this->user->save();

        $this->info(sprintf('A user was created with ID %s', $this->user->id));
    }
}