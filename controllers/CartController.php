<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Product;

class CartController extends AppController
{
    public function actionAdd($id)
    {
        $product = Product::findOne($id);
        if(!$product){
            return false;
        }

        $session = \Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->addToCart($product);

        if(\Yii::$app->request->isAjax){
            return $this->renderPartial('cart-modal', compact('session'));
        }

        return $this->redirect(\Yii::$app->request->referrer);

    }

    public function actionShow()
    {
        $session = \Yii::$app->session;
        $session->open();

        if(\Yii::$app->request->isAjax){
            return $this->renderPartial('cart-modal', compact('session'));
        }

        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionDelItem($id)
    {
        $session = \Yii::$app->session;
        $session->open();

        $cart = new Cart();
        $cart->delItem($id);

        if(\Yii::$app->request->isAjax){
            return $this->renderPartial('cart-modal', compact('session'));
        }

        return $this->redirect(\Yii::$app->request->referrer);

    }
}