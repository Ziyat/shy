<?php
/* @var $this yii\web\View */
$this->title = 'Fatam.uz';
?>

<!--- Banner Hero section ------->
<section class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p class="promo-title"><?= Yii::t('text', 'header_promo-title') ?></p>
                <p class="join-title"><?= Yii::t('text', 'header_join-title') ?></p>
            </div>
            <div class="col-md-6">
                <img src="svg/undraw_email_campaign_qa8y.svg" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <!--- Background wave Hero ---->
    <img src="images/ground@-min.png" class="bottom-img" alt="">
</section>

<section>
    <div class="container text-center">
        <h3 class="title text-center"><?= Yii::t('text', 'section_1_hello') ?>!!!</h3>
        <div class="row text-center">
            <div class="col-md-12 services">
                <h4><?= Yii::t('text', 'section_1_question') ?></h4>
                <h5><?= Yii::t('text', 'section_1_answer') ?></h5>
            </div>
            <div class="col-md-12">
                <p><?= Yii::t('text', 'section_1_text_1') ?></p>
                <p><?= Yii::t('text', 'section_1_text_2') ?></p>
            </div>
        </div>
    </div>
</section>

<section id="cooperation">
    <div class="container">
        <h3 class="title text-center"><?= Yii::t('nav', 'cooperation') ?></h3>
        <div class="row">
            <div class="col-md-6 about">
                <p class="about-title">
                    <?= Yii::t('text','section_2_title') ?>
                </p>
                <p>
                    <?= Yii::t('text','section_2_text_1') ?>
                </p>
                <?= Yii::t('text','section_2_ul') ?>
                <?= Yii::t('text','section_2_text_2') ?>

                <hr>
                <mark><b><?= Yii::t('text','section_2_mark') ?></b></mark>
            </div>
            <div class="col-md-6">
                <img src="svg/undraw_mobile_marketing_iqbr.svg" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>


<section id="organizationGoal">
    <div class="container">
        <h3 class="title text-center"><?= Yii::t('nav', 'organizationGoal') ?></h3>
        <div class="row">
            <div class="col-md-6">
                <img src="svg/undraw_wallet_aym5.svg" class="img-fluid" alt="">
            </div>
            <div class="col-md-6 text-right">
                <p class="about-title">
                    <?= Yii::t('text','section_3_text_1') ?>
                    <?= Yii::t('text','section_3_ul') ?>
                </p>
                <hr>
            </div>
        </div>
    </div>
</section>
<section id="about">
    <div class="container">
        <h3 class="title text-center"><?= Yii::t('nav', 'about') ?></h3>
        <div class="row">
            <div class="col-md-6 about">
                <p class="about-title">
                    <?= Yii::t('text', 'about_title') ?>
                </p>
                <p>
                    <?= Yii::t('text', 'about_text') ?>
                </p>
            </div>
            <div class="col-md-6">
                <img src="svg/undraw_wireframing_nxyi.svg" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>

