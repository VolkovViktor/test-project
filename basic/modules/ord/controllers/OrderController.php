<?php

namespace app\modules\ord\controllers;

use app\modules\ord\models\Order;
use app\modules\ord\models\User;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;


class OrderController extends Controller
{
    public function actionOrders()
    {
        $findParamName = 'id';
        $findParamValue = '1';
        $status = [];
        $params = []; // Массив папаметров фильтрации будет формироваться из полей фильтрации (из формы)
        // $params = ['status' => '0']; // Debug
        $order = Order::getAllOrders($params);
        $countOrders = count($order->all()); // for filter by service_id
        $findedOrder = Order::findOrder($findParamName, $findParamValue, $status);
        $users = User::getAllUsers();
        /*
        $pages = new Pagination(['totalCount' => $order->count(), 'pageSize' => 100]);
        $models = $order->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        */

        $dataProvider = new ActiveDataProvider([
            'query' => $order,
            'pagination' => [
                'pageSize' => 100,
            ],
        ]);

        return $this->render('orders', compact('order', 'findedOrder', 'countOrders', 'dataProvider', 'users'));
    }
}