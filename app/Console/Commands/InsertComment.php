<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GoodsComment;

class InsertComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comment:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        for($i=0;$i<1000000;$i++){
            $info['user_id'] = rand(15000,25000);
            $info['goods_id'] =  513;
            $info['comment_desc'] = '好好，帮帮哒。。。。。。。。。。。。。。。。。。。。';
            $info['satisfaction'] = rand(3,5);
            $info['add_time'] =time();
            $comment = new GoodsComment;
	        $comment->insert($info);
	        // $comment->save();
        }    
    }
}
