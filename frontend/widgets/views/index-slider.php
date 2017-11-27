<?php

use common\models\Src;
?>

<section id="main-slider" class="no-margin">

    <div class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#main-slider" data-slide-to="0" class="active"></li>
            <li data-target="#main-slider" data-slide-to="1"></li>
            <li data-target="#main-slider" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">


            <?php
            $first = 0;
            foreach ($sliders as $s) {
               $first++;
               ?>
               <div class="item <?= $first == 1 ? 'active' : '' ?>" style="background-image: url(<?= Src::imgSrc($s, 'thumb', 1900, 546) ?>)">
                   <div class="container">
                       <div class="row slide-margin">
                           <div class="col-sm-6">
                               <div class="carousel-content">
                                   <h1 class="animation animated-item-1"><?= $s->h1 ?></h1>
                                   <h2 class="animation animated-item-2"><?= $s->h2 ?></h2>
                                   <a class="btn-slide animation animated-item-3" href="<?= yii\helpers\Url::to(['/site/managers'])?>">Буюртма бериш</a>
                               </div>
                           </div>
                       </div>
                   </div>
               </div><!--/.item-->
            <?php } ?>

        </div><!--/.carousel-inner-->
    </div><!--/.carousel-->
    <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
        <i class="fa fa-chevron-left"></i>
    </a>
    <a class="next hidden-xs" href="#main-slider" data-slide="next">
        <i class="fa fa-chevron-right"></i>
    </a>
</section><!--/#main-slider-->
