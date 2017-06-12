<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class InsertUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert users';

    /**
     * The user service.
     *
     * @var object
     */
    protected $user;
    
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->user = new User;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $info['username'] = time();
        $info['email'] = time().'@qq.com';
        $info['tel'] = time().'1';
        $info['password'] = md5('123456');
        $info['reg_time'] =time();
        $info['user_point'] = 100;
        $user->fill($info);
        $user->save();

    }
}
