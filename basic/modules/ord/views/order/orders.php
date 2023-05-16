<?php
/** @var array $order */
/** @var array $pages */
/** @var array $models */
/** @var array $findedOrder */
/** @var int $countOrders */

use yii\widgets\LinkPager;

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
  echo $countOrders;
  echo "<br/> <br/>";
  foreach ($models as $model) {
    print_r($model);
  }
  echo "<br/> <br/>";
  ?>
  ?>
  <?= LinkPager::widget([
      'pagination' => $pages,
  ]); ?>
  <?php
  echo "<br/> <br/>";
  var_dump($findedOrder);
  echo "<br/> <br/>";
  ?>
</body>
<html>