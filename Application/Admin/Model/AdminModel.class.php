<?php
namespace Admin\Model;
use Think\Model;
class AdminModel extends Model{
	protected $_validate = array(
		array('username','require','用户名不得为空'),
		array('username','','用户名不得重复',1,unique,1),
		//array('url','require','链接地址不得为空',1),
		);
}