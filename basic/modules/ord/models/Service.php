<?php

namespace app\modules\ord\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Service extends ActiveRecord
{

    public static function tableName()
    {
        return 'services';
    }

    public function getAllServices()
    {
        $query = new Query;
        $services = $query->select('*')->from('services')->all();
        return $services;
    }

}