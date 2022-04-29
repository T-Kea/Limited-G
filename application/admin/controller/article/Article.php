<?php
namespace app\admin\controller\article;

use app\admin\model\ArticleArticle as ArticleModel;
use app\admin\model\ArticleCategory as CategoryModel;
use app\admin\validate\ArticleArticle as ArticleValidate;
use app\admin\controller\Common;
use think\facade\Config;

class Article extends Common
{
    public function index()
    {
        $category_id = $this->request->param('category_id/d', 0);
        $search = $this->request->get('search/s', '');
        $pagesize = $this->request->get('pagesize/d', 15);
        $article = ArticleModel::with('ArticleCategory')->field('content,album', true)->order('id', 'desc');
        if ($category_id) {
            $article->where('article_category_id', $category_id);
        }
        if ($search !== '') {
            $sql_search = strtr($search, ['%' => '\%', '_' => '\_', '\\' => '\\\\']);
            $article->whereLike('name', '%' . $sql_search . '%');
        }
        $params = ['search' => $search, 'pagesize' => $pagesize];
        $article = $article->paginate($pagesize, false, ['type' => 'bootstrap', 'var_page' => 'page', 'query' => $params]);
        $category = CategoryModel::tree()->getTree();
        $this->assign('article', $article);
        $this->assign('category', $category);
        $this->assign('category_id', $category_id);
        $this->assign('search', $search);
        return $this->fetch();
    }

    public function delete()
    {
        $id = $this->request->param('id/d', 0);
        if (!$article = ArticleModel::get($id)) {
            $this->error('删除失败，记录不存在。');
        }
        $article->delete();
        $this->success('删除成功。');
    }

    public function changeStatus()
    {
        $id = $this->request->param('id/d', 0);
        $status = $this->request->param('status/d', 0);
        $validate = new ArticleValidate();
        if (!$validate->scene('changeStatus')->check(['status' => $status])) {
            $this->error('操作失败，' . $validate->getError() . '。');
        }
        if (!$article = ArticleModel::get($id)) {
            $this->error('记录不存在。');
        }
        $article->save(['status' => $status]);
        $this->success(($status ? '已发布' : '未发布'). '成功。');
    }

    public function edit()
    {
        $id = $this->request->param('id/d', 0);
        $category_id = $this->request->param('category_id/d', 0);
        $data = [
            'article_category_id' => $category_id, 'name' => '', 'writer' => '', 'time' => 0, 'num' => 0,
            'image' => '', 'status' => 1, 'content' => '', 'album' => ''
        ];
        if ($id) {
            if (!$data = ArticleModel::get($id)) {
                $this->error('记录不存在。');
            }
        }
        $data['album'] = $data['album'] ? explode('|', $data['album']) : [];
        $category = CategoryModel::tree()->getTree();
        $this->assign('category', $category);
        $this->assign('data', $data);
        $this->assign('id', $id);
        $config = Config::get('tpadmin.article');
        $this->assign('album_image_id', $config['album_image_id']);
        $this->assign('album_album_id', $config['album_album_id']);
        $this->assign('album_editor_id', $config['album_editor_id']);
        return $this->fetch();
    }

    public function save()
    {
        $id = $this->request->post('id/d', 0);
        $data = [
            'article_category_id' => $this->request->post('article_category_id/d', 0),
            'name' => $this->request->post('name/s', '', 'trim'),
            'writer' => $this->request->post('writer/s', '', 'trim'),
            'time' => $this->request->post('time/f', 0),
            'num' => $this->request->post('num/d', 0),
            'image' => $this->request->post('image/s', '', 'trim'),
            'status' => $this->request->post('status/d', 0),
            'content' => $this->request->post('content/s', ''),
            'album' => implode('|', $this->request->post('album/a', [], 'trim')),
        ];
        $validate = new ArticleValidate();
        if ($id) {
            if (!$validate->scene('update')->check($data)) {
                $this->error('修改失败，' . $validate->getError() . '。');
            }
            if (!$article = ArticleModel::get($id)) {
                $this->error('修改失败，记录不存在。');
            }
            $article->save($data);
            $this->success('修改成功。');
        }
        if (!$validate->scene('insert')->check($data)) {
            $this->error('添加失败，' . $validate->getError() . '。');
        }
        ArticleModel::create($data);
        $this->success('添加成功。');
    }
}
