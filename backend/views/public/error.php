<?php 

use yii\helpers\Html;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= Yii::$app->name . ' - 出错了'; ?></title>
</head>
<body>
	<h2>错误 <?= $code; ?></h2>
	<div class="error">
	<?= Html::encode($message); ?>
	</div>
</body>
</html>