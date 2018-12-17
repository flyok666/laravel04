<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{

    //获取该学生所属的学校  一对多（反向） 【多对一】
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
