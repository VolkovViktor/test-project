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

    public function findOrder($findParamName, $findParamValue, $status)
    {
        $query = new Query;
        $order = $query->select('*')->from('orders')->where($status)->andWhere(["$findParamName" => "$findParamValue"])->orderBy('id DESC')->all();
        return $order;
    }

    public function getCountOrders() {
        $query = new Query;
        $countOrders = $query->select('count(*) as count')->from('orders')->all();
        return $countOrders[0]['count'];
    }
    public function getCountServices() {
        $query = new Query;
        $orderService = $query->select('service_id, count(*) as count')->from('orders')->groupBy('service_id')->all();
        return $orderService;
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    /*
    public function getAllOrders($params)
    {
        $query = new Query;
        $orders = $query->select('*')->from('orders')->where($params)->orderBy('id DESC');
        return $orders;
    }
    */

}