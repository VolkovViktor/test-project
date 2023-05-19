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
        $countServices = Order::getCountServices();
        $searchModel = new SearchOrder();
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $countOrders = Order::getCountOrders(); // for filter by service_id
        return $this->render('orders', compact('dataProvider', 'searchModel', 'countOrders', 'countServices'));
    }


    public function actionSearch()
    {
        $query = SearchOrder::find()->where(['like', 'search_attr', 'search_text']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);
        return $this->render('orders', compact('dataProvider'));
    }


}