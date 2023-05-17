<?php

namespace app\modules\ord\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class User extends ActiveRecord
{

    public static function tableName()
    {
        return 'users';
    }

    public function getAllUsers()
    {
        $query = new Query;
        $orders = $query->select('*')->from('users')->all();
        return $orders;
    }

}