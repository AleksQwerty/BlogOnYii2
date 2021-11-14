<?php

use app\models\Article;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/** @var $articles Article */
/** @var $article Article */
/** @var $popularPost Article */
/** @var $recentPost Article */
/** @var $singlePost Article */
/** @var $category Article */
?>


<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($articles as $article) : ?>
                    <article class="post post-list">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="post-thumb">
                                    <a href="<?=Url::toRoute(['/site/view', 'id' => $article->id])?>"><img src="<?= $article->getImage() ?>" alt="" class="pull-left"></a>

                                    <a href="<?=Url::toRoute(['/site/view', 'id' => $article->id])?>" class="post-thumb-overlay text-center">
                                        <div class="text-uppercase text-center">View Post</div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="post-content">
                                    <header class="entry-header text-uppercase">
                                        <h6><a href="#"><?= $article->category->title ?></a></h6>

                                        <h1 class="entry-title"><a href="blog.html"> <?= $article->title ?></a></h1>
                                    </header>
                                    <div class="entry-content">
                                        <p>
                                            <?php
                                            if (strlen($article->content) > 255) {
                                                ?>
                                                <?php
                                                $url = Url::toRoute(['/site/view', 'id' => $article->id]);
                                                echo mb_strimwidth(
                                                    $article->content,
                                                    0,
                                                    240,
                                                    "<a href=$url>...</a>"
                                                );
                                            } else {
                                                echo $article->content;
                                            } ?>
                                        </p>
                                    </div>
                                    <div class="social-share">
                                        <span class="social-share-title pull-left text-capitalize">By Rubel On <?= $article->prepareDateToFormat(
                                            ) ?></span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

                <?= LinkPager::widget(['pagination' => $pagination]); ?>
            </div>
            <div class="col-md-4" data-sticky_column>
                <div class="primary-sidebar">
                    <!--тут выводятся наиболее популярные 3 поста -->
                    <aside class="widget">
                        <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>
                        <?php foreach ($popularPosts as $singlePost) : ?>
                            <div class="popular-post">

                                <a href="<?=Url::toRoute(['/site/view', 'id' => $singlePost->id])?>" class="popular-img"><img src="<?= $singlePost->getImage() ?>" alt="">

                                    <div class="p-overlay"></div>
                                </a>

                                <div class="p-content">
                                    <a href="<?=Url::toRoute(['/site/view', 'id' => $singlePost->id])?>" class="text-uppercase"><?= $singlePost->title ?></a>
                                    <span class="p-date"><?= $singlePost->prepareDateToFormat() ?></span>
                                    <ul class="text-center pull-right">
                                        <i class="fa fa-eye"></i>
                                        <?= $singlePost->viewed ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </aside>
                    <aside class="widget pos-padding">
                        <!--тут выводятся последние 4 поста -->
                        <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>
                        <?php foreach ($recentPosts as $recentPost) : ?>
                            <div class="thumb-latest-posts">

                                <div class="media">
                                    <div class="media-left">
                                        <a href="<?=Url::toRoute(['/site/view', 'id' => $recentPost->id])?>" class="popular-img"><img src="<?= $recentPost->getImage() ?>" alt="">
                                            <div class="p-overlay"></div>
                                        </a>
                                    </div>
                                    <div class="p-content">
                                        <a href="<?=Url::toRoute(['/site/view', 'id' => $recentPost->id])?>" class="text-uppercase"><?= $recentPost->title ?></a>
                                        <span class="p-date"><?= $recentPost->prepareDateToFormat() ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!--тут выведем все категории с количеством статей по каждой из категорий-->
                    </aside>
                    <aside class="widget border pos-padding">
                        <h3 class="widget-title text-uppercase text-center">Categories</h3>
                        <ul>
                            <?php foreach ($categoryList as $category) : ?>
                                <li>
                                    <a href="<?=Url::toRoute(['/site/category', 'id' =>  $category->id])?>"><?= $category->title ?></a>
                                    <span class="post-count pull-right">(<?= $category->getArticlesCount() ?>)</span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end main content-->