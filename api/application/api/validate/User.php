<?php

namespace app\api\validate;

use think\Validate;

class User extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名'	=>	['规则1','规则2'...]
     *
     * @var array
     */	
	protected $rule = [
        'name' => 'require|max:20',
        'age' => 'require|max:3',
        'content' => 'require|max:100'
    ];
    
    /**
     * 定义错误信息
     * 格式：'字段名.规则名'	=>	'错误信息'
     *
     * @var array
     */	
    protected $message = [
        'name.require' => '姓名不能为空',
        'name.max' => '姓名最大值为20',
        'age.require' => '年龄不能为空',
        'age.max' => '年龄最小值为3',
        'content.require' => '内容不能为空',
        'content.max' => '内容最大值为100'
    ];
}
