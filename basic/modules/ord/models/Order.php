<?php

namespace app\modules\ord\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Order extends ActiveRecord
{
    public static $params = [];
    //public static $params = ['status' => '1']; // Debug
    public static function tableName()
    {
        return 'orders';
    }

    public function getAllOrders($filterParam, $paramName) {
        $query = new Query;
        if ($filterParam == 'status') {
            self::$params = ['status' => $paramName];
        }
        else {
            self::$params[$filterParam] = $paramName;
        }
        // $orders = self::$params; // Debug
        $orders = $query->select('*')->from('orders')->where(self::$params)->orderBy('id DESC')->limit(100)->all();
        return $orders;
    }
}