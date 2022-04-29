<?php /*a:1:{s:69:"K:\study_php\web\mytp\application\admin\view\goods\category\edit.html";i:1638094645;}*/ ?>
<div>
  <div class="main-title">
    <h2><?php if($id): ?>编辑<?php else: ?>新增<?php endif; ?>分类</h2>
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
            <?php foreach($category as $v): if($v['level'] === 0 && $v['id'] !== $id): ?>
            <option value="<?php echo htmlentities($v['id']); ?>" <?php if($v['id']===$data['pid']): ?>selected<?php endif; ?>> <?php echo htmlentities($v['name']); ?></option>
            <?php endif; ?>
            <?php endforeach; ?>
          </select>
          <label>上级分类</label>
        </li>
        <li>
          <input type="text" class="form-control" name="name" value="<?php echo htmlentities($data['name']); ?>" required> <label>名称</label>
        </li>
        <li>
          <input type="button" class="btn btn-success j-upload-category" value="上传图片">
        </li>
        <li>
          <ul class="main-imglist j-category-image">
            <li>
              <div class="main-imglist-item">
                <img class="j-upload-category" src="<?php if($data['image']): ?>/static/uploads/<?php echo htmlentities($data['image']); else: ?>/static/admin/goods/img/noimg.png<?php endif; ?>">
                <div class="main-imglist-item-opt" <?php if(!$data['image']): ?>style="display:none"<?php endif; ?>>
                  <input type="hidden" name="image" value="<?php echo htmlentities($data['image']); ?>">
                  <small><a class="j-category-image-del" href="#">删除</a></small>
                </div>
              </div>
            </li>
          </ul>
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
  $('.j-upload-category').click(function() {
    main.modal("<?php echo url('album/show', ['album_id' => $album_id]); ?>", function(modal) {
      var obj = modal.find('.j-img-selected');
      if (obj.length > 1) {
        main.toastr.error('最多只能选择一个。');
        return false;
      }
      if (obj.length < 1) {
        main.toastr.error('最少选择一个。');
        return false;
      }
      var img = obj.find('img');
      $('.j-category-image img').attr('src', img.attr('src'));
      $('.j-category-image input[name=image]').val(img.attr('data-path'));
      $('.j-category-image .main-imglist-item-opt').show();
    });
    return false;
  });
  $('.j-category-image-del').click(function() {
    $('.j-category-image img').attr('src', '/static/admin/goods/img/noimg.png');
    $('.j-category-image input[name=image]').val('');
    $('.j-category-image .main-imglist-item-opt').hide();
    return false;
  });
</script>