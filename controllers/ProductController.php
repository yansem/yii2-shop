<?php

namespace app\controllers;

use app\models\Product;
use yii\web\NotFoundHttpException;

class ProductController extends AppController
{
    public function actionView($id)
    {
        $product = Product::findOne($id);
        if(!$product){
            throw new NotFoundHttpException('Такого продукта нет...');
        }

        $this->setMeta($product->title . ' :: ' . \Yii::$app->name, $product->description, $product->keywords);

        return $this->render('view', compact('product'));
    }
}