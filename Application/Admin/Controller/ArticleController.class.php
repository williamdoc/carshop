<?php
namespace Admin\Controller;
use Think\Controller;
class ArticleController extends Controller {

     public function lst(){

        $article = D('articleView');
        $where=1;
        if($search=I('search-sort')){
            $where.=' AND cateid='.$search;
        }
        if($kw=I('kw')){
            $where.=' AND title LIKE "%'.$kw.'%"';
        }
        $count = $article->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count,5);
        $show = $Page->show();// 分页显示输出
        $list = $article->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出

        $cate = D('cate');
        $cates=$cate->catetree();
        $this->assign('cates',$cates);

        $this->display();
     }

     public function add(){
        $article = D('article');

        if(IS_POST){
            $data['cateid']=I('cateid');
            $data['title']=I('title');
            $data['rizu']=I('rizu');
            $data['num']=I('num');
            $data['atype']=I('atype');
            $data['author']=I('author');
            $data['rem']=I('rem');
            $data['keywords']=I('keywords');
            $data['des']=I('des');
            $data['pic']=I('pic');
            $data['content']=I('content');
            $data['time']=time();

            if($_FILES['pic']['tmp_name']!=''){
                $upload = new \Think\Upload();// 实例化上传类 
                $upload->maxSize = 3145728 ;// 设置附件上传大小 
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './';
                $upload->savePath = "/Public/Uploads/"; // 设置附件上传（子）目录
                $info = $upload->uploadOne($_FILES['pic']);// 上传错误提示错误信息 

                if(!$info) {
                    $this->error($upload->getError()); 
                }else{
                    $data['pic']=$info['savepath'].$info['savename'];
                }
                
            }

            if($article->create($data)){
                if($article->add()){
                    $this->success('新增文章成功',U('lst'));
                }else{
                    $this->error('新增文章失败！');
                }
            }else{
                $this->error($article->getError());
            }   
            return;
        }

        $cate = D('cate');
        $cates=$cate->catetree();
        $this->assign('cates',$cates);        
        $this->display();
     }

     public function del($id){
        $article = D('article');

        if($article->delete($id)){
            $this->success('删除文章成功',U('lst'));
        }else{
            $this->error('删除文章失败');
        }
     }

     public function batchdel(){
        $ids = I('ids');
        $ids = implode(',',$ids);
        $article = D('article');
        if(ids){
            if($article->delete($ids)){
                $this->success('批量删除成功',U('lst'));
            }else{
                $this->error('批量删除失败');
            }
        }else{
            $this->error('未选中要删除的选项');
        }
     }
    public function edit(){

        $article = D('article');
        if(IS_POST){
            $data['id']=I('id');
            $data['cateid']=I('cateid');
            $data['title']=I('title');
            $data['rizu']=I('rizu');
            $data['num']=I('num');
            $data['atype']=I('atype');            
            $data['author']=I('author');
            $data['rem']=I('rem');
            $data['keywords']=I('keywords');
            $data['des']=I('des');
            $data['pic']=I('pic');
            $data['content']=I('content');
            $data['time']=time();

            if($_FILES['pic']['tmp_name']!=''){
                $upload = new \Think\Upload();// 实例化上传类 
                $upload->maxSize = 3145728 ;// 设置附件上传大小 
                $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
                $upload->rootPath = './';
                $upload->savePath = "/Public/Uploads/"; // 设置附件上传（子）目录
                $info = $upload->uploadOne($_FILES['pic']);// 上传错误提示错误信息 

                if(!$info) {
                    $this->error($upload->getError()); 
                }else{
                    $data['pic']=$info['savepath'].$info['savename'];
                }
                
            }

            if($article->create($data)){
                if($article->save()){
                    $this->success('修改文章成功',U('lst'));
                }else{
                    $this->error('修改文章失败！');
                }
            }else{
                $this->error($article->getError());
            }   
            return;
        }

        $id = I('id');
        $articles = $article->find($id);
        $this->assign('article',$articles);

        $cate = D('cate');
        $cates=$cate->catetree();
        $this->assign('cates',$cates); 
               
        $this->display();
    }
}