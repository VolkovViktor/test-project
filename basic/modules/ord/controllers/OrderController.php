<?php

namespace app\modules\ord\controllers;

use app\modules\ord\models\Order;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionOrders($filterParamName = '', $filterParamValue = '', $findParamName = 'id', $findParamValue = '', $params = []) { // $params = ['status' => '0'];

        $order = Order::getAllOrders($filterParamName = 'mode', $filterParamValue = '1', $params);
        $params = $order[1];
        $order = $order[0];
        $findedOrder = Order::findOrder($findParamName, $findParamValue, $params);
        $params = $findedOrder[1];
        $findedOrder = $findedOrder[0];
        $countOrders = count($order); // for filter by service_id
        return $this->render('orders', compact('order', 'findedOrder', 'countOrders', 'params'));
    }
}