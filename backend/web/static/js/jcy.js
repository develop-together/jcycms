(function(){
    var jcms = function () {
        this.ajax = function(type, url, data, dataType, async) {
            data.push({'_csrf_backend' : $("meta[name='csrf-token']").attr('content')});
            jQuery.ajax({
                type: type,
                url: url,
                data: data,
                async: async,
                dataType: dataType,
                success: function(data) {
                   console.log(data);
                },
                error: function(qXHR, textStatus, errorThrown) {
                     swal(tips.error + ': ' + jqXHR.responseJSON.message, tips.operatingFailed + '.', "error");
                }
            });
        }

        this.callback = function(message, state) {
            state = !state || 'ok';
            var config = [
                ['ok', [200, '操作成功']],
                ['error', [300, '操作失败']],
                ['timeout', [301, '操作超时']],
            ];
            var statusCode = config[state][0];
            message = !message || config[state][1];
            layer.alert('statusCode:' + statusCode + 'message:' + message);
        }
    }

    var jcmsobj = new jcms()
    window.jcms = jcmsobj;
})(window)

yii.confirm = function(message, ok, cancel) {
    var url = $(this).attr('href');
    var if_pjax = $(this).attr('data-pjax') ? $(this).attr('data-pjax') : 0;
    var type = $(this).attr('data-method') ? $(this).attr('data-method') : "get";
    $(this).attr('href', 'javascript:;');
    swal({
        title: message,
        text: tips.realyToDo,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: tips.cancel,
        confirmButtonText: tips.ok,
        closeOnConfirm: false
    }, function (isConfirm) {
        if(isConfirm) {
            if( parseInt( if_pjax ) ){
                !ok || ok();
            }else {
                swal(tips.waitingAndNoRefresh, tips.operating + '...', "success");
                $.ajax({
                    "url": url,
                    "dataType": "json",
                    "type": type,
                    "success": function (data) {
                        if (data.code == 200) {
                            swal(tips.success + '!', tips.operatingSuccess + '.', "success");
                            location.reload();
                        } else {
                            swal(tips.error + ': ' + data.message, tips.operatingFailed + '.', "error");
                        }
                    },
                    "error": function (jqXHR, textStatus, errorThrown) {
                        swal(tips.error + ': ' + jqXHR.responseJSON.message, tips.operatingFailed + '.', "error");
                    }
                });
            }
        }else{
            !cancel || cancel();
        }
    });
}

function viewLayer(type, url, obj, cssoption)
{
	if (!type) {
		 type = 2;
	}

	if (cssoption.length == 0) {
		cssoption = {width : '800px', height : '500px'};
	}

    layer.open({
        type: 2,
        title: obj.attr('title'),
        maxmin: true,
        shadeClose: true, //点击遮罩关闭层
        area : [cssoption.width , cssoption.height],
        content: url
    });
}

function close_tab() {
    $(".J_menuTab", parent.document).each(function (index) {
        if ($(this).hasClass("active")) {
            if ($(this).prev("a.J_menuTab").length > 0) {
                $(this).prev("a.J_menuTab").eq(0).addClass("active")
            }
            $(this).remove();
            if (parent.$(".J_iframe").eq(index).prev("iframe.J_iframe").length > 0) {
                parent.$(".J_iframe").eq(index).prev("iframe.J_iframe").eq(0).show()
            }
            parent.$(".J_iframe").eq(index).remove()
        }
    });
}

$(document).ready(function(){
    $(".multi-operate").click(function () {
        var url = $(this).attr('href');
        var ids = new Array();
        $("tr td input[type=checkbox]:checked").each(function(){
            ids.push($(this).val());
        });
        if(ids.length <= 0){
            swal(tips.noItemSelected, tips.PleaseSelectOne);
            return false;
        }
        ids = ids.join(',');
        swal({
            title: $(this).attr("data-confirm"),
            text: ids,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: tips.cancel,
            confirmButtonText: tips.ok,
            closeOnConfirm: false
        }, function (isConfirm) {
            if(isConfirm) {
                swal(tips.waitingAndNoRefresh, tips.operating+'...', "success");
                $.ajax({
                    "url":url,
                    "dataType" : "json",
                    "type" : "get",
                    "data":{'id':ids},
                    "success" : function (data) {
                        if (data.code == 0) {
                            swal(tips.success + '!', tips.operatingSuccess + '.', "success");
                            location.reload();
                        } else {
                            swal(tips.error + ': ' + data.message, tips.operatingFailed + '.', "error");
                        }
                    },
                    "error": function (jqXHR, textStatus, errorThrown) {
                        swal(tips.error + ': ' + jqXHR.responseJSON.message, tips.operatingFailed + '.', "error");
                    }
                });
            }else{
                return false;
            }
        });
        return false;
    });

/*    $("a.close-link").click(function () {
        var node = $(this).parents("div.ibox:first");
        node.hide();
        if(node.length == 0){
            $(this).parents("div.ibox-title").hide();
            $(this).parents("div.ibox-title:first").next().hide();
        }
        $(this).parents("div.ibox:first").hide();
    })

    $("a.collapse-link").click(function () {
        var node = $(this).parents("div.ibox:first").children("div.ibox-content");
        node.slideToggle();
        var iClass = $(this).children("i:first").attr('class');
        if(iClass == 'fa fa-chevron-up'){
            $(this).children("i:first").attr('class', 'fa fa-chevron-down');
        }else{
            $(this).children("i:first").attr('class', 'fa fa-chevron-up');
        }
        if(node.length == 0){
            $(this).parents("div.ibox-title:first").next().slideToggle();
        }

    })*/
    $('a.refresh').click(function(){
        location.reload();
        return false;
    });    
})