<?php

namespace app\api\model;

use think\Model;

class api_user extends Model
{
    public function getNameAttr($value)
    {
        return strtolower($value);
    }

    public function getAgeAttr($value)
    {
        $data = [21=>'VIP',18=>'Normal',20=>'Very High'];

        return $data[$value];
    }

    public function getContentAttr($value)
    {
        return htmlspecialchars($value);
    }

    public function setContentAttr($value)
    {
        return strtolower($value);
    }

    public function scopeSearch($query,$age)
    {
        return $query->where('age','>=',$age)
        ->field('name,age,content')
        ->order('id')
        ->select();
    }
}
