<?php

use app\models\CarUserJunction;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;




$this->title = 'Car User Junctions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-user-junction-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create New', ['create'], ['class' => 'btn btn-success']) ?>
    </p>



    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'car_name',
                'value' => function ($junc) {
                    return $junc->car->name ?? '---';
                },
                'label' => 'نام ماشین'
            ],
            [
                'attribute' => 'username',
                'value' => function ($junc) {
                    return $junc->user->username ?? '---';
                },
                'label' => 'نام کاربر'
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CarUserJunction $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>


</div>