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

use app\modules\ord\assets\OrdAssets;
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

$bundle = OrdAssets::register($this);

echo "<br/> <br/>";
echo $countOrders;
echo "<br/> <br/>";

?>

<?php
$form1 = ActiveForm::begin(['method' => 'get', 'id' => 'form1', 'action' => 'index.php?r=ord/order/search']);
echo Html::input('text', 'search_text');
echo Html::dropDownList('search_attr', 'user_id', ['id', 'user_id', 'link']);
echo Html::submitButton('Search');
ActiveForm::end();

$form2 = ActiveForm::begin(['method' => 'get', 'id' => 'form2', 'action' => 'index.php?r=ord/order/orders']);
echo "<br/> <br/>";
echo Html::a('All orders', 'index.php?r=ord/order/orders');
//echo Html::a('Pending', 'index.php?r=ord%2Forder%2Forders&status=pending&SearchOrder%5Bmode%5D=');
echo Html::submitButton('Pending', ['name' => 'status', 'value' => 'pending']);
echo Html::submitButton('In progress', ['name' => 'status', 'value' => 'in progress']);
echo Html::submitButton('Completed', ['name' => 'status', 'value' => 'completed']);
echo Html::submitButton('Canceled', ['name' => 'status', 'value' => 'canceled']);
echo Html::submitButton('Error', ['name' => 'status', 'value' => 'error']);
echo Html::submitButton('Update', ['name' => 'update', 'value' => 'tr']);

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
            'filter' => [$countServices],
            'filterInputOptions' => ['prompt' => $countOrders . 'All'],
            'value' => function ($data) use ($countServices) {
                return $countServices[$data['service_id'] - 1]['count'];
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
            'value' => function ($data) {
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
