<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
$len = mb_strlen($name);
?>

<div class="container">

    <div class="row">
        <div class="col-lg-12 margin-top-15">
            <div class="errorContainer">
              <div class="errorBackground">
                <div class="errorTop topGray"></div>
                <div class="errorTop topYellow"></div>
                <div class="errorTop topCyan"></div>
                <div class="errorTop topGreen"></div>
                <div class="errorTop topMagenta"></div>
                <div class="errorTop topRed"></div>
                <div class="errorTop topBlue"></div>
                <div class="errorMid midBlue"></div>
                <div class="errorMid midBlack"></div>
                <div class="errorMid midMagenta"></div>
                <div class="errorMid midBlack"></div>
                <div class="errorMid midCyan"></div>
                <div class="errorMid midBlack"></div>
                <div class="errorMid midGray"></div>
                <div class="errorBtm btmNavy"></div>
                <div class="errorBtm btmWhite"></div>
                <div class="errorBtm btmPurple"></div>
                <div class="errorBtm btmBlack1"></div>
                <div class="errorBtm btmBlack1"></div>
                <div class="errorBtm btmBlack"></div>
              </div>
              <div class="errorForeground">
                <div class="errorMessage1">
                  <div class="errorMessage1Text">404</div>
                  <div class="errorMessage1Support"></div>
                </div>
                <h2><?= nl2br(Html::encode($message)) ?></h2>
              </div>
            </div>
        </div>
    </div>
</div>

<form>
    <input type="hidden" name="http_referrer" value="<?= $_SERVER['HTTP_REFERER']; ?>">
    <input type="hidden" name="error_code" value="<?= $exception->statusCode; ?>>
    <input type="hidden" name="error_message" value="<?= $message ?>">
    <input type="hidden" name="user_id">
</form>

<script>

    $(document).ready(function () {

    });
</script>
