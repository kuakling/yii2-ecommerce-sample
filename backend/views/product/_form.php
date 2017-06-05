<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use backend\models\ProductCategory;
use dosamigos\ckeditor\CKEditor;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(ProductCategory::getCategories(['map'=>true])) ?>

    <?= $form->field($model, 'detail')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'balance')->textInput() ?>

    <?= $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'initialPreview'=>$model->getImageInitialPreview(),
            'initialPreviewAsData'=>true,
            'initialPreviewConfig' => $model->getImageInitialConfig(),
            'overwriteInitial'=>false,
            'maxFileSize'=>2800,
            'showUpload' => false,
            // 'maxFileCount' => 1,
            'allowedFileExtensions'=>['jpg'],
        ],
    ]); ?>

    <?= $form->field($model, 'photos[]')->widget(FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
            'multiple' => true
        ],
        'pluginOptions' => [
            'initialPreview'=>$model->getPhotosInitialPreview(),
            'initialPreviewAsData'=>true,
            'initialPreviewConfig' => $model->getPhotosInitialConfig(),
            'overwriteInitial'=>false,
            'maxFileSize'=>2800,
            'showUpload' => false,
            // 'maxFileCount' => 1,
            'allowedFileExtensions'=>['jpg'],
        ],
    ]); ?>

    <?= $form->field($model, 'status')->inline()->radioList($model->getStatuses()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
