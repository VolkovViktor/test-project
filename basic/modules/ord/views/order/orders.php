<?php
/** @var array $order */
/** @var array $users */
/** @var array $models */
/** @var array $findedOrder */
/** @var array $dataProvider */

/** @var int $countOrders */

use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\LinkPager;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\widgets\ListView;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
Hi
<?php
echo $users[1]['id'];
echo "<br/> <br/>";
echo $countOrders;
echo "<br/> <br/>";

?>

<?=
GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',

        [
            'header' => 'User',
            'attribute' => 'user_id',
            'value' => function ($data) use ($users) {
                return $users[$data['user_id']-1]['last_name'];
            },
        ],

        'link',

        'quantity',

        [
            'header' => 'Service',
            'attribute' => 'service_id'
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
            'value' => function ($data) {
                $status = $data['mode'];
                $arr = array(
                    0 => 'Manual',
                    1 => 'Auto',
                );
                return $arr[$status];
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

<!--
< ?= ListView::widget([
  'dataProvider' => $dataProvider,
  'viewParams' => [
      'fullView' => true,
      'context' => 'main-page',
  ],
]);
?>
-->
<!--
  < ?= LinkPager::widget([
      'pagination' => $pages,
  ]); ?>
  < ?php
  echo "<br/> <br/>";
  var_dump($findedOrder);
  echo "<br/> <br/>";
  ?>
  -->
<!--
  <div>

      < ?= DetailView::widget([
          'model' => $models,
          'attributes' => [
              'id',
              'user_id' => 'user',
              'link',
              'quantity',
              'service_id' => 'service',
              'status',
              'mode',
              'created_it' => 'created',
          ],
          'options' => [
              'class' => 'nav nav-tabs',
          ],
      ]) ?>

  </div>
-->
</body>
<html>