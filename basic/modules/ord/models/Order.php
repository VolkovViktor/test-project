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

    public function getAllOrders($params)
    {
        $query = new Query;
        $orders = $query->select('*')->from('orders')->where($params)->orderBy('id DESC');
        return $orders;
    }

    public function findOrder($findParamName, $findParamValue, $status)
    {
        $query = new Query;
        $order = $query->select('*')->from('orders')->where($status)->andWhere(["$findParamName" => "$findParamValue"])->orderBy('id DESC')->all();
        return $order;
    }


}