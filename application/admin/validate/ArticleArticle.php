<?php
namespace app\admin\validate;

use app\admin\model\ArticleCategory as CategoryModel;
use think\Validate;

class ArticleArticle extends Validate
{
    protected $rule = [
        'name' => 'require|max:100',
        'writer' => 'max:255',
        'time' => 'regex:/^\d{1,8}(\.\d{1,2})?$/',
        'num' => 'number',
        'image' => 'max:255',
        'status' => 'between:0,1',
        'content' => 'max:65535',
        'album' => 'max:65535',
        'article_category_id' => 'checkCategoryId'
    ];

    protected $message = [
        'name.require' => '名称不能为空',
        'name.max' => '名称不能超过100个字符',
        'writer.max' => '作者不能超过255个字符',
        'time.regex' => '时间格式不合法，最多两位小数，最大99999999.99',
        'num.number' => '库存量不合法',
        'image.max' => '图片路径不能超过255个字符',
        'status.between' => '状态值不合法',
        'content.max' => '内容长度不能超过65535字节',
        'album.max' => '相册路径不能超过65535字节'
    ];

    public function checkCategoryId($value, $rule)
    {
        if ($value) {
            if (!$data = CategoryModel::field('pid')->get($value)) {
                return '所属分类不存在';
            }
            if ($data->pid === 0) {
                return '所属分类必须是二级分类';
            }
        }
        return true;
    }
    
    public function sceneChangeStatus()
    {
        return $this->only(['status']);
    }
}
