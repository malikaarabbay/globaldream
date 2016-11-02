<?php

?>

<div class="slider">
    <?php $i = 0; foreach($sliders as $slider) {?>
    <div class="sl sl--<?=$i;?>">
        <div class="slider__inner">
            <div class="slider-mebel slider-mebel--first" style="background-image: url(<?= $slider->image ?>)"></div>
            <div class="slider__des">
                <div class="logo-slider"></div>
                <div class="slider-text">
                    <h3 class="slider-text__heading"><?= $slider->title ?></h3>
                    <div class="slider-text__p">
                        <?= $slider->description ?>
                    </div>
                    <a class="slider-text__more" href="<?= $slider->link ?>">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
    <?php $i++; } ?>
</div>
