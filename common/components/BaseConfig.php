<?php

namespace common\components;

use yii;
use yii\base\InvalidParamException;

/**
 * 基础数据配置类
 * @author atuxe <atuxe@boyuntong.com>
 */
class BaseConfig
{
    const YesNo_Yes = 1;
    const YesNo_No = 0;

    const PUBLISH_YES = 1;
    const PUBLISH_NO = 0;

    const Status_Enable = 1;
    const Status_Desable = 0;

    const TARGET_BLANK = '_blank';
    const TARGET_SELF = '_self';

    // const HTTP_METHOD_ALL = 0;
    // const HTTP_METHOD_GET = 1;
    // const HTTP_METHOD_POST = 2;

    const INPUT_INPUT = 1;
    const INPUT_TEXTAREA = 2;
    const INPUT_UEDITOR = 3;

    const ARTICLE_VISIBILITY_PUBLIC = 1;
    const ARTICLE_VISIBILITY_COMMENT = 2;
    const ARTICLE_VISIBILITY_SECRET = 3;

    const LANGUAGE_ZN_CN = 'zh_CN';
    // const LANGUAGE_ZN_TW = 'ZN_TW';
    const LANGUAGE_EN_US = 'en-US';

    const WEB_TEMPLATE_BASE = 'basic';
    const WEB_TEMPLATE_ONE = 'template1';
    const WEB_TEMPLATE_TWO = 'template2';

    const HTTP_METHOD_GET = 'GET';
    const HTTP_METHOD_POST = 'POST';
    const HTTP_METHOD_PUT = 'PUT';
    const HTTP_METHOD_DELETE = 'DELETE';

    const UPPER_LEFT = 'uLeft';
    const UPPER_RIGHT = 'uRight';
    const LOWER_LEFT = 'oLeft';
    const LOWER_RIGHT = 'oRight';

    const WATERMARK_STYLE_TEXT = 1;
    const WATERMARK_STYLE_IMG = 2;

    const ARTICLE_CATALOG_ID = 1;
    const PRODUCT_CATALOG_ID = 2;

    public static function getYesNoItems($key = null)
    {
        $items = [
            self::YesNo_Yes => Yii::t('app', 'Yes'),
            self::YesNo_No => Yii::t('app', 'No'),
        ];
        return self::getItems($items, $key);
    }

    public static function statusOption()
    {
        return ['1' => '激活', '2' => '锁定',];
    }

    public static function getWebsiteStatusItems($key = null)
    {
        $items = [
            self::YesNo_Yes => Yii::t('app', 'Opened'),
            self::YesNo_No => Yii::t('app', 'Closed'),
        ];
        return self::getItems($items, $key);
    }

    public static function getTargetOpenMethod($key = null)
    {
        $items = [
            self::TARGET_BLANK => Yii::t('app', 'Yes'),
            self::TARGET_SELF => Yii::t('app', 'No'),
        ];
        return self::getItems($items, $key);
    }

    // public static function getHttpMethodItems($key = null)
    // {
    //     $items = [
    //         self::HTTP_METHOD_ALL => 'all',
    //         self::HTTP_METHOD_GET => 'get',
    //         self::HTTP_METHOD_POST => 'post',
    //     ];
    //     return self::getItems($items, $key);
    // }

    public static function getArticleStatus($key = null)
    {
        $items = [
            self::PUBLISH_YES => Yii::t('app', 'Publish'),
            self::PUBLISH_NO => Yii::t('app', 'Draft'),
        ];
        return self::getItems($items, $key);
    }

    public static function getInputTypeItems($key = null)
    {
        $items = [
            self::INPUT_INPUT => 'input',
            self::INPUT_TEXTAREA => 'textarea',
            self::INPUT_UEDITOR => 'ueditor',
        ];
        return self::getItems($items, $key);
    }

    public static function getArticleVisibility($key = null)
    {
        $items = [
            self::ARTICLE_VISIBILITY_PUBLIC => Yii::t('app', 'Public'),
            self::ARTICLE_VISIBILITY_COMMENT => Yii::t('app', 'Reply'),
            self::ARTICLE_VISIBILITY_SECRET => Yii::t('app', 'Password'),
        ];
        return self::getItems($items, $key);
    }

    public static function getStatusItems($key = null)
    {
        $items = [
            self::Status_Enable => Yii::t('app', 'Enable'),
            self::Status_Desable => Yii::t('app', 'Disable'),
        ];
        return self::getItems($items, $key);
    }

    public static function getItems($items, $key = null)
    {
        if ($key !== null) {
            if (key_exists($key, $items)) {
                return $items[$key];
            }
            throw new InvalidParamException('Unknown key:' . $key);
        }
        return $items;
    }

