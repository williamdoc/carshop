<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>添加分类-后台管理</title>
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_PUB); ?>css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_PUB); ?>css/main.css"/>
    <script type="text/javascript" src="/Public/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" src="/Public/ueditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.html" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.html">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="#">管理员</a></li>
                <li><a href="#">修改密码</a></li>
                <li><a href="#">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
        <div class="sidebar-title">
            <h1>菜单</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>常用操作</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php/Admin/Cate/lst"><i class="icon-font">&#xe008;</i>栏目管理</a></li>
                        <li><a href="/index.php/Admin/Article/lst"><i class="icon-font">&#xe005;</i>文章管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe006;</i>分类管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe012;</i>评论管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe052;</i>友情链接</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="system.html"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe037;</i>清理缓存</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe046;</i>数据备份</a></li>
                        <li><a href="system.html"><i class="icon-font">&#xe045;</i>数据还原</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">

        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font"></i><a href="/jscss/admin/design/">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="/jscss/admin/design/">栏目管理</a><span class="crumb-step">&gt;</span><span>修改栏目</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo ($cateres["id"]); ?>">
                    <table class="insert-tab" width="100%">
                        <tbody><tr>
                            <th width="120"><i class="require-red">*</i>上级分类：</th>
                            <td>
                                <select name="parentid" id="catid" class="required">
                                    <option value="0">顶级栏目</option>
                                    <?php if(is_array($cates)): $i = 0; $__LIST__ = $cates;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['id'] == $cateres['id'] ): ?>style="display:none;"<?php endif; ?>>
                                        <?php if($vo['parentid'] != 0 ): ?>|<?php endif; echo str_repeat('-', $vo['level']*4); echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </td>
                        </tr>
                            <tr>
                                <th><i class="require-red">*</i>栏目名称：</th>
                                <td>
                                    <input class="common-text required" id="title" name="name" size="50" value="<?php echo ($cateres["name"]); ?>" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>关键词：</th>
                                <td><input class="common-text" name="keywords" size="50" value="<?php echo ($cateres["keywords"]); ?>" type="text"></td>
                            </tr>
                            <tr>
                                <th>描述：</th>
                                <td><textarea name="des" class="common-textarea" cols="58" rows="5"><?php echo ($cateres["des"]); ?></textarea></td>
                            </tr>
                           <tr>
                                <th>栏目类型：</th>
                                <td><input class="common-text" name="type" size="50" value="1" type="radio" <?php if( $cateres['type'] == 1): ?>checked="checked"<?php endif; ?>>列表
                                    <input class="common-text" name="type" size="50" value="2" type="radio" <?php if($cateres['type'] == 2): ?>checked="checked"<?php endif; ?>>单页
                                    <input class="common-text" name="type" size="50" value="3" type="radio" <?php if($cateres['type'] == 3): ?>checked="checked"<?php endif; ?>>留言
                                    <input class="common-text" name="type" size="50" value="4" type="radio" <?php if($cateres['type'] == 4): ?>checked="checked"<?php endif; ?>>招聘</td>
                            </tr>

                            <tr>
                                <th><i class="require-red">*</i>缩略图：</th>
                                <td><input name="pic" id="" type="file" >
                                <?php if($cateres['pic'] != ''): ?><img src="<?php echo ($cateres["pic"]); ?>" height=50 width=80>
                                    <?php else: ?>暂无缩略图<?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>内容：</th>
                                <td><textarea name="content" class="common-textarea" id="content" cols="30" style="width: 98%;" rows="10"><?php echo ($cateres["content"]); ?></textarea></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>
<script type="text/javascript">
    UE.getEditor('content',{initialFrameWidth:800,initialFrameHeight:400,});
</script>