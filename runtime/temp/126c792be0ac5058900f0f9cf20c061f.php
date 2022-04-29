<?php /*a:2:{s:60:"K:\study_php\web\mytp\application\index\view\index\show.html";i:1639909612;s:63:"K:\study_php\web\mytp\application\index\view\common\layout.html";i:1639842326;}*/ ?>
<html>
<head>
  <meta charset="utf-8">
  <title>哩迹文章网</title>
  <meta name="renderer" content="webkit">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="/static/admin/css/css/layui.css?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>" tppabs="https://www.layui.site/layui/dist/css/layui.css"  media="all">
  <link rel="stylesheet" href="/static/admin/css/css/wireframe.css?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>">
  <link rel="stylesheet" href="/static/admin/css/css/bootstrap.min.css?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>">
  <link rel="stylesheet" href="/static/admin/css/css/style.css?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>">
  <link rel="stylesheet" href="/static/admin/css/css/responsive.css?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>">
  <link rel="stylesheet" href="/static/admin/css/main.css?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>">
  <script src="/static/admin/layui.js?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>"></script>
  <script src="/static/common/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="/static/admin/js/main.js?<?php if(app('request')->env('app_debug')): ?>_=<?php echo time(); else: ?>v=<?php echo htmlentities(app('config')->get('tpadmin.version')); ?><?php endif; ?>"></script>
  <style>
    body{
        background-color:#ebebeb;
    }
    .footer {
        position: fixed;
        left: 0px;
        bottom: 0px;
        width: 100%;
        height: 38px;
        z-index: 9999;
      }
  </style>
</head>
<body>
        <nav>  
            <ul class="layui-nav layui-bg-cyan" align="center">
                <li class="layui-nav-item"><a href="http://mytp.test:8081/index/index"> 哩迹 LIMITED=G 文章网</a></li> 
                <?php foreach($category as $v): ?>
                    <li class="layui-nav-item">
                        <a href="#" >
                            <?php echo htmlentities($v['name']); ?>
                        </a>
                            <dl class="layui-nav-child">
                                <?php foreach($v['sub'] as $vv): ?>
                                <dd>
                                    <a href="<?php echo url('show',['category_id'=>$vv['id']]); ?>"  >
                                        <?php echo htmlentities($vv['name']); ?>
                                    </a>
                                </dd>
                                <?php endforeach; ?>
                            </dl>
                    </li>
                <?php endforeach; ?>
                <div style="float: right;" >
                    <br>
                <form class="input-group j-search" style="width:500px;margin:0 500px;">
                    <input type="text" class="form-control" name="search" value="<?php echo htmlentities($search); ?>" 
                     placeholder="请输入你想查找的文章题目" required>
                    <span class="input-group-btn">
                      <input type="submit" class="btn btn-default layui-bg-cyan" value="搜索">
                    </span>
                  </form>
                  <a href="#">&nbsp;</a>
                  <?php if($search !== ''): ?>
                    <a href="<?php echo url('', ['category_id' => $category_id]); ?>">清除条件</a>
                  <?php endif; ?>
                
            </ul>
        </nav> 
    

    <script>
        main.init({token:'<?php echo htmlentities($layout_token); ?>'});
        main.layout();

        $('.layui-nav').change(function(){
            main.content($this).val()
        });

        $('.j-search').submit(function() {
            var val = $(this).find('input[name=search]').val();
            main.content('?search=' + encodeURIComponent(val));
            return false;
        });
    </script>

     <!-- 表示内容区域 -->
    <div>
        <div >  
    <div class='layui-row'>
        <div class="layui-col-md2">&nbsp;</div>
        <div class='layui-collapse layui-col-md8' lay-accordion>
            <?php foreach($article as $v): ?>
            <div class='layui-colla-item layui-elem-quote'>
                <a href="<?php echo url('detail',['id'=>$v['id']]); ?>" >
                <h6>
                    【标题】：<?php echo htmlentities($v['name']); ?> | 作者：<?php echo htmlentities($v['writer']); ?><hr>
                    
                    <p align="right">
                    阅读量：<?php echo htmlentities($v['num']); ?>
                    </>
                </h6>
                </a>
            </div>
            <?php endforeach; ?>

            <!-- 分页功能 -->
            <?php if($article->isEmpty()): ?>
            <div>
                <div class="text-center">当前列表暂无文章</div>
            </div>
            <?php endif; ?>
            <div class="footer btn " style="background-color: #FAFAFA;">
                <div class="btn " ><h5><?php echo $article; ?></h5><br></div>
            </div>
        </div>
        
    <div> 
</div>
 
    </div>
    
    
    
</body>
</html>


