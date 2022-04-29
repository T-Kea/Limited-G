<?php
namespace app\index\model;

use think\Model;

class ArticleArticle extends Model
{  
    public function ArticleCategory()
    {
        return $this->belongsTo('ArticleCategory');
    }
    
    // // 获取上一页方法
    // public static function getPrev($info=[])
    // {
    //     $map[] = ['id','gt',$info['id']];
    //     $map[] = ['category_id','eq',$info['category_id']];
    
    //     $info = self::where($map)->order('id ASC')->find();
    //     if($info){
    //         $href = url_news_show($info['id']);;
    //         $a = '<a href="'.$href.'">'.$info['title'].'</a>';
    //     }else{
    //         $a = '没有了';
    //     }
    //     return $a;
    // }
 
    // //获取下一页方法
    // public static function getNext($info=[])
    // {
    //     $map[] = ['id','lt',$info['id']];
    //     $map[] = ['category_id','eq',$info['category_id']];
    
    //     $info = self::where($map)->order('id DESC')->find();
    //     if($info){
    //         $href = url_news_show($info['id']);;
    //         $a = '<a href="'.$href.'">'.$info['title'].'</a>';
    //     }else{
    //         $a = '没有了';
    //     }
    //     return $a;
    // }
}
