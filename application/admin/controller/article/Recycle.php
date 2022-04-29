<?php
namespace app\admin\controller\article;

use app\admin\model\ArticleArticle as ArticleModel;
use app\admin\controller\Common;

class Recycle extends Common
{
    public function index()
    {
        $article = ArticleModel::onlyTrashed()->with('articleCategory')->field('content,album', true)->order('id', 'desc');
        $params = [];
        $article = $article->paginate(15, false, ['type' => 'bootstrap', 'var_page' => 'page', 'query' => $params]);
        $this->assign('article', $article);
        return $this->fetch();
    }

    public function restore()
    {
        $id = $this->request->param('id/d', 0);
        if (!$article = ArticleModel::onlyTrashed()->find($id)) {
            $this->error('记录不存在。');
        }
        $article->restore();
        $this->success('恢复成功。');
    }

    public function delete()
    {
        $id = $this->request->param('id/d', 0);
        if (!$article = ArticleModel::onlyTrashed()->get($id)) {
            $this->error('删除失败，记录不存在。');
        }
        $article->delete(true);
        $this->success('删除成功。');
    }
}
