<?php
namespace [MODULE]\Model;
use Think\Model;
class [MODEL]Model extends Model {
    /**
     * 索引/列表
     */
    public function lists(){
        return $this->select();
    }

    /**
    * 保存你创建的数据
    */
    public function store($data,&$error){
        $id = $this->( $data );
        if( !$id ){
            $error = '创建失败';
            return false;
        }
        return $id;
    }


    /**
    * 显示详情
    */
    public function details($id,&$error){
        $data = $this->where(['id'=>$id])->find();
        if( !$data ){
            $error = '没有对应的数据';
            return false;
        }
        return $data;
    }

    /**
    * 保存你编辑的数据
    */
    public function update($data,&$error){
        $status = $this->where(['id'=>$id])->save( $data );
        if( $status===false ){
            $error = '修改失败';
            return false;
        }
        return $status;
    }

    /**
    * 删除
    */
    public function destroy($id,&$error){
        return $this->where(['id'=>$id])->delete();
    }
}