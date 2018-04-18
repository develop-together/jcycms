(function(){
    var jcms = function () {
        this.ajax = function(type, url, data, dataType, callback, async) {
            if (type.toLowerCase() == 'post') {
               data._csrf_backend = $("meta[name='csrf-token']").attr('content'); 
            }

            jQuery.ajax({
                type: type,
                url: url,
                data: data,
                async: async,
                dataType: dataType,
                success: function(response) {
                   console.log('Response Data is: ', response);
                   // console.log(typeof(callback));return;
                   if (callback && typeof(callback) == 'function') {
                        callback(response);
                   }
                },
                error: function(qXHR, textStatus, errorThrown) {
                     swal(tips.error + ': ' + jqXHR.responseJSON.message, tips.operatingFailed + '.', "error");
                }
            });
        }

        this.callback = function(message, state, closeLayer) {
            state = !this._null(state) || 'ok';
            closeLayer = !this._null(closeLayer) || false;
            var config = [
                {state: 'ok', statusCode: 200, message: '操作成功'},
                {state: 'error', statusCode: 300, message: '操作失败'},
                {state: 'timeout', statusCode: 301, message: '操作超时'},
            ];
            var statusCode = 200;
            for (var p in config) {
                if (state != config[p].state) {
                        continue;
                }

                statusCode = config[p].statusCode;
                message = this._null(message) || config[p].message;
            }  
            var icon = statusCode == 200 ? 1 : 2;
            console.log('正确返回后是否关闭layer', closeLayer && statusCode == 200);
            var alertIndex = layer.alert(message, {icon: icon}, function(){
                closeLayer && statusCode == 200 && setTimeout(function () {
                    // parent.layer.closeAll();
                    layer.close(alertIndex);
                }, 1500);
            });
        },

        this._null = function(value) {
            if(value == null || value == 'undefined' || typeof(value) == 'undefined') {
                return true;
            } else {
                return false;
            }
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

    $("div.input-append").bind('click', function(e) {
        e.preventDefault();
        $(this).parent('div').find( 'input[type="file"]' ).click();
    });

    $('input.feehi_html5_upload[type=file]').bind('change', function () {
        if (typeof FileReader === 'undefined') {
            return;
        }
        var that = $(this);
        var files = $( this )[0].files;
        if(that.parent().attr('class').indexOf("image") >= 0){
            if(!/image\/\w+/.test(files[0].type)){
                layer.tips(tips.onlyPictureCanBeSelected, that.parent());
                return false;
            }
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            that.parents("div.image").children("div.input-append").children("input[type='text']").val(files[0].name);
            reader.onload = function (e) {
                console.log("打印上传测试记录:", that.parents("div.image").children());
                that.parents("div.image").children("img").attr("src", this.result);
            }
        }
    });
})