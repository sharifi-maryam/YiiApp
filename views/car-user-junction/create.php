<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CarUserJunction $model */

$this->title = 'Create new';
$this->params['breadcrumbs'][] = ['label' => 'Car User Junctions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-user-junction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::activeDropDownList($model, 'car_id', $items) ?>
    <br>
    <br>
    <?= Html::activeDropDownList($model, 'user_id', $users) ?>



    <!-- <?= $this->render('_form', [
                'model' => $model,
            ]) ?> -->

</div>