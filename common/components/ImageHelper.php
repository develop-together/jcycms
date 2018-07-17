<?php 

namespace common\components;

use Yii;
use yii\base\Object;
use yii\imagine\Image;
use yii\helpers\FileHelper;

class ImageHelper extends Object
{
	public function crop($imgPath, $width, $height, array $start = [0, 0])
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
		// Image::crop($imgPath, $width, $height, $start)->save($cropPath);
		Image::thumbnail($imgPath, $width, $height)->save($cropPath);
		
		return mb_convert_encoding(str_replace($oldFilename. '.' . $info['extension'], '', str_replace(yii::getAlias('@backend/web/'), '', $imgPath)) . 'thumb/' . $filename, 'UTF-8', 'GBK');
	}
}