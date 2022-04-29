<?php
namespace app\admin\library\article;

use think\Image;

class AlbumImage
{
    public function thumbCategoryImage($filePath, $savePath)
    {
        $image = Image::open($filePath);
        return $image->thumb(140, 140, Image::THUMB_FILLED)->save($savePath);
    }
    public function thumbArticleImage($filePath, $savePath)
    {
        $image = Image::open($filePath);
        return $image->thumb(200, 200, Image::THUMB_FILLED)->save($savePath);
    }
    public function thumbArticleAlbum($filePath, $savePath)
    {
        $image = Image::open($filePath);
        return $image->thumb(800, 800, Image::THUMB_FILLED)->save($savePath);
    }
}
