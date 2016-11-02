<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use vova07\fileapi\Widget as FileAPI;
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;
use common\models\Category;
use yii\helpers\ArrayHelper;
use common\models\Param;


/* @var $this yii\web\View */
/* @var $model common\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="<?= ($image_tab) ? '' : 'active'?>">
                <a href="#tab_1" data-toggle="tab">Данные</a>
            </li>
            <li class="<?= ($image_tab) ? 'active' : ''?>">
                <a href="#tab_2" data-toggle="tab">Изображении</a>
            </li>
            <li class="pull-right">
                <?= Html::submitButton($model->isNewRecord ?
                        '<span class="glyphicon glyphicon-ok"></span> '.Yii::t('app', 'Create') :
                        '<span class="glyphicon glyphicon-floppy-disk"></span> '.Yii::t('app', 'Save'),
                    ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </li>
        </ul>
        <div class="tab-content">

            <div class="tab-pane <?= ($image_tab) ? '' : 'active'?>" id="tab_1">

                <div class="row">
                    <div class="col-md-8 col-xs-12">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

                        <?= $form->field($model, 'price')->textInput(['maxlength' => 255]) ?>

                        <?= $form->field($model, 'new_price')->textInput(['maxlength' => 255]) ?>

                        <?= $form->field($model, 'material')->textInput(['maxlength' => 255]) ?>
                        
                        <?= $form->field($model, 'size')->textInput(['maxlength' => 255]) ?>

                        <?= $form->field($model, 'announce')->widget(Widget::className(), [
                            'settings' => [
                                'lang' => 'ru',
                                'minHeight' => 150,
                                'imageUpload' => Url::to(['/site/image-upload']),
                                'imageManagerJson' => Url::to(['/site/images-get']),
                                'plugins' => [
                                    'imagemanager'
                                ]
                            ]
                        ]); ?>

                        <?= $form->field($model, 'description')->widget(Widget::className(), [
                            'settings' => [
                                'lang' => 'ru',
                                'minHeight' => 150,
                                'imageUpload' => Url::to(['/site/image-upload']),
                                'imageManagerJson' => Url::to(['/site/images-get']),
                                'plugins' => [
                                    'imagemanager'
                                ]
                            ]
                        ]); ?>

                        <h3>Параметры</h3>
                        <?php foreach ($params as $param) { ?>
                            <?php if ($param->type_id == Param::TYPE_TEXT) { ?>
                                <?= $form->field($productParamModel[$param->id], '[' . $param->id . ']value')->textInput()->label($param->title) ?>
                            <?php } ?>

                            <?php
                            if ($param->type_id == Param::TYPE_SELECT) {
                                ?>
                                <?= $form->field($productParamModel[$param->id], '[' . $param->id . ']value')->dropDownList(ArrayHelper::map($param->paramValues, 'id', 'value'))->label($param->title) ?>
                            <?php } ?>

                            <?php if ($param->type_id == Param::TYPE_CHECKBOXLIST) { ?>
                                <?= $form->field($productParamModel[$param->id], '[' . $param->id . ']value')->checkboxList(ArrayHelper::map($param->paramValues, 'id', 'value'))->label($param->title) ?>
                            <?php } ?>
                        <?php } ?>

                        <?= $form->field($model, 'is_main')->checkbox() ?>

                        <?= $form->field($model, 'is_published')->checkbox() ?>

                    </div>

                    <div class="col-md-4 col-xs-12">
                        <?= $form->field($model, 'photo')->widget(
                            FileAPI::className(),
                            [
                                'settings' => [
                                    'url' => ['fileapi-upload'],
                                    'elements' => [
                                        'preview' => [
                                            'width' => 250,
                                            'height' => 200
                                        ]
                                    ],
                                ],
                            ])
                        ?>

                        <?= $form->field($model, 'meta_keywords')->textarea(['rows' => 4]) ?>

                        <?= $form->field($model, 'meta_description')->textarea(['rows' => 4]) ?>

                        <?= $form->field($model, 'slug')->textInput(['maxlength' => 255]) ?>

                    </div>
                </div>

            </div><!-- /.tab-pane -->

            <div class="tab-pane <?= ($image_tab) ? 'active' : ''?> " id="tab_2">

                <?= $form->field($model, 'file[]')->fileInput(['multiple' => true]) ?>
                <hr/>

                <div class="row">
                    <?= $this->render('_modelImages',[
                        'images' => $model->images,
                    ]) ?>
                </div>

            </div><!-- /.tab-pane -->
        </div><!-- /.tab-content -->
    </div>

    <?php ActiveForm::end(); ?>

</div>
