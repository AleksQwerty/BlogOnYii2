<?php

use app\models\Article;
use yii\helpers\Url;

/** @var $sinleArticle Article */
/** @var $article Article */
/** @var $recentPost Article */
/** @var $singlePost Article */
/** @var $category Article */
/** @var $articleListByCategory Article */

?>

<!--main content start-->
<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <article class="post">
                    <div class="post-thumb">
                        <a href="blog.html"><img src="<?=$singleArticle->getImage()?>" alt=""></a>
                    </div>
                    <div class="post-content">
                        <header class="entry-header text-center text-uppercase">
                            <!--Тут выводим название категории-->
                            <h6><a href="<?=Url::toRoute(['/site/category', 'id' => $singleArticle->category_id])?>"><?=$singleArticle->category->title?></a></h6>
                            <!--Тут выводим название статьи-->
                            <h1 class="entry-title"><a href="blog.html"><?=$singleArticle->title?></a></h1>
                        </header>
                        <div class="entry-content">
                            <!--Тут выводим содержимое статьи-->
                            <p><?=$singleArticle->content?></p>
                        </div>
                        <div class="decoration">
                            <a href="#" class="btn btn-default">Decoration</a>
                            <a href="#" class="btn btn-default">Decoration</a>
                                <i class="fa fa-eye text-right"></i>
                                <?= $singleArticle->viewed ?>
                        </div>

                        <div class="social-share">
							<span
                                class="social-share-title pull-left text-capitalize">By Rubel On
                                <?=$singleArticle->prepareDateToFormat($singleArticle->created_at)?>
                            </span>
                            <ul class="text-center pull-right">
                                <li><a class="s-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="s-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="s-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="s-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a class="s-instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </article>
                <div class="top-comment"><!--top comment-->
                    <img src="/public/images/comment.jpg" class="pull-left img-circle" alt="">
                    <h4>Rubel Miah</h4>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                        invidunt ut labore et dolore magna aliquyam erat.</p>
                </div><!--top comment end-->
                <div class="row"><!--blog next previous-->
                    <div class="col-md-6">
                        <div class="single-blog-box">
                            <a href="#">
                                <img src="/public/images/blog-next.jpg" alt="">

                                <div class="overlay">

                                    <div class="promo-text">
                                        <p><i class=" pull-left fa fa-angle-left"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>
                                    </div>
                                </div>


                            </a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-blog-box">
                            <a href="#">
                                <img src="/public/images/blog-next.jpg" alt="">

                                <div class="overlay">
                                    <div class="promo-text">
                                        <p><i class=" pull-right fa fa-angle-right"></i></p>
                                        <h5>Rubel is doing Cherry theme</h5>

                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div><!--blog next previous end-->
                <?php if (count($articleListByCategory) > 1) :?>
                <div class="related-post-carousel"><!--related post carousel-->
                    <div class="related-heading">
                        <h4>You might also like</h4>
                    </div>
                    <div class="items">
                        <?php foreach($articleListByCategory as $article):?>
                        <?php  if($article->id === $singleArticle->id) {continue; }?>
                        <div class="single-item">
                            <a href="<?=Url::toRoute(['/site/view', 'id' => $article->id])?>">
                                <img src="<?=$article->getImage()?>" alt="">

                                <p><?=$article->title?></p>
                            </a>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div><!--related post carousel-->
                <?php endif;?>
                <div class="bottom-comment"><!--bottom comment-->
                    <h4>3 comments</h4>

                    <div class="comment-img">
                        <img class="img-circle" src="/public/images/comment-img.jpg" alt="">
                    </div>

                    <div class="comment-text">
                        <a href="#" class="replay btn pull-right"> Replay</a>
                        <h5>Rubel Miah</h5>

                        <p class="comment-date">
                            December, 02, 2015 at 5:57 PM
                        </p>


                        <p class="para">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            diam nonumy
                            eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
                            voluptua. At vero eos et cusam et justo duo dolores et ea rebum.</p>
                    </div>
                </div>
                <!-- end bottom comment-->


                <div class="leave-comment"><!--leave comment-->
                    <h4>Leave a reply</h4>


                    <form class="form-horizontal contact-form" role="form" method="post" action="#">
                        <div class="form-group">
                            <div class="col-md-6">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Email">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="subject" name="subject"
                                       placeholder="Website url">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">
										<textarea class="form-control" rows="6" name="message"
                                                  placeholder="Write Massage"></textarea>
                            </div>
                        </div>
                        <a href="#" class="btn send-btn">Post Comment</a>
                    </form>
                </div><!--end leave comment-->
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