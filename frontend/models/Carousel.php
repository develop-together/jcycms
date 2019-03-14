<?php

namespace frontend\models;

use common\models\Carousel as CommonCarousel;

class Carousel extends CommonCarousel
{
	public static function getTeamplates()
	{
		$model = self::findOne(['key' => 'templates']);
		if ( $model !== null ) {
			return $model->carouselItems;
		}

		return null;
	}
}