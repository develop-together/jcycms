<?php

namespace frontend\widgets;

use Yii;
use yii\widgets\ListView;
use frontend\models\Article;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use yii\helpers\StringHelper;
use common\components\Utils;

class ArticleListView extends ListView
{
	public $layout = '{titler}<div class="bloglist left">{items}<div class="page">{pager}</page></div>';//{titler}

	public $titleLen = 24;

	public $summaryLen = 70;

	public $thumbWidth = 175;

	public $thumbHeight = 117;

	public $titler = '';

	public $options = [
		'class' => 'newList'
	];

	public $itemOptions = [
		'tag' => 'div',
		'class' => 'item',
	];

	public $pagerOptions = [
		'firstPageLabel' => false,
		'lastPageLabel' => '>>',
		'prevPageLabel' => '<',
		'nextPageLabel' => '>',
		'options' => [
		    'class' => 'pagination',
		],
	];

	public $template = '<h3>{title}</h3><figure><img src="{thumbUrl}"></figure><ul>
          <p>{summary}</p><a title="{title}" href="{viewUrl}" target="_blank" class="readmore">阅读全文>></a></ul><p class="dateview"><span>{create_time}</span><span>作者：{author}</span><span>个人博客：[<a href="{categoryUrl}">{categoryName}</a>]</span></p>';

	public function init()
	{
		parent::init();
		if ( empty($this->itemView) ) {
			$this->itemView = function ($model, $key, $index, $widget) {
				$categoryName = $model->catename;
				$categoryUrl = 'article/index/' . $model->catename;//或者使用Url::to()
				$thumbUrl = $model->getThumbUrl();
				$summary = StringHelper::truncate($model->summary, $this->summaryLen);
				$title = StringHelper::truncate($model->title, $this->titleLen);

				return str_replace([
					'{title}',
					'{thumbUrl}',
					'{summary}',
					'{viewUrl}',
					'{create_time}',
					'{author}',
					'{categoryUrl}',
					'{categoryName}'
				], [
					$title,
					$thumbUrl,
					$summary,
					Url::toRoute(['article/view', 'id' => $model->id]),
					Utils::tranDateTime($model->created_at),
					$model->user->penname,
					$categoryUrl,
					$categoryName
				], $this->template);

			};
		}
	}

    public function renderSection($name)
    {
        switch ($name) {
            case '{summary}':
                return $this->renderSummary();
            case '{items}':
                return $this->renderItems();
            case '{pager}':
                return $this->renderPager();
            case '{sorter}':
                return $this->renderSorter();
            case '{titler}':
            	return $this->renerTitler();
            default:
                return false;
        }
    }

	public function renerTitler()
	{
		return $this->titler;
	}

    public function renderPager()
    {
        $pagination = $this->dataProvider->getPagination();
        if ($pagination === false || $this->dataProvider->getCount() <= 0) {
            return '';
        }

        $pager = $this->pager;
        $class = ArrayHelper::remove($pager, 'class', LinkPager::className());
        $pager['pagination'] = $pagination;
        $pager['view'] = $this->getView();
        $pager = array_merge($pager, $this->pagerOptions);

        return $class::widget($pager);
    }
}