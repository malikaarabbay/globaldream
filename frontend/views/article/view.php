<?php
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;

$this->title = $model->title;


$this->registerMetaTag(['name'=> 'keywords', 'content' =>  $model->meta_keywords]);
$this->registerMetaTag(['name'=> 'description', 'content' => $model->meta_description]);

?>
<div class="news-section">
    <div class="news-section__inner">
        <div class="h-heading h-heading--black">
            <h6><?= $model->title?></h6>
        </div>
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
                    <h1 class="description__heading description__heading--about">
                        Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру
                    </h1>
                    <?= $model->description?>
                </div>
            </div>
        </div>
    </div>
</div>