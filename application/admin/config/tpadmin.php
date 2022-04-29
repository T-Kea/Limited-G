<?php
return [

    'album' => [
        'save_path' => './static/uploads',
        'image_ext' => 'gif,jpg,jpeg,bmp,png',
    ],
    'album_thumb' => [
        // 配置格式为 “相册路径 => [类名, 方法名]”
        'article/category_image' => [\app\admin\library\article\AlbumImage::class, 'thumbCategoryImage'],
        'article/article_image' => [\app\admin\library\article\AlbumImage::class, 'thumbArticleImage'],
        'article/article_album' => [\app\admin\library\article\AlbumImage::class, 'thumbArticleAlbum']
    ],
    'article'=>[
        'album_image_id'=>3,
        'album_album_id'=>4,
        'album_editor_id'=>5
    ]

];
