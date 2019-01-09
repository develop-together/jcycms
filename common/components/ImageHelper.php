<?php 

namespace common\components;

use Yii;
use yii\base\Object;
use yii\imagine\Image;
use yii\helpers\FileHelper;

class ImageHelper extends Object
{
    const DEFAULT_WIDTH = 100;
    const DEFAULT_HEIGHT = 100;

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

		Image::text(Image::thumbnail($imgPath, $width, $height), 'JCYCMS', '@fontFile/FZSTK.TTF', [0, 0], ['color' => '#f69'])->save($cropPath);
		return mb_convert_encoding(str_replace($oldFilename . '.' . $info['extension'], '', Utils::getRelativePath($imgPath)) . 'thumb/' . $filename, 'UTF-8', 'GBK');
	}

	public function crop($path, $width, $height, array $start = [0, 0])
	{
		// Image::crop($path, $width, $height, $start)->save($cropPath);
	}
}