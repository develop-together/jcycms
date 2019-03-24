<?php
	use yii\helpers\Url;
	use yii\widgets\Breadcrumbs;
?>

<?= Breadcrumbs::widget([
	'tag' => 'h1',
	'options' => ['class' => 't_nav'],
	'itemTemplate' => "{link}\n",
	'activeItemTemplate' => "<a href='javascript:;' class='n2'>{link}</a>\n",
    'homeLink' => false,
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ])
?>