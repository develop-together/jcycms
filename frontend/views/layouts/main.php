<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="top_<?= Yii::$app->controller->_uniqid ?>" class="home">
<?php $this->beginBody() ?>
    <div class="container-fluid">
        <div class="row">
          
            <div class="tm-navbar-container bg-inverse">
            
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
                            <a class="nav-link" href="#top_<?= Yii::$app->controller->_uniqid ?>"><?= Yii::t('common', 'Intro') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tm-section-2"><?= Yii::t('common', 'News') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tm-section-3"><?= Yii::t('common', 'Gallery') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#tm-section-4"><?= Yii::t('common', 'Contact') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link external" href="<?= Url::toRoute(['site/columns']) ?>">Columns</a>
                        </li>
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
                <p class="text-xs-center tm-footer-text">Copyright &copy; <?= date('Y') ?> jcycms  <a href="https://www.cnblogs.com/YangJieCheng/
" target="_blank" title="JieChengYang">JieChengYang</a> - Collect from <a href="https://github.com/jiechengyang" title="MyGitHub" target="_blank">MyGitHub</a></p>                    
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
            });
JS;
$this->registerJs($jsStr);
 ?>
</body>
</html>
<?php $this->endPage() ?>
