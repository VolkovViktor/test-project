<?php

namespace app\modules\ord\controllers;

use app\modules\ord\models\Order;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionOrders($filterParam = '', $paramName = '') {
        $order = Order::getAllOrders($filterParam = 'mode', $paramName = '1');
        return $this->render('orders', compact('order'));
    }
}