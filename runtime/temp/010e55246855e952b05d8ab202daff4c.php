<?php /*a:2:{s:61:"K:\study_php\web\mytp\application\admin\view\album\index.html";i:1638089172;s:63:"K:\study_php\web\mytp\application\admin\view\common\layout.html";i:1639293244;}*/ ?>
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
  <title>哩迹文章网  后台管理系统</title>
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
      <div class="navbar-brand">哩迹文章网  后台管理系统</div>
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
      <h2>图库管理</h2>
    </div>
    <div class="main-section">
      <form method="post" action="<?php echo url('sort'); ?>" class="j-form">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th width="55">序号</th>
              <th>名称</th>
              <th>路径</th>
              <th width="100">操作</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($album as $v): ?>
            <tr>
              <td><small><?php echo htmlentities($v['sort']); ?></small></td>
              <td><small class="text-muted"><?php if($v['level']): ?>├──<?php endif; ?></small><a href="<?php echo url('show', ['album_id' => $v['id']]); ?>"><?php echo htmlentities($v['name']); ?></a></td>
              <td><?php echo htmlentities($v['path']); ?></td>
              <td><a href="<?php echo url('show', ['album_id' => $v['id']]); ?>">查看</a></td>
            </tr>          
            <?php endforeach; if(empty($album)): ?>
            <tr>
              <td colspan="4" class="text-center">还没有添加项目</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </form>
    </div>
  </div></div>
    <div class="main-loading" style="display:none">
      <div class="dot-carousel"></div>
    </div>
  </div>
  <script>main.layout();</script>
</body>

</html>