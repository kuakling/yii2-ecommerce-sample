<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cart_items".
 *
 * @property integer $id
 * @property integer $cart_id
 * @property integer $product_id
 * @property integer $amount
 * @property string $price
 */
class CartItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cart_id', 'product_id', 'amount', 'price'], 'required'],
            [['cart_id', 'product_id', 'amount'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cart_id' => 'Cart ID',
            'product_id' => 'Product ID',
            'amount' => 'Amount',
            'price' => 'Price',
        ];
    }
}
