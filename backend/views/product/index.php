<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Product;
use backend\models\ProductCategory;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            // 'category.title',
            [
                'attribute' => 'category_id',
                'value' => 'category.title',
                'filter' => ProductCategory::getCategories(['map'=>true]),
            ],
            // 'detail:ntext',
            [
                'attribute' => 'price',
                'format' => ['currency', 'THB'],
            ],
            'balance',
            [
                'attribute' => 'status',
                'value' => 'statusText',
                'filter' => Product::getStatuses()
            ],
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
