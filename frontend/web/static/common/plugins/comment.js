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
function commentOut(showNode, data, i18ns) {
    if ($(showNode).children('li').length > 0 ) {
        $(showNode).prepend(reply(data, i18ns));
    } else {
        $(showNode).append(reply(data, i18ns));
    }

}

function reply(data, i18ns) {
    // id username, avator, content create_time like_count zf_count
    data.username = data.username || '游客';
    data.avator = data.avator || '/static/common/images/face.jpg';
    data.like_count = data.like_count || 0;
    data.zf_count = data.zf_count || 0;
    data.id = data.id || 0;
    data.aid = data.aid || 0;
    data.content = AnalyticEmotion(data.content);
    var html  = '<li>';
    html += '<div class="head-face">';
    html += '<img src="' + data.avator + '" >';
    html += '</div>';
    html += '<div class="reply-cont" >';
    html += '<p class="username">' + data.username + '</p>';
    html += '<p class="comment-body">' + data.content + '</p>';
    html += '<p class="comment-footer"><div style="float:left;padding-right: 5px;">' + data.create_time + '</div><div style="float:left;padding-right: 5px;cursor: pointer;" class="comment-hf hf-con-block" data-aid="' + data.aid + '" data-id="' + data.id + '" data-addcommented="0">' + i18ns[0] +'</div><div style="float:left;padding-right: 5px;" class="date-dz-z" data-id="' + data.id + ' data-submited="0"><i class="date-dz-z-click-red"></i>' + i18ns[1] + ' (<i class="z-num">' + data.like_count + '</i>)</div><div style="float:left;">' + i18ns[2] + '' + data.zf_count + '</div></p>';
    html += '</div>';
    html += '</li>';
    return html;
}

function checkCommentkeyUP(t, maxLen) {
    maxLen = maxLen || 139
    var len = $(t).val().length;
    if(len > maxLen){
        $(t).val($(t).val().substring(0, maxLen + 1));
        return false;
    }

    return true
}

