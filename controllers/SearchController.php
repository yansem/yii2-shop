<?php

namespace app\controllers;

use app\models\Product;
use yii\data\Pagination;

class SearchController extends AppController
{
    public function actionView()
    {
        $q = trim(\Yii::$app->request->get('q'));
        if(!$q){
            return $this->render('view');
        }

        $query = Product::find()->where(['like', 'title', $q]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 2, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        $this->setMeta("Поиск: '$q' :: " . \Yii::$app->name);

        return $this->render('view', compact('products', 'pages', 'q'));
    }
}