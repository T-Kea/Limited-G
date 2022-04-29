<?php
namespace app\index\model;

use app\common\library\Tree;
use think\Model;

class ArticleCategory extends Model
{
    public static function tree()
    {
        $data = self::order('sort','asc')->select()->toArray();
        return new Tree($data);
    }
}