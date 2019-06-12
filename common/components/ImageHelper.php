<?php 

namespace common\components;

use Yii;
use yii\imagine\Image;
use yii\helpers\FileHelper;
use common\models\Config;

class ImageHelper
{
    const DEFAULT_WIDTH = 100;
    const DEFAULT_HEIGHT = 100;
    const DEFAULT_FONT_SIZE = 12;
    const DEFAULT_FONT_COLOR = 'f69';

	public static function thumbnail($imgPath, $width, $height)
	{
		$info = pathinfo($imgPath);
		$oldFilename = $info['filename'];
        // if (Utils::chinese($info['filename'])) {
        //     $info['filename'] = iconv('UTF-8', 'GBK', $info['filename']);
        // }

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

		$img = Image::thumbnail($imgPath, $width, $height);
		$configData = Config::loadData();
		if ($configData['watermark_img']) {
			$img = self::water($img, str_replace("\\", '/', Yii::getAlias('@backend/web/') . $configData['system_logo']), $configData['watermark_style'], [$width, $height, $configData['watermark_location']]);
		}

		$img->save($cropPath);
		return mb_convert_encoding(str_replace($oldFilename . '.' . $info['extension'], '', Utils::getRelativePath($imgPath)) . 'thumb/' . $filename, 'UTF-8', 'GBK');
	}

	/**
     * 水印图片.
     * @param ImageInterface $image 
     * @param string $watermarkImage 水印图片 为null则填充文字
     * @param array $options 源图片宽、高、水印位置(右上角、左上角、右下角、左下角)，字体颜色
     * @return Image
	 */
	private static function water($image, $watermarkImage, $type = 1, $options = [100, 100, 'uLeft'])
	{
		$dWidth = $options[0];
		$dHeight = $options[1];
		$location = $options[2];
		$fontFile = '@fontFile/FZSTK.TTF';
		$fontColor = !empty($options[3]) ? $options[3] : self::DEFAULT_FONT_COLOR;
		$text = Yii::$app->name;
		if ((int)$type === BaseConfig::WATERMARK_STYLE_TEXT) {
			$box = @imageTTFBbox(self::DEFAULT_FONT_SIZE, 0, Yii::getAlias($fontFile), $text);
			$width = abs($box[4] - $box[0]);
			$height = abs($box[5] - $box[1]);
			$start = self::getStart($location, $dWidth, $dHeight, $width, $height);
			return Image::text($image, Yii::$app->name, $fontFile, $start, ['color' => $fontColor]);
		}

		$watermarkImageInfo = self::imgInfo($watermarkImage);
		if (is_bool($watermarkImageInfo) || ($dWidth <= $watermarkImageInfo['width'] || $dHeight <= $watermarkImageInfo['height'])) {
			return $image;
		}

		$start = self::getStart($location, $dWidth, $dHeight, $watermarkImageInfo['width'], $watermarkImageInfo['height']);

		return image::watermark($image, $watermarkImage, $start);

	}

	public static function watermark($imgPath, $watermarkImgPath, $type = 1, $options = [100, 100, 'uLeft'])
	{
		$dirpath = Yii::getAlias('@backend/web/') . $imgPath;
		self::water($dirpath, $watermarkImgPath, $type, $options)->save($dirpath);

		return $imgPath;
	}

	public static function crop($path, $width, $height, array $start = [0, 0])
	{
		// Image::crop($path, $width, $height, $start)->save($cropPath);
	}

	public static function imgInfo($img)
	{
		//判读图片时候存在，不存在
		if (! file_exists($img)) {
			return false;
		}

		$info = getimagesize($img);
		if (! $info) {
			return false;
		}

		$img = [];
		$img['width'] = $info[0];
		$img['height'] = $info[1];
		$img['ext'] = substr($info['mime'], stripos($info['mime'], '/') + 1);

		return $img;
	} 

	private static function getStart(string $location = 'uLeft', $dW, $dH, $w, $h): array
	{
		switch ($location) {
			case BaseConfig::UPPER_LEFT:
				$start = [0, 0];
				break;
			case BaseConfig::LOWER_LEFT:
				$start = [0, $dH - $h];
				break;
			case BaseConfig::LOWER_RIGHT:
				$start = [$dW - $w, $dH - $h];
				break;
			case BaseConfig::UPPER_RIGHT:
				$start = [$dW - $w, 0];
				break;			
			default:
				$start = [0, 0];
				break;
		}

		return $start;
	}
}