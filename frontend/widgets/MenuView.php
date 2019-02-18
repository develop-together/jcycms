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

	public $linkTemplate = '<a href="{url}" target="{target}"><span>{label}</span><span class="en">{labelEn}</span></a>';

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
						// $index = strripos($menu->url, '/');
						if (strpos(strtolower($menu->url), 'article')) {
							// $cat = substr($menu->url, $index + 1);
							// $url = substr($menu->url, 0, $index);
							// $url = Url::toRoute([$url, 'cat' => $cat]);
							$url = $menu->url;
						} else {
							$url = Url::toRoute($menu->url);
						}

					} else {
						$url = $menu->url;
					}

					array_push($items, ['label' => $menu->name, 'target' => $menu->target, 'url' => $url]);
			}

			$this->items = $items;
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
                '{url}' => Html::encode($item['url']),
                '{target}' => $item['target'],
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