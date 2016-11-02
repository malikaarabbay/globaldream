<?php
use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Url;
$new_price = number_format($model->new_price,0,' ',' ');
$price = number_format($model->price,0,' ',' ');
?>
<li class="filter-carousel__li">
    <div class="f-furniture">
        <?=
        EasyThumbnailImage::thumbnailImg(
            $model->imagePath,
            275,
            375,
            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
            [
                'alt' => '',
                'class' => ''
            ]
        );
        ?>
        <div class="furniture-des">
            <a class="furniture-des__heading" href="<?= Url::toRoute(['/product/view', 'slug' => $model->slug]) ?>">
                <?= $model->title ?>
            </a>
            <span class="furniture-des__id">ID:<?= $model->id ?></span>
            <span class="furniture-des__price"><?= ($new_price) ? $new_price : $price ?>тг</span>
            <a class="furniture-des__more" href="<?= Url::toRoute(['/product/view', 'slug' => $model->slug]) ?>">Подробнее</a>
        </div>
    </div>
</li>



