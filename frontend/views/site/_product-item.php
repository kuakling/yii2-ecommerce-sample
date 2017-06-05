<?php
use yii\helpers\Html;
?>
<div class="col-sm-4">
	<div class="product-image-wrapper">
		<div class="single-products">
			<div class="productinfo text-center">
				<img src="/media/images/home/product1.jpg" alt="" />
				<h2><?= Yii::$app->formatter->asCurrency($model->price, 'THB'); ?></h2>
				<p><?= $model->title; ?></p>
				<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
			</div>
			<div class="product-overlay">
				<div class="overlay-content">
				    <img src="/media/images/home/product1.jpg" alt="" />
					<h2><?= Yii::$app->formatter->asCurrency($model->price, 'THB'); ?></h2>
					<p><?= $model->title; ?></p>
					<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
					<?= Html::a('<i class="fa fa-info-circle"></i> Detail', ['product/view', 'id' => $model->id], ['class' => 'btn btn-default add-to-cart']); ?>
				</div>
			</div>
		</div>
		<div class="choose">
			<ul class="nav nav-pills nav-justified">
				<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
				<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
			</ul>
		</div>
	</div>
</div>