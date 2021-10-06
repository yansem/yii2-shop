<?php

namespace app\models;

use yii\db\ActiveRecord;

class OrderProduct extends ActiveRecord
{
    public static function tableName()
    {
        return 'order_product';
    }

    public function rules()
    {
        return [
            [['order_id', 'product_id', 'title', 'price', 'qty', 'total'], 'required'],
            [['order_id', 'product_id', 'qty'], 'integer'],
            [['price', 'total'], 'number'],
            ['title', 'string', 'max' => 255],
        ];
    }

    public function saveOrderProduct($order_id, $products)
    {
        foreach ($products as $id => $product)
        {
            $this->id = null;
            $this->isNewRecord = true;
            $this->order_id = $order_id;
            $this->product_id = $id;
            $this->title = $product['title'];
            $this->price = $product['price'];
            $this->qty = $product['qty'];
            $this->total = $product['price'] * $product['qty'];
            if(!$this->save()){
                return false;
        }

        }
        return true;
    }
}