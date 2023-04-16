<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use app\models\Car;
use yii\web\View;



$this->title = 'Create new';
$this->params['breadcrumbs'][] = ['label' => 'Car User Junctions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="car-user-junction-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php $form = ActiveForm::begin([]); ?>

    <?php

    echo $form->field($model, 'car_id')->widget(Select2::classname(), [
        'id' => 'select_car',
        'language' => 'en',
        'size' => 'l',
        'data' => ArrayHelper::toArray($items),
        'options' => ['placeholder' => 'select car...'],
        'pluginOptions' => [
            'allowClear' => true
        ]
    ]);
    ?>

    <?php
    echo $form->field($model, 'user_id')->widget(Select2::classname(), [
        'id' => 'select_user',
        'language' => 'en',
        'size' => 'l',
        'data' => ArrayHelper::toArray($users),
        'options' => ['placeholder' => 'select user...'],
        'pluginOptions' => [
            'allowClear' => true,
            'disabled' => true
        ],
    ]);
    ?>

    <?php
    ActiveForm::end();
    ?>

    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
</div>






<?php

$this->registerJs(
    <<<JS
    $('#caruserjunction-car_id').on('change', function(e) {
        console.log($('#caruserjunction-car_id').val());
    });
    console.log("salam");    
JS
);

?>