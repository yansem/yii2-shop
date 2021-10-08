<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список заказов';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
                <div class="order-index">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'created_at:datetime',
                            'updated_at',
                            'qty',
                            'total',
                            [
                                    'attribute' => 'status',
                                    'value' => function($data){
                                        return $data->status ? '<span class="text-green">Завершен</span>' : '<span class="text-red">Новый</span>';
                                    },
                                    'format' => 'raw',
                            ],
                            //'status',
                            //'name',
                            //'email:email',
                            //'phone',
                            //'address',
                            //'note:ntext',

                            ['class' => 'yii\grid\ActionColumn',
                                'header' => 'Действия'],
                        ],
                    ]); ?>
                </div>
        </div>
    </div>
</div>
