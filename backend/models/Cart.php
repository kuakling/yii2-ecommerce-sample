<?php

namespace backend\models;

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
class Cart extends \frontend\models\Cart
{
    
}
