(function () {
    var jcms = function () {
        var self = this;
        this.isMobile = false;
        this.ajax = function (type, url, data, dataType, callback, async, timeout, isUpload, errCallback) {
            timeout = timeout || 30000;
            async = async || true;
            isUpload = isUpload || false;
            var ajaxParams = {
                type: type,
                url: url,
                data: data,
                async: async,
                timeout: timeout,
                dataType: dataType,
                success: function (response) {
                    if (callback && typeof (callback) == 'function') {
                        callback(response);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    if (errCallback && typeof (errCallback) == 'function') {
                        errCallback(jqXHR, textStatus, errorThrown);
                    } else {
                        if ('timeout' === textStatus) {
                            swal(tips.error + ': ' + 'timeout!');
                            return;
                        }
                        jqXHR.responseJSON && jqXHR.responseJSON.hasOwnProperty('message') && swal(tips.error + ': ' + jqXHR.responseJSON.message, tips.operatingFailed + '.', "error");
                    }
                }
            }

            if (type.toLowerCase() == 'post') {
                if (Object.prototype.toString.call(data) === "[object FormData]" || isUpload) {
                    data.append('_csrf_backend', $("meta[name='csrf-token']").attr('content'));
                    ajaxParams['processData'] = false;
                    ajaxParams['contentType'] = false;
                } else {
                    data._csrf_backend = $("meta[name='csrf-token']").attr('content');
                }
            }

            var ajaxRequest = jQuery.ajax(ajaxParams);
        }
        this.callback = function (message, state, closeLayer) {
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
            var alertIndex = layer.alert(message, {icon: icon}, function () {
                closeLayer && statusCode == 200 && setTimeout(function () {
                    layer.close(alertIndex);
                    layer.closeAll('loading');
                }, 1000);
            });
        };

        this._null = function (value) {
            if (value == '' || value == null || value == 'undefined' || typeof (value) == 'undefined') {
                return true;
            } else {
                return false;
            }
        };
        this.datum = {};
        this.autocomplete = function (counter, options) {
            if (!options.data && options.url) {// async
                if (options.url.indexOf('?search=%QUERY') == -1) {
                    if (options.url.indexOf('&') != -1) {
                        options.url += '&keyword=%QUERY%';
                    } else {
                        options.url += '?keyword=%QUERY%';
                    }
                }
                var params = {
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace(options.displayKey),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                }
                if (options.isCache) {
                    params.prefetch = options.url;
                } else {
                    params.remote = {url: options.url, wildcard: '%QUERY%'};
                }
                this.datum = new Bloodhound(params);
            } else {// sync
                this.datum = new Bloodhound({
                    datumTokenizer: function (d) {
                        return d[options.displayKey];
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: options.data,
                    identify: function (obj) {
                        return obj[options.valueKey];
                    },
                });
            }

            this.datum.initialize();
            var jqueryTypeahead = jQuery('.typeahead-' + counter).typeahead({
                // minLength: 0, //设置该项后鼠标放入输入框就会显示列表
                hint: true,
                highlight: true
            }, {
                name: options.name,
                displayKey: options.displayKey,
                limit: parseInt(options.limit),
                // async: true,
                source: baseUtil.nflTeamsWithDefaults,/*.ttAdapter()*/
            }).on('typeahead:select', function (ev, suggestion) {
                $("#" + options.selectedDomId).val(suggestion[options.valueKey]);
            }).on('typeahead:asyncrequest', function () {// beforeAjax

            }).on('typeahead:asynccancel typeahead:asyncreceive', function (type) {// completed
            });

        };
        this.nflTeamsWithDefaults = function (query, sync, async) {
            this.datum.search(query, sync, async);
        }
        this.adaptPhone = function () {
            var windowWidth = $(window).width();
            var tables = document.getElementsByTagName("table");
            if (tables.length <= 0) return;
            var table = tables[0];
            var rows = table.rows;
            var columns = rows[0].cells.length;
            var displayColumns = 4;
            var lastColumnIndex = columns - 1;
            var i, j = 0;
            var display = "";
            if (columns > displayColumns) {
                if (windowWidth < 640 || this.isMobile) {
                    display = "none";
                }
                for (i = 0; i < rows.length; i++) {
                    for (j = displayColumns; j < lastColumnIndex; j++) {
                        if (!rows.hasOwnProperty(i)) continue;
                        if (!rows[i].cells.hasOwnProperty(j)) continue;
                        rows[i].cells[j].style.display = display;
                    }

                }
            }
        }
    }
    var jobj = new jcms();
    window.jcms = jobj;
})(window);
if (typeof yii === 'object') {
    yii.confirm = function (message, ok, cancel) {
        var url = $(this).attr('href');
        var if_pjax = $(this).attr('data-pjax') ? $(this).attr('data-pjax') : 0;
        var type = $(this).attr('data-method') ? $(this).attr('data-method') : "get";
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
            if (isConfirm) {
                if (parseInt(if_pjax)) {
                    !ok || ok();
                } else {
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
            } else {
                !cancel || cancel();
            }
        });
    }
}


function viewLayer(type, url, obj, cssoption) {
    if (!type) {
        type = 2;
    }
    if (cssoption.length == 0) {
        cssoption = {width: '800px', height: '500px'};
    }
    layer.open({
        type: 2,
        title: obj.attr('title'),
        maxmin: true,
        shadeClose: true, //点击遮罩关闭层
        area: [cssoption.width, cssoption.height],
        content: url
    });
}

function close_tab() {
    $(".J_menuTab", parent.document).each(function (index) {
        if ($(this).hasClass("active")) {
            if ($(this).prev("a.J_menuTab").length > 0) {
                $(this).prev("a.J_menuTab").eq(0).addClass("active");
            }
            $(this).remove();
            if (parent.$(".J_iframe").eq(index).prev("iframe.J_iframe").length > 0) parent.$(".J_iframe").eq(index).prev("iframe.J_iframe").eq(0).show();
            parent.$(".J_iframe").eq(index).remove()
        }
    });
}

function EscapeChar(HaveSpecialval) {
    //转换半角单引号
    HaveSpecialval = HaveSpecialval.replace(/\'/g, "\\\'");

    //也可以使用&acute;
    HaveSpecialval = HaveSpecialval.replace(/\'/g, "&acute;");
    return HaveSpecialval;
}

function showPhotos(obj, shift) {
    if (!jcms._null($(obj).attr('data'))) {
        shift = shift || 5;
        var json = JSON.parse($(obj).attr('data'));
        layer.photos({
            photos: json,
            shift: shift //0-6的选择，指定弹出图片动画类型，默认随机
        });
    }
}

var curFiles = [];

function reloadImageList(that, file) {
    if (that.parent().attr('class').indexOf("image") >= 0) {
        if (!/image\/\w+/.test(file.type)) {
            layer.tips(tips.onlyPictureCanBeSelected, that.parent());
            return false;
        }
        var reader = new FileReader();
        reader.readAsDataURL(file);
        var multiple = that.attr('multiple');
        reader.onload = function (e) {
            var maxWidth = '200px', maxHeight = '200px';
            if ($(that).css('max-width')) {
                maxWidth = $(that).css('max-width');
            }

            if ($(that).css('max-width')) {
                maxHeight = $(that).css('max-height');
            }
            var imageHtml = '<div class="multi-item col-lg-3 col-sm-3 col-md-3"><img class="upload_image_lists img-thumbnail" src="' + this.result + '"></div>';
            if (multiple) {
                imageHtml = '<div class="multi-item col-lg-3 col-sm-3 col-md-3"><i class="fa fa-trash cancels" style="position: absolute;right:3px;top: -3px;z-index:999;font-size: 14px;color: red;" data-file="' + file.name + '" data-fid=""></i><img class="upload_image_lists img-thumbnail" src="' + this.result + '"></div>';
            } else {
                that.parents("div.image").find('div.multi-img-details').empty();
            }

            that.parents("div.image").children("img.none_image").remove();
            that.parents("div.image").find('div.multi-img-details').append(imageHtml);
            _clickRemoveImg();

        }
    }
}

function _clickRemoveImg() {
    $("div.multi-img-details").find('i.cancels').bind('click', function (evt) {
        var file = $(this).data('file');
        var fid = $(this).data('fid');
        var inputId = $(this).data('input');
        inputId = jcms._null(inputId) ? $(this).parent('div').parent('div').parent('div').find('input.feehi_html5_upload').attr('id') : inputId;
        var delHidden = $('#del_file_' + inputId);
        if (fid != '' && fid != null && fid != undefined && fid != 'undefined') {
            delHidden.val(delHidden.val() + fid + ',');
        }
        var obj = $(this).parent()
            .parent('.multi-img-details')
            .prev('.input-append')
            .find("input.filename_lists");
        var fobj = $(this).parent()
            .parent('.multi-img-details')
            .parent('div.image')
            .find("input.feehi_html5_upload");
        var newfiles = '';
        if (obj && file) {
            var files = obj.val();
            if (files) {
                var fileList = files.split('、');
                for (var i = 0; i < fileList.length; i++) {
                    if (fileList[i] == file) {
                        continue;
                    }
                    newfiles += fileList[i] + '、';
                }
                obj.val(newfiles.substring(0, newfiles.length - 1));
            }

            if (curFiles) {
                curFiles = curFiles.filter(function (fileObj) {
                    return fileObj.name !== file;
                });
            }
        }

        $(this).parent().remove();
    })
}

function showImage(obj) {
    articleShowImgTimer = setTimeout(function () {
        var node = $(obj).attr('title');
        // console.log($(obj));return;
        if (node.length) {
            layer.tips('<img src="' + node + '" width="100" height="100">', $(obj), {
                tips: [2, '#3595CC'],
            });
        }
    }, 200);
}

var Agents = ["Android", "iPhone", "SymbianOS", "Windows Phone", "iPad", "iPod"];
for (var v = 0; v < Agents.length; v++) {
    if (navigator.userAgent.indexOf(Agents[v]) > 0) {
        jcms.isMobile = true;
        break;
    }
}

$(document).ready(function () {
    //适配手机
    jcms.adaptPhone();
    $(window).resize(jcms.adaptPhone());
    // 批量操作
    $(".multi-operate").click(function () {
        var url = $(this).attr('href');
        var ids = new Array();
        $("tr td input[type=checkbox]:checked").each(function () {
            ids.push($(this).val());
        });
        if (ids.length <= 0) {
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
            if (isConfirm) {
                swal(tips.waitingAndNoRefresh, tips.operating + '...', "success");
                $.ajax({
                    "url": url,
                    "dataType": "json",
                    "type": "get",
                    "data": {'id': ids},
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
            } else {
                return false;
            }
        });
        return false;
    });

    // x:关闭当前div效果
    $("a.close-link").click(function () {
        var node = $(this).parents("div.ibox:first");
        node.hide();
        if (node.length == 0) {
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
        if (iClass == 'fa fa-chevron-up') {
            $(this).children("i:first").attr('class', 'fa fa-chevron-down');
        } else {
            $(this).children("i:first").attr('class', 'fa fa-chevron-up');
        }
        if (node.length == 0) {
            $(this).parents("div.ibox-title:first").next().slideToggle();
        }

    })

    _clickRemoveImg();

    // 刷新
    $('a.refresh').click(function () {
        location.reload();
        return false;
    });

    // 拥有该属性的标签打开tab
    $(".openContab").click(function () {
        parent.openConTab($(this));
        return false;
    });

    // myself 文件上传
    $("div.input-append").bind('click', function (e) {
        e.preventDefault();
        if ($('img.upload_image_lists')) {
            $('img.upload_image_lists').remove();
            var newFileContents = '';
            var oldFileContents = $(this).parents("div.image").children("div.input-append").children("input[type='text']").val();
            if (oldFileContents) {
                newFileContents = oldFileContents + '、';
            }

            $(this).parents("div.image").children("div.input-append").children("input[type='text']").val(newFileContents.substr(0, newFileContents.length - 1));
        }
        $(this).parent('div').find('input[type="file"]').click();
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
        var files = $(this)[0].files;
        var newFileContents = '';
        var multiple = that.attr('multiple');
        var oldFileContents = that.parent('div').find('input.filename_lists').val();
        if (multiple && oldFileContents) newFileContents = oldFileContents + '、';
        var file = null;
        if (files) {
            that.parent('div').find('img.none_image').hide();
            if (files && files.length) Array.prototype.push.apply(curFiles, files);// 原始FileList对象不可更改，所以将其赋予curFiles提供接下来的修改    
            for (var p in files) {
                file = files[p];
                if (typeof (file) == 'object') {
                    newFileContents += file.name + '、';
                    reloadImageList(that, file);
                }
            }
        } else {
            that.parent('div').find('img.none_image').show();
        }

        that.parents("div.image").children("div.input-append").children("input[type='text']").val(newFileContents.substr(0, newFileContents.length - 1));
    });

    // layer phots
    if ($("div.photos_list").length) {
        $("div.photos_list").bind('click', function () {
            showPhotos(this, 3);
        });
    }

    // pjax刷新
    var container = $('.pjax-reload');
    if (container.length) {
        container.on('pjax:beforeSend', function (xhr, options) {
        });
        container.on('pjax:send', function (xhr, options) {
            layer.load();
        });
        container.on('pjax:complete', function (xhr, textStatus, options) {
            layer.closeAll('loading');
            $('table tr td a.title').bind('mouseover mouseout', function () {
                showPhotos(this);
            });
        });
    }
    $(".pjax-refresh").bind('click', function () {
        var currentHref = $(".pagination").find("li.active > a").attr('href');
        if (currentHref) {
            $.pjax.reload('.pjax-reload', {url: currentHref});
        } else {
            $.pjax.reload('.pjax-reload');
        }
    });
    // 清空查询
    $('.clear-search').on('click', function () {
        // var csrfParam = $('meta[name="csrf-param"]').attr('content');
        // var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // $(this).closest('form').find('input, select').val('');
        // $(this).closest('form').find('input[name="' + csrfParam + '"]').val(csrfToken);
        // $(this).closest('form').submit();
        var url = $(this).closest('form').attr('action');
        window.location.href = url;
    });

    //ajax form submit
    $("button.ajax-form-submit").bind('click', function () {
        var form = $(this).parent().parent().parent('form')[0];
        var fd = new FormData(form);
        var ajaxUrl = form.getAttribute('action');
        if (curFiles && curFiles.length) {
            var fobj = $(form).find('input.feehi_html5_upload');
            fd.delete(fobj.attr('name'));
            for (var i = 0; i < curFiles.length; i++) {
                fd.append(fobj.attr('name'), curFiles[i]);
            }
        }

        jcms.ajax('POST', ajaxUrl, fd, 'JSON', function (response) {
            if (200 == response.statusCode) {
                layer.msg(response.message, {icon: 6});
                curFiles = [];
                setTimeout(function () {
                    location.href = response.href;
                }, 300);
            } else {
                layer.msg(response.message, {icon: 5});
            }
            return false;
        }, true, 10000, true, function (XMLHttpRequest, textStatus, errorThrown) {
            if (200 !== XMLHttpRequest.status) {
                layer.alert(XMLHttpRequest.status + '<br>' + XMLHttpRequest.readyState + '<br>' + textStatus, {icon: 5});
            }
        });
    });

    // 列表显示图片
    var articleShowImgTimer;
    $('table tr td a.title').hover(
        function () {
            showImage(this);
        },
        function () {
            clearTimeout(articleShowImgTimer);
        }
    );


    //在顶部导航栏打开tab
    $(".openContab").click(function () {
        parent.openConTab($(this));
        return false;
    });

    //提交表单后除form为none-loading的class显示loading效果
    $("form:not(.none-loading)").bind("beforeSubmit", function () {
        $(this).find("button[type=submit]").attr("disabled", true);
        layer.load(2, {
            shade: [0.1, '#fff'] //0.1透明度的白色背景
        });
    });

    //美化日期laydate插件
    $('.date-time').each(function () {
        var config = {
            elem: this,
            type: this.getAttribute('dateType'),
            range: this.getAttribute('range') === 'true' ? true : (this.getAttribute('range') === 'false' ? false : this.getAttribute('range')),
            format: this.getAttribute('format'),
            value: this.getAttribute('val') === 'new Date()' ? new Date() : this.getAttribute('val'),
            isInitValue: this.getAttribute('isInitValue') != 'false',
            min: this.getAttribute('min'),
            max: this.getAttribute('max'),
            trigger: this.getAttribute('trigger'),
            show: this.getAttribute('show') != 'false',
            position: this.getAttribute('position'),
            zIndex: parseInt(this.getAttribute('zIndex')),
            showBottom: this.getAttribute('showBottom') != 'false',
            btns: this.getAttribute('btns').replace(/\[/ig, '').replace(/\]/ig, '').replace(/'/ig, '').replace(/\s/ig, '').split(','),
            lang: this.getAttribute('lang'),
            theme: this.getAttribute('theme'),
            calendar: this.getAttribute('calendar') != 'false',
            mark: JSON.parse(this.getAttribute('mark'))
        };

        if (!this.getAttribute('search')) {//搜素
            config.done = function (value, date, endDate) {
                setTimeout(function () {
                    $(this).val(value);
                    var e = $.Event("keydown");
                    e.keyCode = 13;
                    $(".date-time[search!='true']").trigger(e);
                }, 100)
            }
        }
        delete config['val'];

        laydate.render(config);
    });

    //美化select选框jquery chosen
    $(".chosen-select").each(function () {
        var config = {
            allow_single_deselect: this.getAttribute('allow_single_deselect') !== 'false',
            disable_search: this.getAttribute('disable_search') !== 'false',
            disable_search_threshold: this.getAttribute('disable_search_threshold'),
            enable_split_word_search: this.getAttribute('enable_split_word_search') !== 'false',
            inherit_select_classes: this.getAttribute('inherit_select_classes') !== 'false',
            max_selected_options: this.getAttribute('max_selected_options'),
            no_results_text: this.getAttribute('no_results_text'),
            placeholder_text_multiple: this.getAttribute('placeholder_text_multiple'),
            placeholder_text_single: this.getAttribute('placeholder_text_single'),
            search_contains: this.getAttribute('search_contains') !== 'false',
            group_search: this.getAttribute('group_search') !== 'false',
            single_backstroke_delete: this.getAttribute('single_backstroke_delete') !== 'false',
            width: this.getAttribute('width'),
            display_disabled_options: this.getAttribute('display_disabled_options') !== 'false',
            display_selected_options: this.getAttribute('display_selected_options') !== 'false',
            include_group_label_in_selected: this.getAttribute('include_group_label_in_selected') !== 'false',
            max_shown_results: this.getAttribute('max_shown_results'),
            case_sensitive_search: this.getAttribute('case_sensitive_search') !== 'false',
            hide_results_on_select: this.getAttribute('hide_results_on_select') !== 'false',
            rtl: this.getAttribute('rtl') !== 'false'
        };
        $(this).chosen(config);
    })

});

