<?php
	use yii\helpers\Html;

	$this->title = $name;
 ?>
<div id="da-wrapper" class="fluid">
<!-- Content -->
	<div id="da-content">
	<!-- Container -->
		<div class="da-container clearfix">
			<div id="da-error-wrapper">
				<div id="da-error-pin"></div>
				<div id="da-error-code">error <span><?= $exception->statusCode ?></span> </div>
				<h1 class="da-error-heading"><?= $this->title ?></h1>
				<p><?= nl2br(Html::encode($message)) ?></p>
			</div>
		</div>
	</div>
</div>