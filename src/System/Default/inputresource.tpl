<?php
namespace [MODULE]\Input;

class [CONTROLLER]Input{
    /**
     * 创建数据
     * @return array
     */
    static public function store(){
        $data             = I('post.');
        if( !$data ){
            return array('error_code'=>4404,'error_data'=>'没有上传');
        }
        return array('error_code'=>0,'data'=>$data);
    }
    /**
    * 更新数据
    * @return array
    */
    static public function update(){
        $data             = I('post.');
        if( !$data['id'] ){
            return array('error_code'=>4404,'error_data'=>'没有上传id');
        }
        return array('error_code'=>0,'data'=>$data);
    }
}