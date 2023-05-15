<?php

namespace app\modules\ord\models;

use yii\db\ActiveRecord;
use yii\db\Query;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return 'orders';
    }

    public function getAllOrders($filterParam, $paramName, $params) {
        $query = new Query;
        if ($filterParam == 'status') {
            $params = ['status' => $paramName];
        }
        else {
            //if (!)
            //$params = ['mode' => $paramName];
            $params[$filterParam] = $paramName;
        }
        //$params = implode(',', $params);
        //$orders = $params;
        $orders = $query->select('*')->from('orders')->where($params)->orderBy('id DESC')->limit(100)->all();
        return $orders;
    }
}