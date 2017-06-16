<?php

namespace App\Console\Commands;

use App\Models\GoodsSku;
use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\OrderGoods;
use Illuminate\Support\Facades\DB;

class InsertOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert orders';

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
        for ($j=0;$j<10000;$j++) {
        $info['user_id'] = rand(150000,250000);
        //uid(3)[支付类型][ymd][时间戳4][随机2]
            $uid = substr($info['user_id'], -3);
        $info['order_sn'] = $uid.'1'.date('Ymd',time()).substr(time(),-4).rand(10,99);
        $info['consignee_tel'] = time().'1';
        $info['consignee_name'] = time().'1';
        $info['consignee_address'] = time().'1';
        $info['pay_type'] = 1;
        $info['order_time'] = time();
        $info['status'] = 1;
        $info['logistics_type'] = '圆通快递';
        $info['postscript'] = '测试数据'.$j;
        $info['logistics_price'] = '15.00';
        $info['order_price'] = '1566.00';
        $info['get_point'] = '1566';

        $Order = new Order();
        $order_id = $Order->insertGetId($info);
        $goods = [];
        $prices = 0;
        $goodsNum = 3;
        for ($i=1;$i<=$goodsNum;$i++) {
            $GoodsSku = new GoodsSku();
            $sku_id = rand(1,10000);
            $goodsInfo = $GoodsSku->where('sku_id',$sku_id)->first()->toArray();
            $goods[$i]['sku_id'] = 2475;
            $goods[$i]['sku_sn'] = 170613011007619002;
            $goods[$i]['goods_id'] = 619;
            $goods[$i]['goods_name'] = '澳洲爱他美 Aptamil';
            $goods[$i]['sku_norms_value'] = '1l,全脂';
            $goods[$i]['sku_img'] = 'uploads/2017-06-13/593fa307a6d76.jpg';
            $goods[$i]['sku_price'] ='522';
            $goods[$i]['num'] = 3;
            $goods[$i]['order_id'] = $order_id;
            $goods[$i]['add_time'] = time();
            $prices = $goods[$i]['sku_price']*$goods[$i]['num']+$prices;
        }
        $OrderGoods = new OrderGoods();
        $OrderGoods->insert($goods);
        }
    }
}
