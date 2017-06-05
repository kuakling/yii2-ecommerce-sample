<?php
use yii\helpers\Html;
use frontend\models\Product;
?>
<?php if($carts){ ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Product</th>
            <th>Price/pice</th>
            <th>Amount</th>
            <th>Price</th>
            <th>Del</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $price_total = 0;
        $num = 1;
        ?>
        <?php foreach($carts as $id => $cart) : ?>
        <?php
        $product = Product::findOne($id);
        $price = $product->price * $cart['amount'];
        $price_total += $price;
        ?>
        <tr>
            <td><?= $num++; ?></td>
            <td><?= $product->title; ?></td>
            <td class="text-right"><?= Yii::$app->formatter->asCurrency($product->price, 'THB'); ?></td>
            <td class="text-right"><?= $cart['amount']; ?></td>
            <td class="text-right"><?= Yii::$app->formatter->asCurrency($price, 'THB'); ?></td>
            <td><?= Html::a('x', ['delete', 'id' =>$id], ['class' => 'btn btn-danger btn-xs']); ?></td>
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
            <td>&nbsp</td>
        </tr>
    </tfoot>
</table>
<div>
<?= Html::a('<i class="fa fa-trash"></i> Clear Cart', ['clear'], ['class' => 'btn btn-danger pull-left']); ?>
<?= Html::a('<i class="fa fa-check"></i> Checkout', ['checkout'], ['class' => 'btn btn-success pull-right']); ?> 
<?= Html::a('<i class="fa fa-home"></i> Home', ['site/index'], ['class' => 'btn btn-info pull-right']); ?>
</div>
<?php } else{ ?>
<div class="text-danger text-center">
    <i class="fa fa-shopping-cart fa-5" aria-hidden="true"></i>
    <h1>YOUR SHOPPING CART IS EMPTY</h1>
</div>
<?php } ?>