    public static function getLanguageItems($key = null)
    {
        $items = [
            self::LANGUAGE_ZN_CN => '简体中文',
            self::LANGUAGE_EN_US => 'English',
        ];

        return self::getItems($items, $key);
    }

    public static function getWebTemplateItems($key = null)
    {
        $items = [
            self::WEB_TEMPLATE_BASE => Yii::t('app', 'Basic blog'),
            self::WEB_TEMPLATE_ONE => Yii::t('app', 'Small fresh topic blog'),
            self::WEB_TEMPLATE_TWO => Yii::t('app', 'Classical style theme blog'),
        ];

        return self::getItems($items, $key);
    }

    public static function getDataImgSrc($key = null)
    {
        $source = empty(Yii::$app->params['qiniuConfig']['staticSourceUrl']) ? Yii::$app->request->baseUrl . '/static/img' : Yii::$app->params['qiniuConfig']['staticSourceUrl'];
        $items = [
            self::WEB_TEMPLATE_BASE => ['data-img-src' => $source . '/theme/basic.png', 'data-img-class' => 'picker200'],
            self::WEB_TEMPLATE_ONE => ['data-img-src' => $source . '/theme/qingxin.png', 'data-img-class' => 'picker200'],
            self::WEB_TEMPLATE_TWO => ['data-img-src' => $source . '/theme/gudian.png', 'data-img-class' => 'picker200'],
        ];

        return self::getItems($items, $key);
    }

    public static function loadThemes($key = null)
    {
        if (!$key) {
            $configData = \common\models\Config::loadData();
            $key = $configData['web_templates'];
        }

        $items = [
            self::WEB_TEMPLATE_BASE => '@app/themes/' . self::WEB_TEMPLATE_BASE,
            self::WEB_TEMPLATE_ONE => '@app/themes/' . self::WEB_TEMPLATE_ONE,
            self::WEB_TEMPLATE_TWO => '@app/themes/' . self::WEB_TEMPLATE_TWO,
        ];

        return self::getItems($items, $key);
    }

    public static function getHttpMethods($key = null)
    {
        $items = [
            self::HTTP_METHOD_GET => self::HTTP_METHOD_GET,
            self::HTTP_METHOD_POST => self::HTTP_METHOD_POST,
            self::HTTP_METHOD_PUT => self::HTTP_METHOD_PUT,
            self::HTTP_METHOD_DELETE => self::HTTP_METHOD_DELETE,
        ];

        return self::getItems($items, $key);
    }

    public static function getWatermarkLocation($key = null)
    {
        $items = [
            self::UPPER_LEFT => Yii::t('app', 'upper left'),
            self::UPPER_RIGHT => Yii::t('app', 'upper right'),
            self::LOWER_LEFT => Yii::t('app', 'lower left'),
            self::LOWER_RIGHT => Yii::t('app', 'lower right'),
        ];

        return self::getItems($items, $key);
    }

    public static function getWatermarkStyle($key = null)
    {
        $items = [
            self::WATERMARK_STYLE_TEXT => Yii::t('app', 'Text'),
            self::WATERMARK_STYLE_IMG => Yii::t('app', 'Image')
        ];

        return self::getItems($items, $key);
    }

    const Number_DATA_TYPE = 2;
    const String_DATA_TYPE = 1;

    public static function getDataTypes($key = null)
    {
        $items = [
            self::String_DATA_TYPE => Yii::t('common', 'String'),
            self::Number_DATA_TYPE => Yii::t('common', 'Number')
        ];

        return self::getItems($items, $key);
    }

    const FORM_INPUT_STRING = 'inputString';
    const FORM_INPUT_DATE = 'inputDate';
    const FORM_INPUT_EMAIL = 'inputEmail';
    const FORM_SELECT = 'select';

    public static function getSpecParDisType($key = null)
    {
        $items = [
            self::FORM_INPUT_STRING => Yii::t('mall', 'InputString'),
            self::FORM_INPUT_DATE => Yii::t('mall', 'InputDate'),
            self::FORM_INPUT_EMAIL => Yii::t('mall', 'InputEmail'),
            self::FORM_SELECT => Yii::t('mall', 'DropList'),
        ];

        return self::getItems($items, $key);
    }

    public static function getMallUnits($key = null)
    {
        $items = [
            '瓶' => '瓶',
            '盒' => '盒',
            '篓' => '篓',
            '箱' => '箱',
            '个' => '个',
            '包' => '包',
            '支' => '支',
            '条' => '条',
            '本' => '本',
            '块' => '块',
            '片' => '片',
            '把' => '把',
            '组' => '组',
            '双' => '双',
            '台' => '台',
            '件' => '件',
        ];

        return self::getItems($items, $key);
    }

}
