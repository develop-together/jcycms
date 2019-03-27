(function($) {
    $.fn.extend({
        insertContent: function(myValue, t) {
            var $t = $(this)[0];
            if (document.selection) { //ie
                this.focus();
                var sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
                sel.moveStart('character', -l);
                var wee = sel.text.length;
                if (arguments.length == 2) {
                    var l = $t.value.length;
                    sel.moveEnd("character", wee + t);
                    t <= 0 ? sel.moveStart("character", wee - 2 * t - myValue.length) : sel.moveStart("character", wee - t - myValue.length);

                    sel.select();
                }
            } else if ($t.selectionStart || $t.selectionStart == '0') {
                var startPos = $t.selectionStart;
                var endPos = $t.selectionEnd;
                var scrollTop = $t.scrollTop;
                $t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos, $t.value.length);
                this.focus();
                $t.selectionStart = startPos + myValue.length;
                $t.selectionEnd = startPos + myValue.length;
                $t.scrollTop = scrollTop;
                if (arguments.length == 2) {
                    $t.setSelectionRange(startPos - t, $t.selectionEnd + t);
                    this.focus();
                }
            }
            else {
                this.value += myValue;
                this.focus();
            }
        }
    })
})(jQuery);
$(document).ready(function(){
	$(".img-icon").click(function(){
		$(".cont-box .text").insertContent('<img src="请在这里输入图片地址" alt=""/>', -10);
	});
});
// 测试本地解析
function out(inputNode, showNode) {
    var inputText = $(inputNode).val();
    $(showNode).append(reply(AnalyticEmotion(inputText)));
}
// var html;
function reply(content) {
    var html  = '<li style=" width: 100%;height: auto;padding: 10px 0 20px 0;border-bottom: 1px dashed #c0c0c0;float: left;">';
    html += '<div class="head-face" style="width: 10%;float: left;text-align: center;">';
    html += '<img src="/static/common/images/none.jpg" / style="width: 50px;height: 50px;border-radius: 50%;box-shadow: 0 0 8px #c0c0c0;">';
    html += '</div>';
    html += '<div class="reply-cont" style="width: 89%; padding-right: 1%;float: right;">';
    html += '<p class="username">小小红色飞机</p>';
    html += '<p class="comment-body">'+content+'</p>';
    html += '<p class="comment-footer">2016年10月5日　回复　点赞54　转发12</p>';
    html += '</div>';
    html += '</li>';
    return html;
}
