<?php
namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class LtComment extends Model
{

	 //表名
    protected $table = 'lt_comment';

    use Searchable;

    /**
     * 获取模型的索引数据数组
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // 自定义数组...

        return $array;
    }
}




// 5、搜索
// 你可以通过search方法来搜索一个模型，该方法接收一个用于搜索模型的字符串，
// 然后你还需要在这个搜索查询上调用一个get方法来获取与给定搜索查询相匹配的Eloquent模型：

// $orders = App\Order::search('Star Trek')->get();

// where子句
// Scout允许你添加简单的where子句到搜索查询，目前，这些子句仅支持简单的数值相等检查，由于搜索索引不是关系型数据库，更多高级的where子句暂不支持：

// $orders = App\Order::search('Star Trek')->where('user_id', 1)->get();