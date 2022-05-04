<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\Supplier;

/* @var $this yii\web\View */
/* @var $model app\models\SupplierSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="supplier-search">

    <?php $form = ActiveForm::begin([
        'action'  => ['index'],
        'method'  => 'get',
        'options' => [
            'data'  => ['pjax' => true],
            'class' => 'form-inline pull-right'
        ],
    ]); ?>

    <?= $form->field($model, 'id')
        ->label('id：')
        ->textInput(['style' => 'width:200px;margin-right:20px'])
    ?>

    <?= $form->field($model, 'name')->label('name：')
        ->textInput(['style' => 'width:200px;margin-right:20px'])
    ?>

    <?= $form->field($model, 'code')->label('code：')
        ->textInput(['style' => 'width:200px;margin-right:20px'])
    ?>

    <?= $form->field($model, 't_status')
        ->label('t_status：')
        ->dropdownList(Supplier::dropDown("t_status"))
    ?>

    <div class="form-group" style="margin: 10px">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary', 'style' => 'margin-right:20px']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary', 'style' => 'margin-right:20px']) ?>
        <?= Html::a("Export", "javascript:ep();", ["class" => "btn btn-success"]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<script>
    function myConfirm(msg) {
        var allLength = $("input[name='selection[]']").length;
        var selectedLength = $('#grid').yiiGridView('getSelectedRows').length;
        if (msg && allLength === selectedLength) {
            return confirm(msg);
        }
        return true;
    }

    function ep() {
        if (!myConfirm('当前已选择全部行，是否继续？')) {
            return false;
        }
        var keys = $('#grid').yiiGridView('getSelectedRows', {"name": "selection[]"});
        window.open('export?selected_ids=' + keys.join(","), '_self');
    }
</script>