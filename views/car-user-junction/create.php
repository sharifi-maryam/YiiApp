<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;



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
        'language' => 'en',
        'size' => 'l',
        'options' => ['placeholder' => 'select user...'],
        'pluginOptions' => [
            'allowClear' => true,
            'disabled' => true
        ]
    ]);

    echo Html::submitButton('Save', ['class' => 'btn btn-success']);

    ?>

    <?php
    ActiveForm::end();
    ?>


</div>






<?php

$this->registerJs(
    <<<JS
    $('#caruserjunction-car_id').on('change', function(e) {

        var CarID = $('#caruserjunction-car_id').val();

        console.log(CarID);
        if(CarID){
            let data = jQuery.param({
                selectedCarId: CarID
            });

            $.ajax('/car-user-junction/list' ,{
                type:'POST',
                data: data,
                dataType : "json",
                success:function(data){



                    console.log(data);

                    $('#caruserjunction-user_id').empty();
                    $('#caruserjunction-user_id').prop('disabled', false);


                    $.each(data, function(index, value){
                        $('#caruserjunction-user_id').append('<option value="' + index + '">' + value + '</option>');
                    });

                }
            }); 
        }

        else{
            $('#caruserjunction-user_id').html('<option value="">Select</option>'); 
        }


    });
JS
);

?>