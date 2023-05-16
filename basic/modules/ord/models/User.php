<?php

namespace app\modules\ord\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class User extends ActiveRecord {

    public static function tableName()
    {
        return 'users';
    }

}