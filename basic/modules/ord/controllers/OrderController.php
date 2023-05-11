<?php

namespace app\modules\ord\controllers;

use yii\web\Controller;

class OrderController extends Controller
{
    public function actionOrders() {
        $model = 0;
        return $this->render('orders');
    }
}