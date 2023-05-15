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

    public function getAllOrders($params) {
        $query = new Query;
        $orders = $query->select('*')->from('orders')->where($params)->orderBy('id DESC')->limit(100)->all(); // Delete Limit 100 !!!!!!!!!!!!!!!!
        return [$orders, $params];
    }

    public function findOrder($params, $findParamName, $findParamValue) {
        if (array_key_exists('status', $params)) { // Clear filters
            $params = ['status' => $params['status']];
        } else {
            $params = [];
        }
        $query = new Query;
        $findParamValue = '%' . $findParamValue . '%';
        $order = $query->select('*')->from('orders')->where($params)->andWhere(['like', $findParamName, "%$findParamValue%", false])->orderBy('id DESC')->limit(100)->all(); // Delete Limit 100 !!!!!!!!!!!!!!!!
        return [$order, $params];
    }


}