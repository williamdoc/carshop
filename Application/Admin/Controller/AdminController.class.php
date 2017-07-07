<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller{

	public function index(){

        $user=D('admin');
        $where=1;

        if($kw=I('kw')){
            $where.=' AND username LIKE "%'.$kw.'%"';
        }
        $count = $user->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,5);
        $show = $Page->show();// 分页显示输出
        $list = $user->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

		$this->display();
	}

	public function add(){


		if(IS_POST){
			$user=D('admin');
			if($user->create()){
				$user->password=md5($user->password);
				if($user->add()){
					$this->success('新用户添加成功',U('index'));
				}else{
					$this->error('新用户添加失败');
				}
			}else{
				$this->error($user->getError());
			}

			return;
		}

		$this->display();
	}

	public function edit(){

		$user=D('admin');

		if(IS_POST){
			if($user->create()){
				$user->password=md5($user->password);
				if($user->save()){
					$this->success('修改用户添加成功',U('index'));
				}else{
					$this->error('修改用户添加失败');
				}
			}else{
				$this->error($user->getError());
			}

			return;
		}
		$users=$user->find(I('id'));
		$this->assign('user',$users);
		$this->display();
	}

	public function del(){
		$id=I('id');
		$admin =D('admin');
		if($id==1){
			$this->error('超级管理员无法删除');
		}
		if($admin->delete($id)){
			$this->success('删除管理员成功',U('index'));
		}else{
			$this->error('删除管理员失败');
		}
	}
	public function batchdel(){
		$admin =D('admin');

		$ids=I('ids');
		$ids=implode(',',$ids);
		if($id==1){
			$this->error('超级管理员无法删除');
		}
		if($admin->delete($ids)){
			$this->success('批量删除管理员成功',U('index'));
		}else{
			$this->error('批量删除管理员失败');
		}
	}
}