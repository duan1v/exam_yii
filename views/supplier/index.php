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

$this->title                   = '供应商列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    /* 原来的样式好像有问题 */
    .m-pagination {
        position: absolute;
        left: 50%;
        transform: translate(-50%, 0);
        margin-bottom: 20px;
    }

    .m-pagination li {
        border: 1px solid #DDD;
        border-left-width: 0;
        text-align: center;
        padding: 5px 15px;
    }

    .m-pagination li:first-child {
        border-left-width: 1px;
    }
</style>
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
        'pager'        => [
            'options' => [
                'class' => 'pagination m-pagination'
            ],
        ],
        'id'           => 'grid',
        'columns'      => [
            [
                'class'           => 'yii\grid\CheckboxColumn',
                'name'            => 'selection',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                }
            ],
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'code',
            [
                'label'     => '状态',
                "attribute" => "t_status",
                "value"     => function ($model) {
                    return Supplier::dropDown("t_status", $model->t_status);
                },
                "filter"    => Supplier::dropDown("t_status"),
            ],
            [
                'class'      => ActionColumn::class,
                'header'     => '操作',
                'urlCreator' => function ($action, Supplier $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    Pjax::end();
    ?>

    <div style="margin-bottom: 50px"></div>
</div>

