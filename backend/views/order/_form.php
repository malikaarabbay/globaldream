<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use himiklab\thumbnail\EasyThumbnailImage;
/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-12 col-md-8">
            <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'admin_comment')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="product-title">Продукт: <?= $model->product->title ?></div>
            <div class="product-category">Категория: <?= $model->product->category->title ?></div>
            <div class="product-image">
                <img width="300" src="<?= Yii::getAlias('@frontendWebroot/images').'/'.$model->product->photo?>" alt="">
            </div>
            <div class="product-price">Старая цена: <?= number_format($model->product->price,0,' ',' ') ?> тг</div>
            <div class="product-new-price">Новая цена: <?= number_format($model->product->new_price,0,' ',' ') ?> тг</div>

        </div>
    </div>

</div>

<style>
    .product-title, .product-category, .product-image, .product-price, .product-new-price{
        padding: 7px 0;
        color: #085988;
    }
</style>
