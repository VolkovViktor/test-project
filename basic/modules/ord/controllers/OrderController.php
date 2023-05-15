<?php

namespace app\modules\ord\controllers;

use app\modules\ord\models\Order;
use yii\web\Controller;

class OrderController extends Controller
{
    public static $params = ['status' => '1'];
    public function actionOrders($filterParamName = '', $filterParamValue = '', $findParamName = 'id', $findParamValue = '') {

        $order = Order::getAllOrders($filterParamName = 'mode', $filterParamValue = '1', self::$params);
        self::$params = $order[1];
        $order = $order[0];
        $findedOrder = Order::findOrder($findParamName, $findParamValue, self::$params);
        self::$params = $findedOrder[1];
        $findedOrder = $findedOrder[0];
        $countOrders = count($order); // for filter by service_id
        return $this->render('orders', compact('order', 'findedOrder', 'countOrders'));
    }
}