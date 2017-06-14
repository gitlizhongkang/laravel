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
        set_time_limit(0);
        for($i=100000;$i<1000000;$i++){
            $info['username'] = $i;
            $info['email'] =  $i.'@qq.com';
            $info['tel'] = time().'3';
            $info['password'] = md5('123456');
            $info['reg_time'] =time();
            $info['user_point'] = 100;
            User::add($info);
        }        
    }
}
