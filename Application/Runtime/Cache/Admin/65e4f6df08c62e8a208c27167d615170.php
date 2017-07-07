<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>友情链接-后台管理</title>
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_PUB); ?>css/common.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo (ADMIN_PUB); ?>css/main.css"/>
    <script type="text/javascript" src="<?php echo (ADMIN_PUB); ?>js/libs/modernizr.min.js"></script>
    <script type="text/javascript" src="<?php echo (ADMIN_PUB); ?>js/jquery-1.4.2.min.js"></script>
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
                        <li><a href="design.html"><i class="icon-font">&#xe004;</i>留言管理</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe012;</i>评论管理</a></li>
                        <li><a href="/index.php/Admin/Link/lst"><i class="icon-font">&#xe052;</i>友情链接</a></li>
                        <li><a href="design.html"><i class="icon-font">&#xe033;</i>广告管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>系统管理</a>
                    <ul class="sub-menu">
                        <li><a href="/index.php/Admin/System/index"><i class="icon-font">&#xe017;</i>系统设置</a></li>
                        <li><a href="/index.php/Admin/Admin/index"><i class="icon-font">&#xe006;</i>用户管理</a></li>

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
            <div class="crumb-list"><i class="icon-font"></i><a href="/js<?php echo (ADMIN_PUB); ?>css/admin">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">友情链接管理</span></div>
        </div>

        <div class="result-wrap">
            <form  name="myform" id="myform" method="post">
                <div class="result-title">
                    <div class="result-list">
                        <a href="/index.php/Admin/Link/add"><i class="icon-font"></i>新增链接</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i><input  form="myform" formaction="/index.php/Admin/Link/batchdel" formmethod="post" type="submit" class="btn btn-primary btn2" value="批量删除"></a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i><input  form="myform" formaction="/index.php/Admin/Link/sortlink" formmethod="post" type="submit" class="btn btn-primary btn2" value="更新排序"></a>
                    </div>
                </div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th class="tc" width="5%"><input class="allChoose" name="" id='check' type="checkbox"></th>
                            <th>排序</th>
                            <th>ID</th>
                            <th>链接名称</th>
                            <th>链接地址</th>
                            <th>链接描述</th>
                            <th>操作</th>
                        </tr>
                        <?php if(is_array($links)): $i = 0; $__LIST__ = $links;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td class="tc"><input name="ids[]" value="<?php echo ($vo["id"]); ?>" class="check" type="checkbox"></td>
                            <td>
                                <input class="common-input sort-input" name="<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["sort"]); ?>" type="text">
                            </td>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["title"]); ?></td>
                            <td>
                                <a href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["url"]); ?></a>
                            </td>
                            <td><?php echo ($vo["des"]); ?></td>        
                            <td>
                                <a class="link-update" href="/index.php/Admin/Link/edit/id/<?php echo ($vo["id"]); ?>">修改</a>
                                <a class="link-del" onclick="return confirm('确定删除此栏目及其子栏目？');" href="/index.php/Admin/Link/del/id/<?php echo ($vo["id"]); ?>">删除</a>
                            </td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                    <div class="list-page"> 2 条 1/1 页</div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
<script type="text/javascript">
    $("#check").click(function(){
        if($(this).attr("checked")){
            $(".check").attr("checked","checked");
        }else{
            $(".check").removeAttr("checked");
        }
    });
</script>