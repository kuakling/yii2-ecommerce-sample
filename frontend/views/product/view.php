<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
		<div class="view-product">
			<img src="<?= $model->getImageViewer() ?>" alt="" />
			<h3>ZOOM</h3>
		</div>
		<div id="similar-product">
			<?php
			// print_r($model->getPhotosInitialPreview());
			foreach ($model->getPhotosInitialPreview() as $photo) {
				echo Html::img($photo, ['style' => 'width: 84px; height: 84px;']);
			}
			?>
		</div>

	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<!--<img src="images/product-details/new.jpg" class="newarrival" alt="" />-->
			<h2><?= $model->title; ?></h2>
			<p>Web ID: <?= $model->id; ?></p>
			<img src="/media/images/product-details/rating.png" alt="" />
			<span>
				<span>THB <?= Yii::$app->formatter->asCurrency($model->price, 'THB'); ?></span>
				<label>Quantity:</label>
				<input type="text" value="1" />
				<?= Html::a('<i class="fa fa-shopping-cart"></i> Add to cart', ['cart/add', 'id' => $model->id], ['class' => 'btn btn-fefault cart']); ?>
			</span>
			<h4>Detail</h4>
			<p>
			    <?= $model->detail; ?>
			</p>
			<p><b>Availability:</b> <?= (intval($model->balance) > 0) ? 'In Stock' : '<span class="text-danger">Out of Order</span>'; ?></p>
			<!--<p><b>Condition:</b> New</p>-->
			<!--<p><b>Brand:</b> E-SHOPPER</p>-->
			<a href=""><img src="/media/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->

