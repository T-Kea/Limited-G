<?php /*a:2:{s:70:"K:\study_php\web\tpadmin\application\admin\view\goods\goods\index.html";i:1638751159;s:66:"K:\study_php\web\tpadmin\application\admin\view\common\layout.html";i:1637810214;}*/ ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/static/common/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/static/common/font-awesome-4.2.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="/static/common/toastr.js/2.1.4/toastr.min.css">
  <link rel="stylesheet" href="/static/admin/css/main.css">
  <script src="/static/common/jquery/1.12.4/jquery.min.js"></script>
  <script src="/static/common/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="/static/common/toastr.js/2.1.4/toastr.min.js"></script>
  <script src="/static/admin/js/main.js"></script>
  <title>后台管理系统</title>
</head>

<body>
  <nav class="navbar navbar-default navbar-static-top main-nav" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="navbar-brand">后台管理系统</div>
    </div>
    <div class="collapse navbar-collapse">
      <div class="main-sidebar">
        <ul class="nav main-menu">
          <!-- <li>
            <a href="<?php echo url('Index/index'); ?>" class="active">
              <i class="fa fa-home fa-fw"></i>首页
            </a>
          </li>
          <li class="main-sidebar-collapse">
            <a href="#" class="main-sidebar-collapse-btn">
              <i class="fa fa-cog fa-fw"></i>设置
              <span class="fa main-sidebar-arrow"></span>
            </a>
            <ul class="nav">
              <li><a href="<?php echo url('test1'); ?>"><i class="fa fa-cog fa-fw"></i>设置1</a></li>
              <li><a href="<?php echo url('test2'); ?>"><i class="fa fa-cog fa-fw"></i>设置2</a></li>
            </ul>
        </li> -->
          <?php foreach($layout_menu as $v): ?>
          <li class="<?php if($v['sub'] && !$v['curr']): ?>main-sidebar-collapse<?php endif; ?>">
            <a href="<?php echo url('admin/'.$v['controller'].'/index'); ?>"
              class="<?php if($v['sub']): ?>main-sidebar-collapse-btn <?php else: if($v['curr']): ?>active<?php endif; ?><?php endif; ?>"
              data-name="<?php echo htmlentities($v['controller']); ?>"><i class="fa fa-<?php echo htmlentities($v['icon']); ?> fa-fw"></i><?php echo htmlentities($v['name']); if($v['sub']): ?><span
                class="fa main-sidebar-arrow"></span><?php endif; ?></a>
            <?php if($v['sub']): ?>
            <ul class="nav">
              <?php foreach($v['sub'] as $vv): ?>
              <li>
                <a href="<?php echo url('admin/'.$vv['controller'].'/index'); ?>" class="<?php if($vv['curr']): ?>active<?php endif; ?>"
                  data-name="<?php echo htmlentities($vv['controller']); ?>"><i class="fa fa-<?php echo htmlentities($vv['icon']); ?> fa-fw"></i><?php echo htmlentities($vv['name']); ?></a>
              </li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <!-- 将用户名和退出按钮链接放在大屏幕的顶部右侧-->
      <ul class="nav navbar-right ">
        <li>
          <!--a href="#"><i class="fa fa-user fa-fw"></i>admin</a-->
          <a href="<?php echo url('Index/password'); ?>" class="j-layout-pwd"><i class="fa fa-user fa-fw"></i><?php echo htmlentities($layout_login_user['username']); ?></a>
        </li>
        <li><a href="<?php echo url('Index/logout'); ?>"><i class="fa fa-power-off fa-fw"></i>退出</a></li>
      </ul>
    </div>
  </nav>
  <div class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" 
           aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="j-modal-content"></div>
          <div class="main-loading" style="display:none">
            <div class="dot-carousel"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary j-modal-submit">确定</button>
          <button type="button" class="btn btn-default j-modal-cancel" 
           data-dismiss="modal">取消</button>
        </div>
      </div>
    </div>
  </div>  
  <script>main.init({ token: '<?php echo htmlentities($layout_token); ?>' });</script>
  <div class="main-container">
    <div class="main-content"><div>
    <div class="main-title">
      <h2>商品管理</h2>
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
         placeholder="输入商品名" required>
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
            <th width="80">分类</th>
            <th width="60">图片</th>
            <th>名称</th>
            <th width="80">库存量</th>
            <th width="70">状态</th>
            <th width="155">创建时间</th>
            <th width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($goods as $v): ?>
          <tr>
            <td><?php echo !empty($v['goods_category']['name']) ? htmlentities($v['goods_category']['name']) : '---'; ?></td>
            <td>
              <a href="<?php echo url('edit', ['id' => $v['id']]); ?>"><img src="<?php if($v['image']): ?>/static/uploads/<?php echo htmlentities($v['image']); else: ?>/static/admin/goods/img/noimg.png<?php endif; ?>" width="50" height="50"></a>
            </td>
            <td><a href="<?php echo url('edit', ['id' => $v['id']]); ?>"><?php echo htmlentities($v['name']); ?></a></td>
            <td><?php echo htmlentities($v['num']); ?></td>
            <td>
            <?php if($v['status']): ?>
              <a href="<?php echo url('changestatus', ['id' => $v['id'], 'status' => 0]); ?>" class="j-status text-success">上架</a>
            <?php else: ?>
              <a href="<?php echo url('changestatus',  ['id' => $v['id'], 'status' => 1]); ?>" class="j-status text-warning">下架</a>
            <?php endif; ?>
            </td>
            <td><?php echo htmlentities($v['create_time']); ?></td>
            <td>
              <a href="<?php echo url('edit', ['id' => $v['id']]); ?>" style="margin-right:5px;">编辑</a>
              <a href="<?php echo url('delete', ['id' => $v['id']]); ?>" class="j-del text-danger">删除</a>
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
  </script></div>
    <div class="main-loading" style="display:none">
      <div class="dot-carousel"></div>
    </div>
  </div>
  <script>main.layout();</script>
</body>

</html>