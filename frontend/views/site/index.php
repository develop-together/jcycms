<?php

    use yii\bootstrap\ActiveForm;
    use yii\helpers\Html;

    $this->title = Yii::t('common', 'Home');

?>
    <div class="row">
        <div class="tm-intro">

            <section id="tm-section-1">                        
                <div class="tm-container text-xs-center tm-section-1-inner">
                    <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-lumino-logo.png" alt="Logo" class="tm-logo">
                    <h1 class="tm-site-name">Lumino</h1>
                    <p class="tm-intro-text">Free Bootstrap 4.0 Website Template</p>
                    <a href="#tm-section-2" class="tm-intro-link">Begin</a>    
                </div>                                               
           </section>

        </div>
    </div>
    <div class="row gray-bg">
        
        <div id="tm-section-2" class="tm-section">
            <div class="tm-container tm-container-wide">
                <div class="tm-news-item">
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-news-item-img-container">
                        <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-600x300-01.jpg" alt="Image" class="img-fluid tm-news-item-img">  
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-news-container">
                        <h2 class="tm-news-title dark-gray-text">Nulla molestie euismod</h2>
                        <p class="tm-news-text">Lumino theme is a Bootstrap 4.0 mobile compatible layout for your website. Check "columns" page for one, two, three columns and tables.</p>
                        <a href="#" class="btn tm-light-blue-bordered-btn tm-news-link">Preview</a>
                    </div>
                </div>

                <div class="tm-news-item">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 flex-order-2 tm-news-item-img-container">
                        <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-600x300-02.jpg" alt="Image" class="img-fluid tm-news-item-img">
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-news-container flex-order-1">
                        <h2 class="tm-news-title dark-gray-text">Nulla molestie euismod</h2>
                        <p class="tm-news-text">You may download, modify and use this template as you wish. Lumino HTML5 template is a fully responsive mobile ready for any kind of website.</p>
                        <a href="#" class="btn tm-light-blue-bordered-btn tm-news-link">Detail</a>
                    </div>
                </div>

                <div class="tm-news-item">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-news-item-img-container">
                        <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-600x300-03.jpg" alt="Image" class="img-fluid tm-news-item-img">
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 tm-news-container">
                        <h2 class="tm-news-title dark-gray-text">Nulla molestie euismod</h2>
                        <p class="tm-news-text">Credit goes to <a rel="nofollow" href="http://unsplash.com" target="_parent">Unsplash</a> for images used in this website template. Nulla sit amet tristique lacus. Etiam blandit ex vitae mauris gravida.</p>
                        <a href="#" class="btn tm-light-blue-bordered-btn tm-news-link">Read</a>
                    </div>
                </div>
            </div>                    
       </div>

    </div> <!-- row -->
    <div class="row">

        <section id="tm-section-3" class="tm-section">
            <div class="tm-container text-xs-center">
                
                <h2 class="blue-text tm-title">Lorem ipsum dolor sit amet</h2>
                <p class="margin-b-5">Etiam at rhoncus nisl. Nunc rutrum ac ante euismod cursus.</p>
                <p>Suspendisse imperdiet feugiat massa nex iaculis.</p>
               
                <div class="tm-img-grid">
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-01.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-01.jpg" alt="Image" class="img-fluid tm-gallery-img"> <!-- 300x200 -->
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-07.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-07.jpg" alt="Image" class="img-fluid tm-gallery-img">  
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-02.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-02.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>                           
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-09.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-09.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-03.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-03.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-08.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-08.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-10.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-10.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-04.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-04.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-05.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-05.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-11.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-11.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-06.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-06.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>
                    </div>
                    <div class="tm-gallery-img-container">
                        <a href="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-12.jpg" class="tm-gallery-img-link">
                            <img src="<?= Yii::$app->request->baseUrl ?>/static/img/tm-450x300-12.jpg" alt="Image" class="img-fluid tm-gallery-img">
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div> <!-- row -->
    <div class="row gray-bg">

        <section id="tm-section-4" class="tm-section">
            <div class="tm-container">

                <h2 class="blue-text tm-title text-xs-center"><?= Yii::t('common', 'About Us') ?></h2>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                    <p><?= $configData['system_notes'] ?></p>
                    <p>
                        <?= Yii::t('common', 'Tel') ?>: <a href="tel:<?= $configData['tel'] ?>"><?= $configData['tel'] ?></a><br>
                        <?= Yii::t('common', 'Email') ?>: <span><?= $configData['email'] ?></span>
                    </p>
                </div>
            </div>                    
        </section>
    </div> <!-- row -->
    <!-- 登录模态框 start -->
    <div class="modal fade " id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myLoginModal">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="control-label">用户名:</label>
                    <input type="text" class="form-control" placeholder="请输入用户名">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="control-label">密码:</label>
                    <input type="password" class="form-control" placeholder="请输入密码">
                  </div>
                  <div class="form-group"> 
                  </div>
                </form>
            </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
              </div>
        </div>
      </div>
    </div>
    <!-- 登录模态框 end -->
    <!-- 注册模态框 start -->
    <div class="modal fade " id="registerModal" tabindex="-1" role="dialog" aria-labelledby="myRegisterModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($signupModel, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($signupModel, 'email') ?>

                <?= $form->field($signupModel, 'password')->passwordInput() ?>
                <?= $form->field($signupModel, 'password_too')->passwordInput() ?>
            </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
              </div>
              <?php ActiveForm::end(); ?>
        </div>
      </div>
    </div>
    <!-- 注册模态框 end -->