<?php

/* @var $this yii\web\View */

use \yii\helpers\Html;
use \yii\helpers\Url;
use yii\widgets\LinkPager;

$this->title = Yii::$app->name;
?>

<!-- Nav -->
<nav id="menu">
    <ul class="links">
        <li><a href="index.html">Home</a></li>
        <li><a href="elements.html">Elements</a></li>
        <li><a href="generic.html">Generic</a></li>
    </ul>
</nav>

<!-- Banner -->
<section id="banner">
    <div class="inner">
        <h1>Industrious</h1>
        <p>A responsive business oriented template with a video background<br/>
            designed by <a href="https://templated.co/">TEMPLATED</a> and released under the Creative Commons
            License.</p>
    </div>
    <video autoplay loop muted playsinline src="images/banner.mp4"></video>
</section>

<!-- Highlights -->
<section class="wrapper">
    <div class="inner">
        <header class="special">
            <h2>Sem turpis amet semper</h2>
            <p>In arcu accumsan arcu adipiscing accumsan orci ac. Felis id enim aliquet. Accumsan ac integer
                lobortis commodo ornare aliquet accumsan erat tempus amet porttitor.</p>
        </header>
        <div class="highlights">
            <?php
            if (!empty($posts)):
                foreach ($posts as $post): ?>
                    <section>
                        <div class="content">
                            <header>
                                <a href="#" class="icon fa-vcard-o"><span class="label">Icon</span></a>
                                <h2>
                                 ssss   <a href="<?php Url::to(['post/view', 'id' => $post->id]); ?>"><?php echo $post->title; ?>
                                </h2>
                            </header>
                            <p><?php echo $post->excerpt; ?>.</p>title
                            <?php Html::img("@web/{$post->img}") ?>

                            <p>Category -
                                <a href="<?php Url::to(['category/view', 'alias' => $post->category->alias]); ?>">
                                    <?php echo $post->category->title; ?>
                                </a>.
                            </p>
                            <p>Date - <?php echo $post->created_at; ?>.</p>
                            <p>Date - <?php Yii::$app->formatter->asDate($post->created_at, "php:d.m.Y"); ?>.</p>
                            <p>Description - <?php echo $post->description; ?>.</p>
                            <p>Keywords - <?php echo $post->keywords; ?>.</p>
                        </div>
                    </section>
                <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
    <center><?= LinkPager::widget(['pagination' => $pagination]) ?></center>
</section>

<!-- CTA -->
<section id="cta" class="wrapper">
    <div class="inner">
        <h2>Curabitur ullamcorper ultricies</h2>
        <p>Nunc lacinia ante nunc ac lobortis. Interdum adipiscing gravida odio porttitor sem non mi integer non
            faucibus ornare mi ut ante amet placerat aliquet. Volutpat eu sed ante lacinia sapien lorem accumsan
            varius montes viverra nibh in adipiscing. Lorem ipsum dolor vestibulum ante ipsum primis in faucibus
            vestibulum. Blandit adipiscing eu felis iaculis volutpat ac adipiscing sed feugiat eu faucibus. Integer
            ac sed amet praesent. Nunc lacinia ante nunc ac gravida.</p>
    </div>
</section>

<!-- Testimonials -->
<section class="wrapper">
    <div class="inner">
        <header class="special">
            <h2>Faucibus consequat lorem</h2>
            <p>In arcu accumsan arcu adipiscing accumsan orci ac. Felis id enim aliquet. Accumsan ac integer
                lobortis commodo ornare aliquet accumsan erat tempus amet porttitor.</p>
        </header>
        <div class="testimonials">
            <section>
                <div class="content">
                    <blockquote>
                        <p>Nunc lacinia ante nunc ac lobortis ipsum. Interdum adipiscing gravida odio porttitor sem
                            non mi integer non faucibus.</p>
                    </blockquote>
                    <div class="author">
                        <div class="image">
                            <img src="images/pic01.jpg" alt=""/>
                        </div>
                        <p class="credit">- <strong>Jane Doe</strong> <span>CEO - ABC Inc.</span></p>
                    </div>
                </div>
            </section>
            <section>
                <div class="content">
                    <blockquote>
                        <p>Nunc lacinia ante nunc ac lobortis ipsum. Interdum adipiscing gravida odio porttitor sem
                            non mi integer non faucibus.</p>
                    </blockquote>
                    <div class="author">
                        <div class="image">
                            <img src="images/pic03.jpg" alt=""/>
                        </div>
                        <p class="credit">- <strong>John Doe</strong> <span>CEO - ABC Inc.</span></p>
                    </div>
                </div>
            </section>
            <section>
                <div class="content">
                    <blockquote>
                        <p>Nunc lacinia ante nunc ac lobortis ipsum. Interdum adipiscing gravida odio porttitor sem
                            non mi integer non faucibus.</p>
                    </blockquote>
                    <div class="author">
                        <div class="image">
                            <img src="images/pic02.jpg" alt=""/>
                        </div>
                        <p class="credit">- <strong>Janet Smith</strong> <span>CEO - ABC Inc.</span></p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>