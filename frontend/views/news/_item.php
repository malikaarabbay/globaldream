<?php
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;
?>

<li class="news-ul__li">
    <a class="news-img" href="<?= Url::toRoute(['/news/view', 'slug' => $model->slug]) ?>">
        <?=
        EasyThumbnailImage::thumbnailImg(
            $model->imagePath,
            330,
            165,
            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
            [
                'alt' => $model->title,
                'class' => ''
            ]
        );
        ?>
    </a>
    <div class="mini-news">
							<span class="mini-news__type">
								<?= ($model->category_id) ? Yii::$app->params['categoryStatus'][$model->category_id] : ''?>
							</span>
        <a class="mini-news__heading" href="#">
            <?= $model->title ?>
        </a>
        <p class="mini-news__text">
            <?php $anounce = strip_tags($model->description, '<a>'); echo mb_substr($anounce,0, 150, 'UTF-8').' ...'; ?>
        </p>
        <a class="more" href="<?= Url::toRoute(['/news/view', 'slug' => $model->slug]) ?>">
            Подробнее
        </a>
    </div>
</li>
