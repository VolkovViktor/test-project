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

    public function getAllOrders($filterParamName, $filterParamValue) {
        $query = new Query;
        if ($filterParamName == 'status') {
            self::$params = ['status' => $filterParamValue];
        }
        else {
            self::$params[$filterParamName] = $filterParamValue;
        }
        // $orders = self::$params; // Debug
        $orders = $query->select('*')->from('orders')->where(self::$params)->orderBy('id DESC')->limit(100)->all(); // Delete Limit 100 !!!!!!!!!!!!!!!!
        return $orders;
    }

    public function findOrder($findParamName, $findParamValue) {
        $query = new Query;
        $findParamValue = '%' . $findParamValue . '%';
        $order = $query->select('*')->from('orders')->where(['like', $findParamName, "%$findParamValue%", false])->orderBy('id DESC')->limit(100)->all(); // Delete Limit 100 !!!!!!!!!!!!!!!!
        return $order;
    }
}