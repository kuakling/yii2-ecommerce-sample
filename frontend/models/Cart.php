<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $address
 * @property integer $created_at
 * @property integer $updated_at
 */
class Cart extends \yii\db\ActiveRecord
{
    const STATUS_ORDER = 0;
    const STATUS_ACCEPT = 1;
    const STATUS_SEND = 2;
    const STATUS_FINISH = 3;
    const STATUS_ERROR = 4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                    'createdByAttribute'=>'user_id',
                    'updatedByAttribute' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['user_id', 'created_at', 'updated_at', 'status'], 'integer'],
            [['address', 'comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'address' => 'Address',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'comment' => 'Comment',
        ];
    }
    
    public static function getStatuses()
    {
        return [
            self::STATUS_ORDER => 'สั่งสินค้า',
            self::STATUS_ACCEPT => 'บรรจุสินค้า',
            self::STATUS_SEND => 'ส่งสินค้า',
            self::STATUS_FINISH => 'ลูกค้ารับสินค้าแล้ว',
            self::STATUS_ERROR => 'มีปัญหา'
        ];
    }
    
    public function getStatusText()
    {
        $statuses = self::getStatuses();
        
        if(array_key_exists($this->status, $statuses)){
            return $statuses[$this->status];
        }
        
        return null;
    }
    
    public function getItems()
    {
        return $this->hasMany(CartItems::className(), ['cart_id' => 'id']);
    }
    
    public function getCustomer()
    {
        $userClass = Yii::$app->user->identityClass;
        return $this->hasOne($userClass::className(), ['id' => 'user_id']);
    }
}
