<?php /*a:1:{s:66:"K:\study_php\web\mytp\application\admin\view\admin\menu\index.html";i:1637811952;}*/ ?>
<div>
    <div class="main-title">
      <h2>菜单管理</h2>
    </div>
    <div class="main-section">
      <a href="<?php echo url('edit'); ?>" class="btn btn-success">+ 新增</a>
    </div>
    <div class="main-section">
      <form method="post" action="<?php echo url('sort'); ?>" class="j-form">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th width="55">序号</th>
              <th>名称</th>
              <th>图标</th>
              <th>控制器</th>
              <th width="100">操作</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($menu as $v): ?>
            <tr>
              <td>
                <input type="text" class="form-control j-sort" maxlength="5" value="<?php echo htmlentities($v['sort']); ?>" data-name="sort[<?php echo htmlentities($v['id']); ?>]"
                  style="height:25px;font-size:12px;padding:0 5px;">
              </td>
              <td><small class="text-muted"><?php if($v['level']): ?>├──<?php endif; ?></small> <?php echo htmlentities($v['name']); ?></td>
              <td><?php echo htmlentities($v['icon']); ?></td>
              <td><?php echo htmlentities($v['controller']); ?></td>
              <td>
                <a href="<?php echo url('edit', ['id' => $v['id']]); ?>" style="margin-right:5px;">编辑</a>
                <a href="<?php echo url('delete', ['id' => $v['id']]); ?>" class="j-del text-danger">删除</a>
              </td>
            </tr>
            <?php endforeach; if(empty($menu)): ?>
            <tr>
              <td colspan="5" class="text-center">还没有添加项目</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <input type="submit" value="改变排序" class="btn btn-primary">
      </form>
    </div>
  </div>
  <script>
    main.ajaxForm('.j-form', function () {
      main.contentRefresh();
    });
    $('.j-sort').change(function () {
      $(this).attr('name', $(this).attr('data-name'));
    });
    
    $('.j-del').click(function () {
      if (confirm('您确定要删除此项？')) {
        main.ajaxPost($(this).attr('href'), function () {
          main.contentRefresh();
        });
      }
      return false;
    });
  </script>