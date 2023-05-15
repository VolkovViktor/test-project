<?php

namespace app\modules\ord\controllers;

use app\modules\ord\models\Order;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionOrders($params = [], $findParamName = 'id', $findParamValue = '') { // $params = ['status' => '0'];

        $order = Order::getAllOrders($params);
        $findedOrder = Order::findOrder($params, $findParamName, $findParamValue);
        $countOrders = count($order); // for filter by service_id
        return $this->render('orders', compact('order', 'findedOrder', 'countOrders', 'params'));
    }
}