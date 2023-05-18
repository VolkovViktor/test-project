<?php

namespace app\modules\ord\controllers;

use app\modules\ord\models\Order;
use app\modules\ord\models\SearchOrder;
use app\modules\ord\models\Service;
use app\modules\ord\models\User;
use Yii;
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

        $findedOrder = Order::findOrder($findParamName, $findParamValue, $status);
        $users = User::getAllUsers();
        $services = Service::getAllServices();
        $countServices = Order::getCountServices();
        $searchModel = new SearchOrder();
        //var_dump(Yii::$app->request->get()->SearchOrder);
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $countOrders = Order::getCountOrders(); // for filter by service_id


        return $this->render('orders', compact( 'dataProvider', 'searchModel', 'findedOrder', 'countOrders', 'users', 'services', 'countServices'));
    }
}