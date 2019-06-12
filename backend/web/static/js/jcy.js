(function(){
    var jcms = function () {
        var self = this;
        this.ajax = function(type, url, data, dataType, callback, async, timeout) {
            if (type.toLowerCase() == 'post') {
               data._csrf_backend = $("meta[name='csrf-token']").attr('content');
            }
            timeout = timeout || 30000;
            async = async || true;
            var ajaxRequest = jQuery.ajax({
                type: type,
                url: url,
                data: data,
                async: async,
                dataType: dataType,
                timeout: timeout,
                success: function(response) {
                   // console.log('Response Data is: ', response);
                   // console.log(typeof(callback));return;
                   if (callback && typeof(callback) == 'function') {
                        callback(response);
                   }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    if ('timeout' === textStatus ) {
                        swal(tips.error + ': ' + 'timeout!');
                        return;
                    }
                     jqXHR.responseJSON.hasOwnProperty('message') && swal(tips.error + ': ' + jqXHR.responseJSON.message, tips.operatingFailed + '.', "error");
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
            // console.log('正确返回后是否关闭layer', closeLayer && statusCode == 200);
            var alertIndex = layer.alert(message, {icon: icon}, function(){
                closeLayer && statusCode == 200 && setTimeout(function () {
                    // parent.layer.closeAll();
                    layer.close(alertIndex);
                    layer.closeAll('loading');
                }, 1000);
            });
        },

        this._null = function(value) {
            if(value == null || value == 'undefined' || typeof(value) == 'undefined') {
                return true;
            } else {
                return false;
            }
        },
        this.datum = {},
        this.autocomplete = function (counter, options) {
            // console.log('options:', options);
            if (!options.data && options.url) {// async
                if(options.url.indexOf('?search=%QUERY') == -1) {
                    if (options.url.indexOf('&') != -1) {
                        options.url += '&keyword=%QUERY%';
                    } else {
                        options.url += '?keyword=%QUERY%';
                    }
                }
                console.log('options.displayKey', options.displayKey);
                var params = {
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace(options.displayKey),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                }
                if (options.isCache) {
                    params.prefetch = options.url;
                } else {
                    params.remote = {url: options.url, wildcard: '%QUERY%'};
                }
                // console.log('params', params);
                this.datum = new Bloodhound(params);
            } else {// sync
                this.datum = new Bloodhound({
                    datumTokenizer: function(d) { return d[options.displayKey]; },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: options.data,
                    identify: function(obj) { return obj[options.valueKey]; },
                });
            }

            this.datum.initialize();
            var jqueryTypeahead = jQuery('.typeahead-' + counter).typeahead({
                // minLength: 0, //设置该项后鼠标放入输入框就会显示列表
                hint: true,
                highlight: true
            } , {
                name: options.name,
                displayKey: options.displayKey,
                limit: parseInt(options.limit),
                // async: true,
                source: baseUtil.nflTeamsWithDefaults,/*.ttAdapter()*/
            }).on('typeahead:select', function(ev, suggestion) {
                // console.log('Selection: ' + suggestion[options.valueKey]);
                $("#" + options.selectedDomId).val(suggestion[options.valueKey]);
            }).on('typeahead:asyncrequest', function() {// beforeAjax

            }).on('typeahead:asynccancel typeahead:asyncreceive', function(type) {// completed
            });

        },
        this.nflTeamsWithDefaults = function(query, sync, async) {
            this.datum.search(query, sync, async);
            // if (query === '') {
            //   this.datum.get('1');
            // } else {
            //   this.datum.search(query, sync, async);
            // }
        }
    }

    var jcmsobj = new jcms()
    window.jcms = jcmsobj;
})(window)

yii.confirm = function(message, ok, cancel) {
    var url = $(this).attr('href');
    var if_pjax = $(this).attr('data-pjax') ? $(this).attr('data-pjax') : 0;
    var type = $(this).attr('data-method') ? $(this).attr('data-method') : "get";
    // !url && $(this).attr('href', 'javascript:;');
    if (!url || url == 'javascript:;' || url == '#') {
        cancel();
    }
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

function close_tab()
{
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

function showPhotos(obj, shift)
{
    shift = shift || 5;
    var json =  JSON.parse($(obj).attr('data'));
    layer.photos({
        photos: json,
        shift: shift //0-6的选择，指定弹出图片动画类型，默认随机
    });
}

function reloadImageList(that, file)
{

    if(that.parent().attr('class').indexOf("image") >= 0){
        if(!/image\/\w+/.test(file.type)){
            layer.tips(tips.onlyPictureCanBeSelected, that.parent());
            return false;
        }
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = function (e) {
            // console.log("打印上传测试记录:", that.parents("div.image").children());
            // that.parents("div.image").children("img").attr("src", this.result);
            var maxWidth = '200px', maxHeight = '200px';
            if($(that).css('max-width')) {
                maxWidth = $(that).css('max-width');
            }

            if($(that).css('max-width')) {
                maxHeight = $(that).css('max-height');
            }

            that.parents("div.image").children("img.none_image").remove();
            that.parents("div.image").append("<img src='"+ this.result +"' style='max-width:" + maxWidth + ";max-height:" + maxHeight + "' class='upload_image_lists'/>");
        }
    }
}

$(document).ready(function(){
    // 批量操作
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
            }else{
                return false;
            }
        });
        return false;
    });

    // x:关闭当前div效果
    $("a.close-link").click(function () {
        var node = $(this).parents("div.ibox:first");
        node.hide();
        if(node.length == 0){
            $(this).parents("div.ibox-title").hide();
            $(this).parents("div.ibox-title:first").next().hide();
        }
        $(this).parents("div.ibox:first").hide();
    })

    // ^:toggle效果
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

    })

    // 刷新
    $('a.refresh').click(function(){
        location.reload();
        return false;
    });

    // 拥有该属性的标签打开tab
    $(".openContab").click(function(){
        parent.openConTab($(this));
        return false;
    });

    // myself 文件上传
    $("div.input-append").bind('click', function(e) {
        e.preventDefault();
        if ($('img.upload_image_lists')) {
            $('img.upload_image_lists').remove();
            $(this).parents("div.image").children("div.input-append").children("input[type='text']").val('');
        }
        $(this).parent('div').find( 'input[type="file"]' ).click();
    });

    // feehi 文件上传
    if ($('input.feehi_html5_upload[type=file]').val()) {
        $('input.feehi_html5_upload[type=file]').val('');
    }

    $('input.feehi_html5_upload[type=file]').bind('change', function () {
        if (typeof FileReader === 'undefined') {
            return;
        }
        var that = $(this);
        var files = $( this )[0].files;
        // console.log('value is:', $('input.filename_lists').val());
        var fileContents = !that.parent('div').find('input.filename_lists').val() ? '' : that.parent('div').find('input.filename_lists').val();
        var file = null;
        if (files) {
            that.parent('div').find('img.none_image').hide();
            for (var p in files) {
                file = files[p];
                if(typeof(file) == 'object') {
                    fileContents += file.name + '、';
                    reloadImageList(that, file);
                }
            }            
        } else {
            that.parent('div').find('img.none_image').show();
        }

        that.parents("div.image").children("div.input-append").children("input[type='text']").val(fileContents.substr(0, fileContents.length-1));
    });

    // layer phots
    if ($("div.photos_list").length) {
        $("div.photos_list").bind('click', function(){
            showPhotos(this, 3);
        });
    }

    // pjax刷新
    var container = $('.pjax-reload');
    if (container.length) {
        container.on('pjax:send',function(args){
            layer.load(2);
        });
        container.on('pjax:complete',function(args){
            layer.closeAll('loading');
            $('table tr td a.title').bind('mouseover mouseout', function() {
             showPhotos(this);
            });
        });
    }

    // 清空查询
    $('.clear-search').on('click', function() {
        // var csrfParam = $('meta[name="csrf-param"]').attr('content');
        // var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // $(this).closest('form').find('input, select').val('');
        // $(this).closest('form').find('input[name="' + csrfParam + '"]').val(csrfToken);
        // $(this).closest('form').submit();
        var url = $(this).closest('form').attr('action');
        window.location.href = url;
    });

})