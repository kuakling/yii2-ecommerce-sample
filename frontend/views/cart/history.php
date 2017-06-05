<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Cart;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CartSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Carts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'user_id',
            'address',
            'created_at:datetime',
            // 'updated_at',
            [
                'attribute' => 'status',
                'value' => 'statusText',
                'filter' => Cart::getStatuses(),
            ],
            'comment',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return \yii\helpers\Url::to(['history-view', 'id' => $model->id]);
                    }
                }
            ],
        ],
    ]); ?>
</div>