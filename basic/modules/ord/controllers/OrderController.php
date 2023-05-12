<?php

namespace app\modules\ord\controllers;

use app\modules\ord\models\Order;
use yii\web\Controller;

class OrderController extends Controller
{
    public function actionOrders() {
        $order = Order::findOne(1);
        return $this->render('orders', compact('order'));
    }
}