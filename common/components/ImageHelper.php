<?php 

namespace common\components;

use Yii;
use yii\base\Object;
use yii\imagine\Image;
use yii\helpers\FileHelper;

class ImageHelper extends Object
{
    const DEFAULT_WIDTH = 10240;
    const DEFAULT_HEIGHT = 10240;

	public function thumbnail($imgPath, $width, $height)
	{
		$info = pathinfo($imgPath);
		$oldFilename = $info['filename'];
        if (Utils::chinese($info['filename'])) {
            $info['filename'] = iconv('UTF-8', 'GBK', $info['filename']);
        }

        $dirname = $info['dirname'] . '/thumb/';
        if (!is_dir($dirname)) {
        	FileHelper::createDirectory($dirname);
        }
        $filename = $info['filename'] . '-thumb' . '.' . $info['extension'];
		$cropPath = $dirname . '/' . $filename;
		if ($width && !$height) {
			$height = self::DEFAULT_HEIGHT;
		}

		if ($height && !$width) {
			$width = self::DEFAULT_WIDTH;
		}
		
		Image::thumbnail($imgPath, $width, $height)->save($cropPath);
		
		return mb_convert_encoding(str_replace($oldFilename. '.' . $info['extension'], '', str_replace(yii::getAlias('@backend/web/'), '', $imgPath)) . 'thumb/' . $filename, 'UTF-8', 'GBK');
	}

	public function crop($path, $width, $height, array $start = [0, 0])
	{
		// Image::crop($path, $width, $height, $start)->save($cropPath);
	}
}