<?php

namespace app\modules\ord\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }


}