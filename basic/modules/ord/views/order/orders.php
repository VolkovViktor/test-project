<?php
/** @var array $order */
/** @var array $users */
/** @var array $services */
/** @var array $models */
/** @var array $findedOrder */
/** @var array $dataProvider */
/** @var array $countServices */
/** @var array $searchModel */

/** @var int $countOrders */

use app\modules\ord\models\Order;
use app\modules\ord\models\User;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;

echo "<br/> <br/>";
echo $countOrders;
echo "<br/> <br/>";
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'header' => 'Id',
            'attribute' => 'id',
        ],

        [
            'header' => 'User',
            'attribute' => 'user_id',
            'value' => function ($data) use ($users) {
                return $users[$data['user_id']-1]['last_name'];
            },
        ],

        [
            'header' => 'Link',
            'attribute' => 'link',
        ],

        [
            'header' => 'Quantity',
            'attribute' => 'quantity',
        ],

        [
            'header' => 'Service',
            'attribute' => 'service_id',
            'value' => function ($data) use ($services, $countServices) {
                return $countServices[$data['service_id']-1]['count']." ".$services[$data['service_id']-1]['name'];
            },
        ],

        [
            'header' => 'Status',
            'attribute' => 'user_id',
            'value' => function ($data) {
                $status = $data['status'];
                $arr = array(
                    0 => 'Pending',
                    1 => 'In progress',
                    2 => 'Completed',
                    3 => 'Canceled',
                    4 => 'Error'
                );
                return $arr[$status];
            },
        ],

        [
            'header' => 'Mode',
            'attribute' => 'mode',
            'filter' => [0 => 'Manual', 1 => 'Auto',],
            'filterInputOptions' => ['prompt' => 'All'],
            'value' => function ($data) {
                $mode = $data['mode'];
                $arr = array(
                    0 => 'Manual',
                    1 => 'Auto',
                );
                return $arr[$mode];
            },
        ],

        [
            'header' => 'Created',
            'attribute' => 'created_at',
            'format' => ['date', 'php: d.m.Y <\b\\r> H:i:s']
        ],
        //['class' => 'yii\grid\ActionColumn'],
    ],
]);
?>
