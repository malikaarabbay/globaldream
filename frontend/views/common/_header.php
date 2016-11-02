<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Url;

?>
<header class="header">
    <div class="header__inner">
        <nav class="menu-nav">
            <ul class="menu">
                <li class="menu__item menu__item--active">
                    <a href="/">
                        Главная
                    </a>
                </li>
                <li class="menu__item">
                    <a href="<?= Url::toRoute(['/article/view', 'slug' => 'o-nas']) ?>">
                        О нас
                    </a>
                </li>
                <li class="menu__item">
                    <a href="<?= Url::toRoute(['/news/']) ?>">
                        Акции и новости
                    </a>
                </li>
                <li class="menu__item">
                    <a href="<?= Url::toRoute(['/catalog/']) ?>">
                        Каталог
                    </a>
                </li>
                <li class="menu__item">
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
