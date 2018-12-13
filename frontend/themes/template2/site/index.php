<?php 
?>

<article>
  <div class="l_box">
    <div class="about_me">
      <h2>关于我</h2>
      <ul>
        <i><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/4.jpg"></i>
        <p><b>杨青</b>，一个80后草根女站长！09年入行。一直潜心研究web前端技术，一边工作一边积累经验，分享一些个人博客模板，以及SEO优化等心得。</p>
      </ul>
    </div>
    <div class="wdxc">
      <h2>我的相册</h2>
      <ul>
        <li><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/7.jpg"></a></li>
        <li><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/8.jpg"></a></li>
        <li><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/9.jpg"></a></li>
        <li><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/10.jpg"></a></li>
        <li><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/11.jpg"></a></li>
        <li><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/12.jpg"></a></li>
      </ul>
    </div>
    <div class="search">
      <form action="/e/search/index.php" method="post" name="searchform" id="searchform">
        <input name="keyboard" id="keyboard" class="input_text" value="请输入关键字词" style="color: rgb(153, 153, 153);" onfocus="if(value=='请输入关键字词'){this.style.color='#000';value=''}" onblur="if(value==''){this.style.color='#999';value='请输入关键字词'}" type="text">
        <input name="show" value="title" type="hidden">
        <input name="tempid" value="1" type="hidden">
        <input name="tbname" value="news" type="hidden">
        <input name="Submit" class="input_submit" value="搜索" type="submit">
      </form>
    </div>
    <div class="fenlei">
      <h2>文章分类</h2>
      <ul>
        <li><a href="/">学无止境（33）</a></li>
        <li><a href="/">日记（19）</a></li>
        <li><a href="/">慢生活（520）</a></li>
        <li><a href="/">美文欣赏（40）</a></li>
      </ul>
    </div>
    <div class="tuijian">
      <h2>站长推荐</h2>
      <ul>
        <li><a href="/">你是什么人便会遇上什么人</a></li>
        <li><a href="/">帝国cms 列表页调用子栏目，没有则不显示栏目名称</a></li>
        <li><a href="/">第二届 优秀个人博客模板比赛参选活动</a></li>
        <li><a href="/">个人博客模板《绅士》后台管理</a></li>
        <li><a href="/">你是什么人便会遇上什么人</a></li>
        <li><a href="/">帝国cms 列表页调用子栏目，没有则不显示栏目名称</a></li>
        <li><a href="/">第二届 优秀个人博客模板比赛参选活动</a></li>
        <li><a href="/">个人博客模板《绅士》后台管理</a></li>
      </ul>
    </div>
    <div class="links">
      <h2>友情链接</h2>
      <ul>
        <a href="http://www.yangqq.com">杨青个人博客</a> <a href="http://www.yangqq.com">杨青博客</a>
      </ul>
    </div>
    <div class="guanzhu">
      <h2>关注我 么么哒</h2>
      <ul>
        <img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/wx.jpg">
      </ul>
    </div>
  </div>
  <div class="r_box">
    <li><i><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/1.jpg"></a></i>
      <h3><a href="/">你是什么人便会遇上什么人</a></h3>
      <p>有时就为了一句狠话，像心头一口毒钉，永远麻痺着亲密感情交流。恶言，真要慎出，平日多誠心爱语，乃最简易之佈施。</p>
    </li>
    <li><i><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/2.jpg"></a></i>
      <h3><a href="/">爱情没有永远，地老天荒也走不完</a></h3>
      <p>也许，爱情没有永远，地老天荒也走不完，生命终结的末端，苦短情长。站在岁月的边端，那些美丽的定格，心伤的绝恋，都被四季的掩埋，一去不返。徒剩下这荒芜的花好月圆，一路相随，流离天涯背负了谁的思念？</p>
    </li>
    <li><i><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/3.jpg"></a></i>
      <h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
      <p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
    </li>
    <li><i><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/4.jpg"></a></i>
      <h3><a href="/">擦肩而过</a></h3>
      <p>《擦肩而过》文/清河鱼 编绘/天朝羽打开一扇窗，我不曾把你想得平常。看季节一一过往。你停留的那个地方，是否依然花儿开放？在夜里守靠着梦中的，想那仿佛前世铭刻进心肠的</p>
    </li>
    <li>
      <h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
      <p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
    </li>
    <li><i><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/5.jpg"></a></i>
      <h3><a href="/">擦肩而过</a></h3>
      <p>《擦肩而过》文/清河鱼 编绘/天朝羽打开一扇窗，我不曾把你想得平常。看季节一一过往。你停留的那个地方，是否依然花儿开放？在夜里守靠着梦中的，想那仿佛前世铭刻进心肠的</p>
    </li>
    <li><i><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/6.jpg"></a></i>
      <h3><a href="/">女孩都有浪漫的小情怀——浪漫的求婚词</a></h3>
      <p>还在为浪漫的求婚词而烦恼不知道该怎么说吗？女孩子都有着浪漫的小情怀，对于求婚更是抱着满满的浪漫期待，也希望在求婚那一天对方可以给自己一个最浪漫的求婚词。</p>
    </li>
    <li><i><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/7.jpg"></a></i>
      <h3><a href="/">你是什么人便会遇上什么人</a></h3>
      <p>有时就为了一句狠话，像心头一口毒钉，永远麻痺着亲密感情交流。恶言，真要慎出，平日多誠心爱语，乃最简易之佈施。</p>
    </li>
    <li><i><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/8.jpg"></a></i>
      <h3><a href="/">爱情没有永远，地老天荒也走不完</a></h3>
      <p>也许，爱情没有永远，地老天荒也走不完，生命终结的末端，苦短情长。站在岁月的边端，那些美丽的定格，心伤的绝恋，都被四季的掩埋，一去不返。徒剩下这荒芜的花好月圆，一路相随，流离天涯背负了谁的思念？</p>
    </li>
    <li><i><a href="/"><img src="<?= Yii::$app->request->baseUrl ?>static/template2/images/9.jpg"></a></i>
      <h3><a href="/">擦肩而过</a></h3>
      <p>《擦肩而过》文/清河鱼 编绘/天朝羽打开一扇窗，我不曾把你想得平常。看季节一一过往。你停留的那个地方，是否依然花儿开放？在夜里守靠着梦中的，想那仿佛前世铭刻进心肠的</p>
    </li>
    <div class="pagelist"><a class="allpage"><b>99</b></a>&nbsp;&nbsp;<a href="#" class="curPage">1</a>&nbsp;&nbsp;<a href="#" onclick="page(2)">2</a>&nbsp;&nbsp;<a href="#" onclick="page(3)">3</a>&nbsp;&nbsp;<a href="#" onclick="page(4)">4</a>&nbsp;&nbsp;<a href="#" onclick="page(5)">5</a>&nbsp;&nbsp;<a href="#" onclick="page(6)">6</a>&nbsp;&nbsp;<a href="#" onclick="page(7)">7</a>&nbsp;&nbsp;<a href="#" onclick="page(8)">8</a>&nbsp;&nbsp;<a href="#" onclick="page(9)">9</a>&nbsp;&nbsp;<a href="#" onclick="page(2)">下一页</a></div>
  </div>
</article>