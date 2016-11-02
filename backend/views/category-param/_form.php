<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Category;
use yii\helpers\ArrayHelper;
use common\models\Param;

/* @var $this yii\web\View */
/* @var $model common\models\CategoryParam */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-param-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title'),  ['prompt' => '- Без категории -']) ?>
    
    <?= $form->field($model, 'param_id')->dropDownList(ArrayHelper::map(Param::find()->all(), 'id', 'title'),  ['prompt' => '- Без параметра -']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
