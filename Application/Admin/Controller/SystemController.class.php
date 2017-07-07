<?php
namespace Admin\Controller;
use Think\Controller;

class SystemController extends Controller{

	public function index(){
		if(IS_POST){
			$file='./Application/Common/Conf/config.php';
			$config=array_merge(include $file,array_change_key_case($_POST,CASE_UPPER));
			$str = "<?php\r\nreturn ".var_export($config,true).";\r\n?>";
			if(file_put_contents($file,$str)){
				$this->success('配置成功',U('index'));
			}else{
				$this->error('修改配置失败');
			}
			return;
		}
		$this->display();
	}
}