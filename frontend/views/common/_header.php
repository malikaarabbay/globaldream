<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;

?>
<header class="header">
    <div class="header__inner">
        <nav class="menu-nav">
            <ul class="menu">
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'site/index') !== false) {echo 'class="menu__item menu__item--active"';} ?> class="menu__item">
                    <a href="<?= Url::toRoute(['/site/index']) ?>">
                        Главная
                    </a>
                </li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'article/view?slug=o-nas') !== false) {echo 'class="menu__item menu__item--active"';} ?> class="menu__item">
                    <a href="<?= Url::toRoute(['/article/view', 'slug' => 'o-nas']) ?>">
                        О нас
                    </a>
                </li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'news') !== false) {echo 'class="menu__item menu__item--active"';} ?> class="menu__item">
                    <a href="<?= Url::toRoute(['/news/']) ?>">
                        Акции и новости
                    </a>
                </li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'catalog') !== false) {echo 'class="menu__item menu__item--active"';} ?> class="menu__item">
                    <a href="<?= Url::toRoute(['/catalog/']) ?>">
                        Каталог
                    </a>
                </li>
                <li <?php if (stripos($_SERVER['REQUEST_URI'],'site/contact') !== false) {echo 'class="menu__item menu__item--active"';} ?> class="menu__item">
                    <a href="<?= Url::toRoute(['/site/contact']) ?>">
                        Контакты
                    </a>
                </li>
            </ul>
        </nav>
        <div class="search">
            <form id="search-form" action="/search/index" method="get" role="form">
                <input type="search" id="search-query" name="Search[query]" class="search-input" placeholder="Поиск ...">
            </form>
        </div>
    </div>
</header>
