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
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;

echo "<br/> <br/>";
echo $countOrders;
echo "<br/> <br/>";

$form = ActiveForm::begin(['method'=>'get', 'action' => 'index.php?r=ord/order/orders']);
$items = [
    '0' => 'Order ID',
    '1' => 'Link',
    '2'=>'Username'
];
$params = [
    'prompt' => 'Order ID'
];
echo Html::submitButton('Orders');
echo "<br/> <br/>";
echo $form->field($searchModel, 'id')->textInput(['placeholder' => "Search orders"])->label('');
echo $form->field($searchModel, 'id')->dropDownList($items,$params)->label('');
echo Html::submitButton('Search');
echo "<br/> <br/>";
echo Html::submitButton('All orders');
echo Html::submitButton('Pending', ['name' => 'status', 'value' => 'pending']);
echo Html::submitButton('In progress');
echo Html::submitButton('Completed');
echo Html::submitButton('Canceled');
echo Html::submitButton('Error');


echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    //'filterUrl' => ['YOUR_CONTROLLER_ACTIONID_HERE','id' => 1],

    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        [
            'header' => 'Id',
            'attribute' => 'id',
        ],

        [
            'header' => 'User',
            'attribute' => 'user.last_name',
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
            'header' => '.',
            'attribute' => 'service_id',
            'value' => function ($data) use ($countServices) {
                    return $countServices[$data['service_id']-1]['count'];
            },
        ],

        [
            'header' => 'Service',
            'attribute' => 'service.name',
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
            'format' => 'raw',
            'content'=>function($data){
                return $data['mode'] == 0 ? "Manual" : "Auto";
            }
        ],

        [
            'header' => 'Created',
            'attribute' => 'created_at',
            'format' => ['date', 'php: d.m.Y <\b\\r> H:i:s']
        ],
        //['class' => 'yii\grid\ActionColumn'],
    ],
]);
ActiveForm::end();
?>
