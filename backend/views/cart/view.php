<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Product;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Cart */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Carts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-view">
    
    <div class="row">
        <div class="col-sm-12">
            <h3>Customer</h3>
        </div>
        <div class="col-sm-3">
            <label for="">Name: </label> <?= $model->customer->username; ?>
        </div>
        <div class="col-sm-5">
            <label for="">Address: </label> <?= $model->address; ?><br />
        </div>
        <div class="col-sm-4">
            <label for="">Date/Time: </label> <?= Yii::$app->formatter->asDateTime($model->created_at); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Price/pice</th>
                        <th>Amount</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $price_total = 0;
                    $num = 1;
                    ?>
                    <?php foreach($model->items as $item) : ?>
                    <?php
                    $product = Product::findOne($item->product_id);
                    $price = $product->price * $item->amount;
                    $price_total += $price;
                    ?>
                    <tr>
                        <td><?= $num++; ?></td>
                        <td><?= $product->title; ?></td>
                        <td class="text-right"><?= Yii::$app->formatter->asCurrency($item->price, 'THB'); ?></td>
                        <td class="text-right"><?= $item->amount; ?></td>
                        <td class="text-right"><?= Yii::$app->formatter->asCurrency($price, 'THB'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right text-danger">
                            <strong>
                            <?= Yii::$app->formatter->asCurrency($price_total, 'THB'); ?>
                            </strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'status')->radioList($model->getStatuses(), ['separator' => ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ', 'tabindex' => 3]) ?>
    
    <?= $form->field($model, 'comment')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-warning']); ?>
    </div>

    <?php ActiveForm::end(); ?>