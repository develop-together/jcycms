<?php
/**
 * 
 * @Authors jiechengyang (2064320087@qq.com)
 * @Link    http://www.boomyang.cn
 * @addTime    2019-01-29 16:18:39
 */
namespace frontend\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\FrontendMenu;

class MenuView extends \yii\widgets\Menu
{	
	public $template = '<nav class="topnav" id="topnav"><ul>{items}</ul></nav>';

	public $linkTemplate = '<a href="{url}"><span>{label}</span><span class="en">{labelEn}</span></a>';

	public function init()
	{
		parent::init();
		if (empty($this->items)) {
			$menus = FrontendMenu::find()
				->select(['parent_id', 'id', 'name', 'url', 'target', 'is_absolute_url'])
				->show()
				->orderBy("sort asc, parent_id asc")
				->all();
			$items = [];
			foreach ($menus as $menu) {
					if (! $menu->is_absolute_url) {
						$url = Url::toRoute($menu->url);
					}
			}

			$this->items = [
				['label' => '首页', 'url' => ['/']],
				['label' => '关于我', 'url' => ['/about.html']],
				['label' => '慢生活', 'url' => ['/lift.html']],
				['label' => '碎言碎语', 'url' => ['/doing.html']],
				['label' => '模板分享', 'url' => ['/share.html']],
				['label' => '学无止境', 'url' => ['/learn.html']],
				['label' => '留言版', 'url' => ['/book.html']],
			];
		}

		if (Yii::$app->jcore->web_templates === 'template1')
			$this->registerTranslations();
	}

   	public function registerTranslations()
	{
	    $i18n = Yii::$app->i18n;
	    $i18n->translations['widgets/*'] = [
	        'class' => 'yii\i18n\PhpMessageSource',
	        //源语言为中文可理解为翻译目录对应的键为中文|language为目标语言就是我想翻译那个语言|对应翻译目录的值
	        'sourceLanguage' => 'zh-CN',
	        'basePath' => '@frontend/widgets/messages',
	        'fileMap' => [
	            'widgets/menu' => 'menu.php',
	        ],
	    ];
	}

   	public static function t($category, $message, $params = [], $language = 'en-US')
    {
        return Yii::t('widgets/' . $category, $message, $params, $language);
    }

	public function run()
	{
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
        $items = $this->normalizeItems($this->items, $hasActiveChild);
        if (!empty($items)) {
           return str_replace('{items}', $this->renderItems($items), $this->template);
        }
	}

    protected function renderItem($item)
    {
        if (isset($item['url'])) {
            $template = ArrayHelper::getValue($item, 'template', $this->linkTemplate);
            return strtr($template, [
                '{url}' => Html::encode(Url::to($item['url'])),
                '{label}' => $item['label'],
                '{labelEn}' => self::t('menu', $item['label'])
            ]);
        }

        $template = ArrayHelper::getValue($item, 'template', $this->labelTemplate);

        return strtr($template, [
            '{label}' => $item['label'],
        ]);
    }

}