<?php /*a:1:{s:64:"K:\study_php\web\tpadmin\application\admin\view\index\login.html";i:1637561838;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/static/common/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/static/common/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet" href="/static/admin/css/main.css?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>">
    <script src="/static/common/jquery/1.12.4/jquery.min.js"></script>
    <script src="/static/common/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="/static/common/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="/static/admin/js/main.js?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>"></script>
    <title>登录</title>
</head>
<body class="login">
    
    <div class="container">
        <form method="post" class="j-login">
          <h1>后台管理系统</h1>
          <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="用户名" required>
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="密码" required>
          </div>
          <div class="form-group">
            <input type="text" name="captcha" class="form-control" placeholder="验证码" required>
          </div>
          <div class="form-group">
            <div class="login-captcha"><img src="<?php echo captcha_src(); ?>" alt="captcha"></div>
          </div>
          <div class="form-group">
            <input type="submit" class="btn btn-lg btn-success" value="登录">
          </div>
        </form>
        <div class="main-loading" style="display:none">
          <div class="dot-carousel"></div>
        </div>  
    </div>

    <script>
      main.init({token:'<?php echo htmlentities($token); ?>'});
  
      main.ajaxForm('.j-login', function() {
        location.href = "<?php echo url('Index/index'); ?>";
      }, function() {
        $('.login-captcha img').click();
      });

      $('.login-captcha img').click(function () {
        $(this).attr('src', '<?php echo captcha_src(); ?>' + '?_=' + Math.random());
      });
    </script>
</body>

</html>