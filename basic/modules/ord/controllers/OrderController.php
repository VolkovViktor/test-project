<?php

namespace app\modules\ord\controllers;

use app\modules\ord\models\Order;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionOrders($filterParamName = '', $filterParamValue = '', $findParamName = 'id', $findParamValue = '') {
        $order = Order::getAllOrders($filterParamName = 'mode', $filterParamValue = '1');
        $findedOrder = Order::findOrder($findParamName, $findParamValue);
        $countOrders = count($order); // for filter by service_id
        return $this->render('orders', compact('order', 'findedOrder', 'countOrders'));
    }
}