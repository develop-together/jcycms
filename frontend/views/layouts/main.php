<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Config;
use common\models\FriendLink;
use yii\helpers\Url;

AppAsset::register($this);
$configData = Config::loadData();
$selfLinks = FriendLink::loadSelfLinks();
$this->title = $configData['system_name'];

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?= $configData['seo_keyword']?>">
    <meta name="description" content="<?= $configData['seo_description']?>">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="top_<?= Yii::$app->controller->_uniqid ?>" class="home">
<?php $this->beginBody() ?>
    <div class="container-fluid">
        <div class="row">          
            <div class="tm-navbar-container bg-inverse">
            <div id="header-container" class=" container">
                <div class="nav-login">
                    <?php if (Yii::$app->user->isGuest): ?>
                        <a href="javascript:;"  title="<?= Yii::t('common', 'Let Me Log In') ?>" id="openid_loginModal">Hi, <?= Yii::t('common', 'Please Log In') ?></a>
                        &nbsp; &nbsp;
                        <a href="javascript:;"  title="<?= Yii::t('common', 'I sign up') ?>" id="openid_regModal"><?= Yii::t('common', 'Register') ?></a> 
                    <?php else: ?>       
                        <span class="h6 text-success">Welcome, <?= Html::encode(yii::$app->user->identity->username) ?></span>
                        <a href="<?= Url::to(['site/logout']) ?>" class="signup-loader"><?= yii::t('frontend', 'Log out') ?></a>                  
                    <?php endif; ?>               
                </div>       
            </div>
            <!-- navbar   -->
            <nav class="navbar navbar-full navbar-fixed-top">

                <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target="#tmNavbar">
                    &#9776;
                </button>
                    
                <div class="collapse navbar-toggleable-sm" id="tmNavbar">                            

                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link external" href="/"><?= Yii::t('common', 'Home') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#top_<?= Yii::$app->controller->_uniqid ?>"><?= Yii::t('frontend', 'Intro') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tm-section-2"><?= Yii::t('frontend', 'Article') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tm-section-3"><?= Yii::t('frontend', 'Gallery') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tm-section-4"><?= Yii::t('frontend', 'Contact us') ?></a>
                        </li>
<!--                         <li class="nav-item">
                            <a class="nav-link external" href="<?= Url::toRoute(['site/columns']) ?>">Columns</a>
                        </li> -->
                    </ul>

                </div>
              
            </nav>

          </div>  

       </div>
        <div class="wrap">
            <?= $content; ?>
        </div>
        <!-- footer -->
        <footer class="tm-footer">                
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <p class="text-xs-center tm-footer-text">
                    <?= $configData['icp']?>&nbsp;Copyright &copy; <?= date('Y') ?> <?= $this->title ?>  
                     <?php if ($selfLinks): ?>
                         <?php foreach ($selfLinks as  $key => $link): ?>
                             <a href="<?= $link['url'] ?>" target="<?= $link['target'] ?>" title="JieChengYang"><?= $link['name'] ?></a>
                             <?= $key == 0 ? ' - Collect from' : ''; ?>
                         <?php endforeach; ?>
                     <?php endif; ?>
                </p>                    
            </div>                
        </footer> 
    </div> <!-- container-fluid -->
<?php $this->endBody() ?>
<?php 
    $jsStr = <<<JS
            $(document).ready(function(){
                var mobileTopOffset = 54;
                var desktopTopOffset = 80;
                var topOffset = desktopTopOffset;
                if($(window).width() <= 767) {
                    topOffset = mobileTopOffset;
                }
                /* Single page nav
                -----------------------------------------*/
                $('#tmNavbar').singlePageNav({
                   'currentClass' : "active",
                    offset : topOffset,
                    'filter': ':not(.external)'
                }); 

                /* Handle nav offset upon window resize
                -----------------------------------------*/
                $(window).resize(function(){
                    if($(window).width() <= 767) {
                        topOffset = mobileTopOffset;
                    } 
                    else {
                        topOffset = desktopTopOffset;
                    }

                    $('#tmNavbar').singlePageNav({
                        'currentClass' : "active",
                        offset : topOffset,
                        'filter': ':not(.external)'
                    });
                });
                

                /* Collapse menu after click 
                -----------------------------------------*/
                $('#tmNavbar a').click(function(){
                    $('#tmNavbar').collapse('hide');
                });

                /* Turn navbar background to solid color starting at section 2
                ---------------------------------------------------------------*/
                var target = $("#tm-section-2").offset().top - topOffset;

                if($(window).scrollTop() >= target) {
                    $(".tm-navbar-container").addClass("bg-inverse");
                }
                else {
                    $(".tm-navbar-container").removeClass("bg-inverse");
                }

                $(window).scroll(function(){
                   
                    if($(this).scrollTop() >= target) {
                        $(".tm-navbar-container").addClass("bg-inverse");
                    }
                    else {
                        $(".tm-navbar-container").removeClass("bg-inverse");
                    }
                });


                /* Smooth Scrolling
                 * https://css-tricks.com/snippets/jquery/smooth-scrolling/
                --------------------------------------------------------------*/
                $('a[href*="#"]:not([href="#"])').click(function() {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
                        && location.hostname == this.hostname) {
                        
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                        
                        if (target.length) {
                            
                            $('html, body').animate({
                                scrollTop: target.offset().top - topOffset
                            }, 1000);
                            return false;
                        }
                    }
                }); 

                /* Magnific pop up
                ------------------------- */
                $('.tm-img-grid').magnificPopup({
                    delegate: 'a', // child items selector, by clicking on it popup will open
                    type: 'image',
                    gallery: {enabled:true}            
                });

                $("#openid_loginModal").bind('click', function() {
                    $("#loginModal").modal('show');
                });  

                $("#openid_regModal").bind('click', function() {
                    $("#registerModal").modal('show');
                });      
            });
JS;
$this->registerJs($jsStr);
 ?>
</body>
</html>
<?php $this->endPage() ?>
