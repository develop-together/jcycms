<?php
declare(strict_types=1);
/**
 * Created by PhpStorm
 * User: Administrator
 * Author: JieChengYang
 * Date: 2020/3/22
 * Time: 15:16
 */

namespace common\widgets;


use yii\web\View;
use yii\widgets\Block;

class JsBlock extends Block
{

    public $key = null;

    public $pos = View::POS_END;

    /**
     * 是否就地呈现块内容。默认为False，表示不会显示捕获的块内容。
     * @var bool
     */
    public $renderInPlace = false;

    public function run()
    {
        $block = ob_get_clean();
        $block = trim($block);
        if ($this->renderInPlace) {
            $this->view->registerJs("\n", $this->pos, $this->key);
        }

        $pattern = "/^<script\b[^>]*>([\s\S]*)<\/script>/is";
        if (preg_match($pattern, $block, $matches)) {
            $block = $matches[1];
        }

        $this->view->registerJs($block, $this->pos, $this->key);

    }
}