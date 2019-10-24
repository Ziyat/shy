<?php

/* @var $this \yii\web\View */

/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/favicons/site.webmanifest">
    <?= Html::csrfMetaTags() ?>
    <title>Shuxrat Yog`dusi | <?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Navbar Menu  ---->
<section id="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="#">
            <img src="/svg/fatam-logo.svg" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#top">Главная <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#cooperation">Сотрудничество</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#organizationGoal">Цель организации</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">О Нас</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Контакты</a>
                </li>
            </ul>
        </div>
    </nav>
</section>
<?= $content ?>
<!-- Footer ------>
<section id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 footer-box">
                <img src="/svg/fatam-logo.svg" alt="">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="col-md-4 footer-box">
                <p id="contact"><b>Свяжитесь с нами</b></p>
                <p><i class="fa fa-map-marker"></i>Уртачирчикский р-н,
                    Ташкентской обл.</p>
                <p><i class="fa fa-phone"></i><a class="text-white" href="tel:+998998915963">+998 (99) 891 5963</a></p>
                <p><i class="fa fa-telegram"></i><a class="text-white" href="https://t.me/+998998915963">info@examle.com</a></p>
            </div>
            <div class="col-md-4 footer-box">
                <p><b>SUBSCRIBE NEWSLETTER</b></p>
                <input type="email"class="form-control" placeholder="Your Email">
                <button type="button"class="btn btn-primary" name="button">Subscribe</button>

                <div id="social">
                    <p>Find Us On Social Media</p>
                    <div class="social-icons">
                        <a href="#" class="svg-icons"><img src="svg/facebook-logo.svg" alt=""></a>
                        <a href="#" class="svg-icons"><img src="svg/instagram_.svg" alt=""></a>
                        <a href="#" class="svg-icons"><img src="svg/twitter-logo.svg" alt=""></a>
                        <a href="#" class="svg-icons"><img src="svg/whatsapp.svg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <p class="copyright">Copyright © 2019. All rights reserved | Created by <a href="https://madetec.uz">Madetec-Solution</a></p>
            </div>
            <div class="col-md-6 text-right">
                <p class="copyright">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Cookie Policy</a>
                    <a href="#">Terms & Conditions</a>
                </p>
            </div>
        </div>
        <br>
    </div>
</section>
<script type="text/javascript" src="/js/smooth-scroll.js"></script>
<script>
    var scroll = new SmoothScroll('a[href*="#"]');
</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
