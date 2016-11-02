<?php
/* @var $this yii\web\View */
$this->title = 'GlobalDream';
use yii\helpers\Html;
use yii\helpers\Url;
use himiklab\thumbnail\EasyThumbnailImage;
use yii\bootstrap\ActiveForm;

?>
<div class="our-production">
    <div class="our-production__inner">
        <div class="h-heading">
            <h6>Наша продукция</h6>
        </div>
        <ul class="production-ul">
            <?php foreach ($categories as $category) { ?>
                <li class="production-list">
                    <div class="production-list__inner" style="background-image: url(<?= $category->image ?>);">
                        <a class="production-link" href="<?= Url::toRoute(['/catalog/view', 'slug' => $category->slug]) ?>">
                            <div class="mini-production">
                                <span class="mini-production__heading" href="<?= Url::toRoute(['/catalog/view', 'slug' => $category->slug]) ?>"><?= $category->title ?></span>
                                <span class="mini-production__text">
<!--                                    Горячие новинки-->
                                </span>
                                <div class="mini-production__more" href="<?= Url::toRoute(['/catalog/view', 'slug' => $category->slug]) ?>">Подробнее</div>
                            </div>
                            <div class="production-hover">
<!--                                <span class="production-hover__heading">-->
<!--                                    Мебель трансформер-->
<!--                                </span>-->
                                <span class="production-hover__under">
<!--                                    Горячие поступления-->
                                </span>
                                <p class="production-hover__des"><?php $anounce = strip_tags($category->description, '<a>'); echo mb_substr($anounce,0, 150, 'UTF-8').' ...'; ?></p>
                            </div>
                        </a>
                    </div>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<?php if($products) { ?>
<div class="hot-orders">
    <div class="hot-orders__inner">
        <div class="h-heading h-heading--black">
            <h6>Горячее предложение</h6>
        </div>
        <div class="hot-carousel">
            <?php foreach ($products as $product) { ?>
            <div class="hot-item">
                <a class="hot-item__figure" href="<?= Url::toRoute(['/product/view', 'slug' => $product->slug]) ?>">
                    <?php
                    echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                        $product->imagePath, 270, 355, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                        [
                            'class' => ''
                        ]
                    );
                    ?>
                    <div class="hot-hover">
                        <span class="hot-hover__text"><?php $anounce = strip_tags($product->announce, '<a>'); echo mb_substr($anounce,0, 70, 'UTF-8').' ...'; ?></span>
                        <div class="hot-hover__more">Подробнее</div>
                    </div>
                </a>
                <div class="hot-des">
                    <a href="<?= Url::toRoute(['/product/view', 'slug' => $product->slug]) ?>" class="hot-des__heading">
                        <?= $product->title ?>
                    </a>
                        <span class="hot-des__id">
                            ID:<?= $product->id ?>
                        </span>
                        <span class="hot-des__price">
                            <?= (number_format($product->new_price,0,' ',' ')) ? number_format($product->new_price,0,' ',' ') : number_format($product->price,0,' ',' ') ?>тг
                        </span>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>
<div class="sales">
    <div class="sales__inner">
        <div class="h-heading h-heading--black">
            <h6>Акции и новости</h6>
        </div>
        <ul class="sales-ul">
            <?php foreach ($newsList as $news) {?>
            <li class="sales-ul__li">
                <div class="sales-item">
                    <figure class="sales-item__figure">
                        <a class="sales-img" href="<?= Url::toRoute(['/news/view', 'slug' => $news->slug]) ?>">
                            <?php
                            echo \himiklab\thumbnail\EasyThumbnailImage::thumbnailImg(
                                $news->imagePath, 170, 140, \himiklab\thumbnail\EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                                [
                                    'class' => ''
                                ]
                            );
                            ?>
                            <span class="sales-img__date"><?= Yii::$app->formatter->asDate($news->created, 'dd') ?><br> <?= Yii::$app->formatter->asDate($news->created, 'php:M') ?></span>
                        </a>
                    </figure>
                    <div class="sales-text">
                        <span class="sales-text__type"><?= ($news->category_id) ? Yii::$app->params['categoryStatus'][$news->category_id] : ''?></span>
                        <a class="sales-text__heading" href="<?= Url::toRoute(['/news/view', 'slug' => $news->slug]) ?>"><?= $news->title ?></a>
                        <p class="sales-text__p"><?php $anounce = strip_tags($news->description, '<a>'); echo mb_substr($anounce,0, 150, 'UTF-8').' ...'; ?></p>
                    </div>
                </div>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="feedback">
    <div class="feedback__inner">
        <div class="h-heading h-heading--black">
            <h6>Отзывы о нас</h6>
        </div>
        <div class="feedback-part">
            <div class="leave-feed">
                <span class="leave-feed__text">Хотите оставить свой отзыв?</span>
                <a href="#inline1" class="fancybox leave-feed__button" type="button">Оставить отзыв</a>
                <div class="popup" id="inline1" style="width:400px;display: none;">
                    <span class="popup__heading">Оставить отзыв</span>
                    <?php $form = ActiveForm::begin(['id' => 'review-form', 'layout' => 'horizontal']); ?>
                    <?= $form->field($model, 'firstname', ['inputOptions' => ['class' => 'popup__input']])->textInput()->input('name', ['placeholder' => 'ФИО'])->label(false); ?>
                    <?= $form->field($model, 'email', ['inputOptions' => ['class' => 'popup__input']])->textInput()->input('name', ['placeholder' => 'Почта'])->label(false); ?>
                    <?= $form->field($model, 'review',['inputOptions' => ['class' => 'contact-form__input contact-form__input--textarea', 'placeholder' => 'Сообщение'],])->textarea(['cols' => 10, 'rows' => 20])->label(false) ?>
                    <?= $form->field($model, 'file',['inputOptions' => ['class' => 'popup__file ']])->fileInput(['multiple' => false])->label(false); ?>
                    <?= Html::submitButton('Отправить', ['class' => 'popup__submit', 'name' => 'review-button']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            <div class="feedback-slider">
                <?php foreach ($reviews as $review) { ?>
                <div class="feedback-row">
                    <div class="feedback-image">
                        <?=
                        EasyThumbnailImage::thumbnailImg(
                            $review->imagePath,
                            180,
                            180,
                            EasyThumbnailImage::THUMBNAIL_OUTBOUND,
                            [
                                'class' => ''
                            ]
                        );
                        ?>
                    </div>
                    <div class="feedback-text">
                        <span class="feedback-text__heading">
                            <?= $review->firstname ?>
                        </span>
                        <p class="feedback-text__p">
                            <?= $review->review ?>
                        </p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>


