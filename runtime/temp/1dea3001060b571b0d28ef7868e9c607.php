<?php /*a:1:{s:72:"K:\study_php\web\tpadmin\application\admin\view\goods\recycle\index.html";i:1638751412;}*/ ?>
<div>
    <div class="main-title">
      <h2>商品管理</h2>
    </div>
    <div class="main-section">
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th width="80">分类</th>
            <th width="100">图片</th>
            <th>名称</th>
            <th width="80">库存量</th>
            <th width="70">状态</th>
            <th width="155">删除时间</th>
            <th width="160">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($goods as $v): ?>
          <tr>
            <td><?php echo !empty($v['goods_category']['name']) ? htmlentities($v['goods_category']['name']) : '---'; ?></td>
            <td>
              <img src="<?php if($v['image']): ?>/static/uploads/<?php echo htmlentities($v['image']); else: ?>/static/admin/goods/img/noimg.png<?php endif; ?>" width="50" height="50">
            </td>
            <td><?php echo htmlentities($v['name']); ?></td>
            <td><?php echo htmlentities($v['num']); ?></td>
            <td>
              <?php if($v['status']): ?><span class="text-success">上架</span><?php else: ?><span class="text-warning">下架</span><?php endif; ?>
            </td>
            <td><?php echo htmlentities($v['delete_time']); ?></td>
            <td>
              <a href="<?php echo url('restore', ['id' => $v['id']]); ?>" class="j-recycle text-success" style="margin-right:8px;">恢复</a>
              <a href="<?php echo url('delete', ['id' => $v['id']]); ?>" class="j-del text-danger">彻底删除</a>
            </td>
          </tr>        
          <?php endforeach; if($goods->isEmpty()): ?>
          <tr>
            <td colspan="7" class="text-center">列表为空</td>
          </tr>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="text-center"><?php echo $goods; ?></div>
    </div>
  </div>
  <script>
    $('.j-del').click(function() {
      if (confirm('您确定将此项从回收站中删除？')) {
        main.ajaxPost($(this).attr('href'), function() {
          main.contentRefresh();
        });
      }
      return false;
    });
    $('.j-recycle').click(function() {
      if (confirm('您确定恢复此项？')) {
        main.ajaxPost($(this).attr('href'), function() {
          main.contentRefresh();
        });
      }
      return false;
    });
  </script>