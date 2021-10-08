<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список категорий';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
                <div class="category-index">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            'id',
                            'title',
                            //'parent_id',
                            [
                                    'attribute' => 'parent_id',
                                    'value' => function($data){
                                        return $data->parent->title ?? 'Самостоятельная категория';
                                    }
                            ],


                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>

                </div>
        </div>
    </div>
</div>


