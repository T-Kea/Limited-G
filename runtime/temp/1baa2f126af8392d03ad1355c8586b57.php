<?php /*a:1:{s:71:"K:\study_php\web\mytp\application\admin\view\article\article\index.html";i:1639900257;}*/ ?>
<div>
    <div class="main-title">
      <h2>文章管理</h2>
    </div>
    <div class="main-section form-inline">
      <a href="<?php echo url('edit', ['category_id' => $category_id]); ?>" class="btn btn-success">+ 新增</a>
      <select class="j-select form-control" style="min-width:120px;margin-left:2px">
        <option value="<?php echo url('', ['category_id' => 0]); ?>">所有分类</option>
        <?php foreach($category as $v): ?>
          <optgroup label="<?php echo htmlentities($v['name']); ?>">
            <?php foreach($v['sub'] as $vv): ?>
              <option value="<?php echo url('', ['category_id' => $vv['id']]); ?>" <?php if($category_id==$vv['id']): ?>selected<?php endif; ?>><?php echo htmlentities($vv['name']); ?></option>
            <?php endforeach; ?>
          </optgroup>
        <?php endforeach; ?>
      </select>
      <form class="input-group j-search" style="width:200px;margin:0 2px;">
        <input type="text" class="form-control" name="search" value="<?php echo htmlentities($search); ?>" 
         placeholder="输入标题" required>
        <span class="input-group-btn">
          <input type="submit" class="btn btn-default" value="搜索">
        </span>
      </form>
      <?php if($search !== ''): ?>
        <a href="<?php echo url('', ['category_id' => $category_id]); ?>">清除条件</a>
      <?php endif; ?>
    </div>
    <div class="main-section">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th width="80">栏目分类</th>
            <th width="60">封面</th>
            <th>标题</th>
            <th width="80">阅读量</th>
            <th width="70">状态</th>
            <th width="155">创建时间</th>
            <th width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($article as $v): ?>
          <tr>
            <td><?php echo !empty($v['article_category']['name']) ? htmlentities($v['article_category']['name']) : '---'; ?></td>
            <td>
              <a href="<?php echo url('edit', ['id' => $v['id']]); ?>"><img src="<?php if($v['image']): ?>/static/uploads/<?php echo htmlentities($v['image']); else: ?>/static/admin/article/img/noimg.png<?php endif; ?>" width="50" height="50"></a>
            </td>
            <td><a href="<?php echo url('edit', ['id' => $v['id']]); ?>"><?php echo htmlentities($v['name']); ?></a></td>
            <td><?php echo htmlentities($v['num']); ?></td>
            <td>
            <?php if($v['status']): ?>
              <a href="<?php echo url('changestatus', ['id' => $v['id'], 'status' => 0]); ?>" class="j-status text-success">已发布</a>
            <?php else: ?>
              <a href="<?php echo url('changestatus',  ['id' => $v['id'], 'status' => 1]); ?>" class="j-status text-warning">未发布</a>
            <?php endif; ?>
            </td>
            <td><?php echo htmlentities($v['create_time']); ?></td>
            <td>
              <a href="<?php echo url('edit', ['id' => $v['id']]); ?>" style="margin-right:5px;">编辑</a>
              <a href="<?php echo url('delete', ['id' => $v['id']]); ?>" class="j-del text-danger">删除</a>
            </td>
          </tr>
          <?php endforeach; if($article->isEmpty()): ?>
          <tr>
            <td colspan="7" class="text-center">列表为空</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="text-center"><?php echo $article; ?></div>
    </div>
  </div>
  <script>
    $('.j-select').change(function() {
      main.content($(this).val());
    });
    $('.j-search').submit(function() {
      var val = $(this).find('input[name=search]').val();
      main.content('?search=' + encodeURIComponent(val));
      return false;
    });
    $('.j-del').click(function() {
      if (confirm('您确定将此项放入回收站？')) {
        main.ajaxPost($(this).attr('href'), function () {
          main.contentRefresh();
        });
      }
      return false;
    });
    $('.j-status').click(function () {
      main.ajaxPost($(this).attr('href'), function () {
        main.contentRefresh();
      });
      return false;
    });
  </script>