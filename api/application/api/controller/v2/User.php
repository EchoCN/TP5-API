<?php

namespace app\api\controller\v2;

use app\api\model\api_user as users;
use think\Controller;
use think\Request;

class User extends Controller
{

    const succ_code = 200;
    const fail_code = 404;
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index()
    {
        $data = users::all();

        if($data)
        {
            return $data;
        }else
        {
            return "失败请求";
        }
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    //简单的登入
    public function login(Request $request)
    {
        $data = $request->param();

        $login_user = $data['name'];

        $db_user = users::where('name','=',$login_user)
        ->find();

        if($db_user)
        {
            return User::succ_code;
        }
        else
        {
            return User::fail_code;
        }
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $data = $request->param();

        $validate = new \app\api\validate\User;

        if(!$validate->check($data))
        {
            return $validate->getError();

        }else{

            $user = users::create($data,['name','age','content']);

            return $user->id . "创建成功！";
        }
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        $user = users::get($id);

        return $user;
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        $user = users::get($id);

        $data = $request->param();

        $validate = new \app\api\validate\User;


        if(!$validate->check($data))
        {
            return $validate->getError();
        }
        else
        {
            $users = users::update($data,
            ['name'=>$data['name'],'age'=>$data['age'],'content'=>$data['content']]);
    
            return $users->id . "更新成功";
        }
    }
    /**
     * 查询指定资源
     *
     * @param  int  $age
     * @return \think\Response
     */

    public function search($age)
    {
        $user = users::search($age)
        ->select();
        
        return $user;
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete($id)
    {
        $user = users::get($id)->delete();

        return "已删除";
    }
}
