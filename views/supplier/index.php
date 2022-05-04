<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\models\Supplier;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '供应商列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Supplier', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    Pjax::begin();
    echo $this->render('_search', ['model' => $searchModel]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'pager' => [],
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'code',
            [
                'label'     => '状态',
                "attribute" => "t_status",
                "value" => function ($model) {
                    return Supplier::dropDown("t_status", $model->t_status);
                },
                "filter" => Supplier::dropDown("t_status"),
            ],
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Supplier $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]);
    Pjax::end();
    ?>


</div>
