<?php
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use frontend\widgets\ShareLinks;

/* @var $this yii\web\View */
$this->title = $model->title;

$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/news']];
$this->params['breadcrumbs'][] = $model->title;

$this->registerMetaTag(['name'=> 'keywords', 'content' =>  $model->meta_keywords]);
$this->registerMetaTag(['name'=> 'description', 'content' => $model->meta_description]);

?>
<div class="news-section news-section--top">
    <div class="news-section__inner">
        <div class="content">
            <div class="content__img">
                <?=
                EasyThumbnailImage::thumbnailImg(
                    $model->imagePath,
                    330,
                    370,
                    EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                    [
                        'alt' => $model->title,
                        'class' => ''
                    ]
                );
                ?>
            </div>
            <div class="content__des">
                <div class="description">
                    <h1 class="description__heading">
                        <?= $model->title ?>
                    </h1>
                    <span class="description__date">
                        <?= Yii::$app->formatter->asDate($model->created, 'd MMMM Y') ?>
                    </span>
                    <?= $model->description?>
                </div>
            </div>
        </div>
    </div>
</div>
