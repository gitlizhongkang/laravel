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
        for($i=0;$i<100000;$i++){
            $info['username'] = time();
            $info['email'] = time().'@qq.com';
            $info['tel'] = time().'1';
            $info['password'] = md5('123456');
            $info['reg_time'] =time();
            $info['user_point'] = 100;
            User::add($info);
        }        
    }
}
