<?php /*a:1:{s:65:"K:\study_php\web\mytp\application\admin\view\admin\menu\edit.html";i:1637812098;}*/ ?>
<div>
    <div class="main-title">
      <h2><?php if($id): ?>编辑<?php else: ?>新增<?php endif; ?>菜单</h2>
    </div>
    <div class="main-section">
      <form method="post" action="<?php echo url('save'); ?>" class="j-form">
        <ul class="form-group form-inline">
          <li>
            <input type="text" class="form-control" maxlength="5" name="sort" value="<?php echo htmlentities($data['sort']); ?>" style="width:50px;">
            <label>序号</label>
          </li>
          <li>
            <select name="pid" class="form-control" style="min-width:196px;">
              <option value="0">---</option>
              <?php foreach($menu as $v): if($v['level']===0 && $v['id'] !== $id): ?>
                  <option value="<?php echo htmlentities($v['id']); ?>" <?php if($v['id'] === $data['pid']): ?>selected<?php endif; ?>><?php echo htmlentities($v['name']); ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
            <label>上级菜单</label>
          </li>
          <li>
            <input type="text" class="form-control" name="name" value="<?php echo htmlentities($data['name']); ?>" required> <label>名称</label>
          </li>
          <li>
            <input type="text" class="form-control" name="icon" value="<?php echo htmlentities($data['icon']); ?>" required> <label>图标</label>
          </li> 
          <li>
            <input type="text" class="form-control" name="controller" value="<?php echo htmlentities($data['controller']); ?>" required>
            <label>控制器</label>
          </li>
          <li>
            <input type="hidden" name="id" value="<?php echo htmlentities($id); ?>">
            <input type="submit" value="提交表单" class="btn btn-primary">
            <a href="<?php echo url('index'); ?>" class="btn btn-default">返回列表</a>
          </li>
        </ul>
      </form>
    </div>
  </div>
  <script>
    main.ajaxForm('.j-form', function () {
      main.content("<?php echo url('index'); ?>");
    });
  </script>