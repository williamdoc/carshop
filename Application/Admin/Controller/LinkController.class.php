<?php
namespace Admin\Controller;
use Think\Controller;
class LinkController extends Controller{

	public function lst(){
		$link = D('link');
		$links=$link->select();
		$this->assign('links',$links);
		$this->display();
	}

	public function add(){
		$link = D('link');
		if(IS_POST){
			if($link->create()){
				if($link->add()){
					$this->success('添加链接成功',U('lst'));
				}else{
					$this->error('添加链接失败');
				}
			}else{
				$this->error($link->getError());
			}

			return;
		}
		$this->display();
	}

	public function edit(){
		$link = D('link');
		$id=I('id');
		if(IS_POST){
			if($link->create()){
				if($link->save()){
					$this->success('修改链接成功',U('lst'));
				}else{
					$this->error('修改链接失败');
				}
			}else{
				$this->error($link->getError());
			}

			return;
		}

		$links=$link->find($id);
		$this->assign('links',$links);
		$this->display();
	}

    public function del(){
    	$link=D('link');
    	$id=I('id');
    	if($link->delete($id)){
    		$this->success("删除成功",U('lst'));
    	}else{
    		$this->error("删除失败");
    	}
    }

    public function batchdel(){
    	$link=D('link');
    	$ids=I('ids');
    	$ids=implode(',',$ids);
    	if($ids){
    		if($link->delete($ids)){
    			$this->success('批量删链接目成功',U('lst'));
    		}else{
    			$this->error('批量删除链接失败');
    		}
    	}else{
    		$this->error('未选中任何内容');
    	}
    }  

    public function sortlink(){
    	$link = D('link');

    	foreach($_POST as $id=>$sort){
    		$link->where("id=$id")->setField('sort',$sort);
    	}

    	$this->success('更新链接排序成功',U('lst'));
    }      	

}