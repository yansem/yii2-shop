<?php

namespace app\controllers;

use app\models\Cart;
use app\models\Order;
use app\models\OrderProduct;
use app\models\Product;

class CartController extends AppController
{
    public function actionChange($id, $qty)
    {
        $product = Product::findOne($id);
        if(!$product){
            return false;
        }
        $session = \Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        return true;
    }

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

        return $this->renderPartial('cart-modal', compact('session'));
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

    public function actionClear()
    {
        $session = \Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');

        return $this->renderPartial('cart-modal', compact('session'));
    }

    public function  actionCheckout()
    {
        $session = \Yii::$app->session;

        $order = new Order();
        $order_product = new OrderProduct();

        if($order->load(\Yii::$app->request->post())){
            $order->qty = $session['cart.qty'];
            $order->total = $session['cart.sum'];
            $transaction = \Yii::$app->getDb()->beginTransaction();
            if(!$order->save() || !$order_product->saveOrderProduct($order->id, $session->get('cart'))){
                $session->setFlash('error', 'Ошибка оформления заказа');
                $transaction->rollBack();
            }else{
                $session->setFlash('success', 'Ваш заказ принят');
                $transaction->commit();
                $session->remove('cart');
                $session->remove('cart.qty');
                $session->remove('cart.sum');
                return $this->refresh();
            }
        }
        $this->setMeta('Оформление заказа' . ' :: ' . \Yii::$app->name);
        return $this->render('checkout', compact('session', 'order', 'order_product'));
    }
}