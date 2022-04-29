<?php
namespace app\admin\model;

use think\model\concern\SoftDelete;         // 软删除命名空间
use think\Model;

class ArticleArticle extends Model
{
    use SoftDelete;                         // 软删除trait
    protected $deleteTime = 'delete_time';  // 删除时间字段（值为NULL表示未删除）
   
    public function articleCategory()
    {
        return $this->belongsTo('ArticleCategory');
    }
}
