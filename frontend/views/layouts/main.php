<?php

use frontend\assets\AppAsset;
use frontend\widgets\TopNavigation;
use yii\helpers\Html;

AppAsset::register($this);

//$info = \backend\models\Info::findOne(1);
//         <i class="fa fa-phone-square"></i> <?php //= $info->phone 
?><?php //= $info->address
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <title><?= Html::encode($this->title) ?> | RTS Group</title>
      <?php $this->head() ?>
      <?= Html::csrfMetaTags() ?>
      <!-- Style -->
      <link href="/css/bootstrap.css" rel="stylesheet">
      <link href="/css/style.css" rel="stylesheet">
      <!-- Responsive -->
      <link href="/css/responsive.css" rel="stylesheet">
      <!-- Choose Layout -->
      <link href="/css/layout-semiboxed.css" rel="stylesheet">
      <!-- Choose Skin -->
      <link href="/css/skin-red.css" rel="stylesheet">
      <!-- Favicon -->
      <link rel="shortcut icon" href="/img/favicon.ico">
      <!-- IE -->
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
            <script src="js/respond.min.js"></script>	   
          <![endif]-->
      <!--[if lte IE 8]>
          <link href="css/ie8.css" rel="stylesheet">
           <![endif]-->
   </head>

   <body class="off">
      <?php $this->beginBody() ?>
      <!-- /.wrapbox start-->
      <div class="wrapbox">

         <?= TopNavigation::widget() ?>


         <?= $content ?>


         <!-- BEGIN FOOTER
     ================================================== -->
         <section>
            <div class="footer">
               <div class="container animated fadeInUpNow notransition">
                  <div class="row">
                     <div class="col-md-3">
                        <h1 class="footerbrand">Calypso</h1>
                        <p>
                           Introducing a premium HTML5 & CSS3 template for multipurpose use.
                        </p>
                        <p>
                           Three awesome layouts, beautiful modern design, lots of features and skins.
                        </p>
                        <p>
                           Made with &nbsp;<i class="icon-heart"></i>&nbsp; by WowThemes.net.
                        </p>
                     </div>
                     <div class="col-md-3">
                        <h1 class="title"><span class="colortext">F</span>ind <span class="font100">Us</span></h1>
                        <div class="footermap">
                           <p>
                              <strong>Address: </strong> No.42 - 54816 Inc Calypso
                           </p>
                           <p>
                              <strong>Phone: </strong> + 1 (280) 482 9537
                           </p>
                           <p>
                              <strong>Fax: </strong> + 1 (372) 742 9532
                           </p>
                           <p>
                              <strong>Email: </strong> wowthemesnet@gmail.com
                           </p>
                           <ul class="social-icons list-soc">
                              <li><a href="#"><i class="icon-facebook"></i></a></li>
                              <li><a href="#"><i class="icon-twitter"></i></a></li>
                              <li><a href="#"><i class="icon-linkedin"></i></a></li>
                              <li><a href="#"><i class="icon-google-plus"></i></a></li>
                              <li><a href="#"><i class="icon-skype"></i></a></li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <h1 class="title"><span class="colortext">C</span>lients' <span class="font100">Voice</span></h1>
                        <div id="quotes">
                           <div class="textItem">
                              <div class="avatar">
                                 <img src="http://wowthemes.net/demo/biscaya/img/demo/avatar.jpg" alt="avatar">
                              </div>
                              "Before turning to those moral and mental aspects of the matter which present the greatest difficulties, let the inquirer begin by mastering more elementary problems.<span style="font-family:arial;">"</span><br/><b> Jesse T, Los Angeles </b>
                           </div>
                           <div class="textItem">
                              <div class="avatar">
                                 <img src="http://wowthemes.net/demo/biscaya/img/demo/avatar.jpg" alt="avatar">
                              </div>
                              "How often have I said to you that when you have eliminated the impossible, whatever remains, however improbable, must be the truth?<span style="font-family:arial;">"</span><br/><b>Ralph G. Flowers </b>
                           </div>
                        </div>
                        <div class="clearfix">
                        </div>
                     </div>
                     <div class="col-md-3">
                        <h1 class="title"><span class="colortext">Q</span>uick <span class="font100">Message</span></h1>
                        <div class="done">
                           <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">×</button>
                              Your message has been sent. Thank you!
                           </div>
                        </div>
                        <form method="post" action="contact.php" id="contactform">
                           <div class="form">
                              <input class="col-md-6" type="text" name="name" placeholder="Name">
                              <input class="col-md-6" type="text" name="email" placeholder="E-mail">
                              <textarea class="col-md-12" name="comment" rows="4" placeholder="Message"></textarea>
                              <input type="submit" id="submit" class="btn" value="Send">
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <p id="back-top">
               <a href="#top"><span></span></a>
            </p>
            <div class="copyright">
               <div class="container">
                  <div class="row">
                     <div class="col-md-4">
                        <p class="pull-left">
                           <!--&copy; Copyright 2014 WowThemes.net-->
                           <a href="http://sayti.uz" target="_blank">"Effective Technology"</a>
                        </p>
                     </div>
                     <div class="col-md-8">
                        <ul class="footermenu pull-right">
                           <li><a href="#">Home</a></li>
                           <li><a href="#">Work</a></li>
                           <li><a href="#">Pages</a></li>
                           <li><a href="#">Blog</a></li>
                           <li><a href="#">Contact</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- /footer section end-->
      </div>
      <!-- /.wrapbox ends-->
      <!-- SCRIPTS, placed at the end of the document so the pages load faster
      ================================================== -->
      <script src="/js/jquery.js"></script>
      <script src="/js/bootstrap.js"></script>
      <script src="/js/plugins.js"></script>
      <script src="/js/common.js"></script>
      <script>
          /* ---------------------------------------------------------------------- */
          /*	Carousel
           /* ---------------------------------------------------------------------- */
          $(window).load(function () {
             $('#carousel-projects').carouFredSel({
                responsive: true,
                items: {
                   width: 200,
                   height: 295,
                   visible: {
                      min: 1,
                      max: 4
                   }
                },
                width: '200px',
                height: '295px',
                auto: true,
                circular: true,
                infinite: false,
                prev: {
                   button: "#car_prev",
                   key: "left",
                },
                next: {
                   button: "#car_next",
                   key: "right",
                },
                swipe: {
                   onMouse: true,
                   onTouch: true
                },
                scroll: {
                   easing: "",
                   duration: 1200
                }
             });
          });
      </script>
      <script>
          //CALL TESTIMONIAL ROTATOR
          $(function () {
             /*
              - how to call the plugin:
              $( selector ).cbpQTRotator( [options] );
              - options:
              {
              // default transition speed (ms)
              speed : 700,
              // default transition easing
              easing : 'ease',
              // rotator interval (ms)
              interval : 8000
              }
              - destroy:
              $( selector ).cbpQTRotator( 'destroy' );
              */
             $('#cbp-qtrotator').cbpQTRotator();
          });
      </script>
      <script>
          //CALL PRETTY PHOTO
          $(document).ready(function () {
             $("a[data-gal^='prettyPhoto']").prettyPhoto({social_tools: '', animation_speed: 'normal', theme: 'dark_rounded'});
          });
      </script>
      <script>
          //MASONRY
          $(document).ready(function () {
             var $container = $('#content');
             $container.imagesLoaded(function () {
                $container.isotope({
                   filter: '*',
                   animationOptions: {
                      duration: 750,
                      easing: 'linear',
                      queue: false,
                   }
                });
             });
             $('#filter a').click(function (event) {
                $('a.selected').removeClass('selected');
                var $this = $(this);
                $this.addClass('selected');
                var selector = $this.attr('data-filter');
                $container.isotope({
                   filter: selector
                });
                return false;
             });
          });
      </script>
      <script>
          //ROLL ON HOVER
          $(function () {
             $(".roll").css("opacity", "0");
             $(".roll").hover(function () {
                $(this).stop().animate({
                   opacity: .8
                }, "slow");
             },
                     function () {
                        $(this).stop().animate({
                           opacity: 0
                        }, "slow");
                     });
          });
      </script>
      <?php $this->endBody() ?>
   </body></html>
<?php $this->endPage() ?>
