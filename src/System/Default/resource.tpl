<?php
namespace [MODULE]\Controller;
use Think\Controller;
class [CONTROLLER]Controller extends Controller {
    /**
     * 索引/列表
     */
    public function index(){
        $data   = D('[CONTROLLER]')->lists();
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * 创建（显示表单）
     */
    public function create(){
        $this->display();
    }

    /**
     * 保存你创建的数据
     */
    public function store(){
        $error  = '';
        $data   = D('[CONTROLLER]')->store(input(),$error);
        if( $data===false ){
        $this->( 创建失败:'.$error );
        }
        $this->success( '创建成功' );
    }

    /**
     * 显示对应id的内容
     */
    public function show(){
        $id     = I('id',0,'int');
        $data   = D('[CONTROLLER]')->details($id);
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * 编辑（显示表单）
     */
    public function edit(){
        $id     = I('id',0,'int');
        $data   = D('[CONTROLLER]')->details($id);
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * 保存你编辑的数据
     */
    public function update(){
        $error  = '';
        $data   = D('[CONTROLLER]')->update(input(),$error);
        if( $data===false ){
        $this->( 更新失败:'.$error );
        }
        $this->success( '更新成功' );
    }

    /**
     * 删除
     */
    public function destroy(){
        $id     = I('id',0,'int');
        $error  = '';
        $data   = D('[CONTROLLER]')->details($id,$error);
        if( $data===false ){
            $this->( '删除失败'.$error );
        }
        $this->success( '删除成功' );
    }
}