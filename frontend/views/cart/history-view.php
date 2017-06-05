<?php
use yii\helpers\Html;
use frontend\models\Product;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10">
            <h1>INVOICE</h1>
            <h4>มหาวิทยาลัยราชภัฏยะลา</h4>
            <p>133 ถ.เทศบาล3 ต.สะเตง อ.เมือง จ.ยะลา 95000</p>
        </div>
        <div class="col-sm-2">
            <img src="http://eduservice.yru.ac.th/newweb/images/yru-logo.png" class="img-responsive" />
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-12">
            <h3>Customer</h3>
        </div>
        <div class="col-sm-3">
            <label for="">Name: </label> <?= !empty(trim($model->customer->profile->fullname)) ? $model->customer->profile->fullname : $model->customer->username; ?>
        </div>
        <div class="col-sm-5">
            <label for="">Address: </label> <?= $model->address; ?><br />
        </div>
        <div class="col-sm-4">
            <label for="">Date/Time: </label> <?= Yii::$app->formatter->asDateTime($model->created_at); ?>
        </div>
        <div class="col-sm-6">
            <label for="">Status: </label>  <?= $model->statusText; ?>
        </div>
        <div class="col-sm-6">
            <label for="">Comment: </label>  <?= $model->comment; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th class="text-right">Price/pice</th>
                        <th class="text-right">Amount</th>
                        <th class="text-right">Price</th>
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

<div class="text-center">
    <?= Html::a('Back', ['history'], ['class'=>'btn btn-warning']); ?>
</div>