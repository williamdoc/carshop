<?php
namespace Admin\Model;
use Think\Model;
class CateModel extends Model {

    protected $_validate = array(
            array('name','require','栏目名称不得为空',1),
            array('name','','栏目名称不得重复',1,unique,1),
        );

    public function catetree(){
        $data=$this->order('sort asc')->select();
        return $this->resort($data);
    }

    public function resort($data,$parentid=0,$level=0){
        static $ret=array();
        foreach($data as $k=>$v){
            if($v['parentid']==$parentid){
                $v['level']=$level;
                $ret[]=$v;
                $this->resort($data,$v['id'],$level+1);
            }
        }
        return $ret;
    }

    public function childid($cateid){
        $data=$this->select();
        return $this->getchildid($data,$cateid);
    }

    public function getchildid($data,$parentid){
        static $ret=array();
        foreach ($data as $k => $v) {
            if($v['parentid']==$parentid){
                $ret[]=$v['id'];
                $this->getchildid($data,$v['id']);
            }
        }

        return $ret;
    }
    public function _before_delete($options){
        if(is_array($options['where']['id'])){

            $arr=explode(',',$options['where']['id'][1]);
            $subcate = array();
            foreach($arr as $k=>$v){
                $subcate2 = $this->childid($v);
                $subcate = array_merge($subcate,$subcate2);
            }
            $subcate = array_unique($subcate);
            $childrenids = implode(',',$subcate);
        }else{
            $childrenids=$this->childid($options['where']['id']);
            $childrenids=implode(',',$childrenids);
        }

        if($childrenids){
            $this->execute("delete from cs_cate where id in($childrenids)");
        }        
    }
}