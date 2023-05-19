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
        $attr = Yii::$app->request->get();
        $arr = [0 => 'id', 1 => 'user_id', 2 => 'link'];
        //var_dump($attr['search_text']);
        $query = SearchOrder::find()->where(['like', $arr[$attr['search_attr']], $attr['search_text']]);
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