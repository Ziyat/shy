<?php

use backend\models\Pages;

//echo $menu_style;
?>
<!-- TOP AREA
================================================== -->
<section class="toparea">
   <div class="container">
      <div class="row">
         <div class="col-md-6 top-text pull-left animated fadeInLeft">
            <i class="icon-phone"></i> Phone: (99899) 855 9989 <span class="separator"></span><i class="icon-envelope"></i> Email: <a href="#">rtsgroup@gmail.com</a>
         </div>
         <div class="col-md-6 text-right animated fadeInRight">
            <div class="social-icons">
               <a class="icon icon-facebook" href="#"></a>
               <a class="icon icon-twitter" href="#"></a>
               <a class="icon icon-linkedin" href="#"></a>
               <a class="icon icon-skype" href="#"></a>
               <a class="icon icon-google-plus" href="#"></a>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- /.toparea end-->

<!-- NAV
================================================== -->
<nav class="navbar navbar-fixed-top wowmenu" role="navigation">
   <div class="container">

      <div class="navbar-header">
         <a class="navbar-brand logo-nav" href="index.html"><img src="img/logo.png" alt="logo"></a>
      </div>

      <!--      <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
               </button>
               <a class="navbar-brand" href="/"><img src="/logo/logo4.png" alt="logo"></a>
            </div>-->



      <ul id="nav" class="nav navbar-nav pull-right">
         <li class="active"><a href="index.html">Home</a></li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <i class="icon-angle-down"></i></a>
            <ul class="dropdown-menu">
               <li><a href="home2.html">Home Alt</a></li>
            </ul>
         </li>
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Features <i class="icon-angle-down"></i></a>
            <ul class="dropdown-menu">
               <li><a href="#">Masonry Grids +</a>
                  <ul class="dropdown-menu sub-menu">
                     <li><a href="masonry4.html">Masonry Four</a></li>
                  </ul>
               </li>
            </ul>
         </li>
         <li><a href="contact.html">Contact</a></li>

         <?php
         foreach ($menu as $key => $value) {
             if ($value['type'] != Pages::TYPE_EMPTY) {
                 echo '<li><a href="' . $value['link'] . '">' . $value['title'] . '</a></li>';
             } else {
                 echo '<li class="dropdown">'
                 . '<a href="' . $value['link'] . '" class="dropdown-toggle" data-toggle="dropdown">' . $value['title'] . ' <i class="fa fa-angle-down"></i></a>';
                 if (isset($value['childs']) && $value['childs']) {
                     echo '<ul class="dropdown-menu">';
                     foreach ($value['childs'] as $key => $v) {
                         echo '<li><a href="' . $v['link'] . '">' . $v['title'] . '</a></li>';
                     }
                     echo '</ul>';
                 }
                 echo '</li>';
             }
         }
         ?>
      </ul>

   </div><!--/.container-->
</nav><!--/nav-->