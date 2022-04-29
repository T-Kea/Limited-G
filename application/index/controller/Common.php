<?php
namespace app\index\controller;

use think\Controller;
use app\index\model\ArticleArticle as ArticleModel;
use app\index\model\ArticleCategory as CategoryModel;

class Common extends Controller
{
    protected function initialize()
    {
        $this -> view -> engine ->layout('common/layout');
        $this -> show();
    }

    public function show()
    {
        $category_id = $this->request->param('category_id/d', 0);
        $search = $this->request->get('search/s', '');
        $pagesize = $this->request->get('pagesize/d', 7);
        $article = ArticleModel::with('ArticleCategory')->where('`status`=1')->order('id', 'desc');//只传值已发布内容
        if ($category_id) {
            $article->where('article_category_id', $category_id);
        }
        
        if ($search !== '') {
            $sql_search = strtr($search, ['%' => '\%', '_' => '\_', '\\' => '\\\\']);//搜索功能
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

    public function detail()
    {
        $id = $this->request->param('id/d', 0);
        $category_id = $this->request->param('category_id/d', 0);
        $data = ['article_category_id' => $category_id, 'name' => '', 'writer' => '', 'time' => '', 'num' => '','status' => 1, 'content' => ''];
        if ($id) {
            if (!$data = ArticleModel::get($id)) {
                $this->error('记录不存在。');
            }
        }
        $num = \think\Db::name('article_article')->where('`id`=:id',['id'=>$id])->setInc('num');
        // // 前台分页效果
        // $prev =\think\Db::name('article_article')->where('id','<',$id)->where('article_category_id','=',$category_id)->order('id desc')->limit(1)->value('id');
        // $next =\think\Db::name('article_article')->where('id','>',$id)->where('article_category_id','=',$category_id)->order('id asc')->limit(1)->value('id');
        
        $categorys = CategoryModel::tree()->getTreeList();
        $this->assign('categorys', $categorys);
        $this->assign('data', $data);
        $this->assign('id', $id);

        // $this->assign('prev',$prev);
        // $this->assign('next',$next);
        return $this->fetch();

        // $list= db('article_article')->paginate(1);
        // $page = $list->render();
        // $this->assign('list',$list);
        // $this->assign('page', $page);
        // return $this->fetch();
    }

    
}
