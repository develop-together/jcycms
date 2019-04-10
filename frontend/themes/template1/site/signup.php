<style>
.drag{
    position: relative;
    background-color: #e8e8e8;
    width: 325px;
    height: 40px;
    line-height: 40px;
    text-align: center;
}
.drag .handler{
    position: absolute;
    top: 0;
    left: 0;
    width: 40px;
    height: 38px;
    border: 1px solid #ccc;
    cursor: move;
}
.handler_bg{
    background: #fff url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3hpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo0ZDhlNWY5My05NmI0LTRlNWQtOGFjYi03ZTY4OGYyMTU2ZTYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NTEyNTVEMURGMkVFMTFFNEI5NDBCMjQ2M0ExMDQ1OUYiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NTEyNTVEMUNGMkVFMTFFNEI5NDBCMjQ2M0ExMDQ1OUYiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo2MTc5NzNmZS02OTQxLTQyOTYtYTIwNi02NDI2YTNkOWU5YmUiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NGQ4ZTVmOTMtOTZiNC00ZTVkLThhY2ItN2U2ODhmMjE1NmU2Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+YiRG4AAAALFJREFUeNpi/P//PwMlgImBQkA9A+bOnfsIiBOxKcInh+yCaCDuByoswaIOpxwjciACFegBqZ1AvBSIS5OTk/8TkmNEjwWgQiUgtQuIjwAxUF3yX3xyGIEIFLwHpKyAWB+I1xGSwxULIGf9A7mQkBwTlhBXAFLHgPgqEAcTkmNCU6AL9d8WII4HOvk3ITkWJAXWUMlOoGQHmsE45ViQ2KuBuASoYC4Wf+OUYxz6mQkgwAAN9mIrUReCXgAAAABJRU5ErkJggg==") no-repeat center;
}
.handler_ok_bg{
    background: #fff url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA3hpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDIxIDc5LjE1NTc3MiwgMjAxNC8wMS8xMy0xOTo0NDowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDo0ZDhlNWY5My05NmI0LTRlNWQtOGFjYi03ZTY4OGYyMTU2ZTYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6NDlBRDI3NjVGMkQ2MTFFNEI5NDBCMjQ2M0ExMDQ1OUYiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6NDlBRDI3NjRGMkQ2MTFFNEI5NDBCMjQ2M0ExMDQ1OUYiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIDIwMTQgKE1hY2ludG9zaCkiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDphNWEzMWNhMC1hYmViLTQxNWEtYTEwZS04Y2U5NzRlN2Q4YTEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NGQ4ZTVmOTMtOTZiNC00ZTVkLThhY2ItN2U2ODhmMjE1NmU2Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+k+sHwwAAASZJREFUeNpi/P//PwMyKD8uZw+kUoDYEYgloMIvgHg/EM/ptHx0EFk9I8wAoEZ+IDUPiIMY8IN1QJwENOgj3ACo5gNAbMBAHLgAxA4gQ5igAnNJ0MwAVTsX7IKyY7L2UNuJAf+AmAmJ78AEDTBiwGYg5gbifCSxFCZoaBMCy4A4GOjnH0D6DpK4IxNSVIHAfSDOAeLraJrjgJp/AwPbHMhejiQnwYRmUzNQ4VQgDQqXK0ia/0I17wJiPmQNTNBEAgMlQIWiQA2vgWw7QppBekGxsAjIiEUSBNnsBDWEAY9mEFgMMgBk00E0iZtA7AHEctDQ58MRuA6wlLgGFMoMpIG1QFeGwAIxGZo8GUhIysmwQGSAZgwHaEZhICIzOaBkJkqyM0CAAQDGx279Jf50AAAAAABJRU5ErkJggg==") no-repeat center;
}
.drag .drag_bg{
    background-color: #7ac23c;
    height: 40px;
    width: 0;
}
.drag .drag_text{
    position: absolute;
    top: 0;
    width: 325px;
    -moz-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    -o-user-select:none;
    -ms-user-select:none;
}
.main {
    width: 1160px;
    margin: 0 auto;
    padding: 20px 0;
}
.main-form {
    padding: 70px 0 70px 294px;
    background-color: #fff;
}
.main-form>form {
    width: 866px;
    height: 394px;
}
.form-tab {
    width: 320px;
    height: 30px;
    margin: 0 0 20px 125px;
    border-bottom: 1px solid #d7d7d7;
}
.form-tab li.cur-tab {
    border-color: #4477d0;
    color: #4477d0;
}
.form-tab li {
    width: 130px;
    float: left;
    text-align: center;
    line-height: 28px;
    border-bottom: 2px solid #fff;
    position: relative;
    cursor: pointer;
}
.show {
    display: block;
}
.form-group {
    margin: 20px 0;
    position: relative;
}
.form-group>label {
    display: inline-block;
    width: 100px;
    padding-right: 20px;
    vertical-align: middle;
    text-align: center;
}
.input-group {
    position: relative;
    display: inline-block;
    vertical-align: middle;
}
.input-group>input {
    width: 325px;
    height: 50px;
    box-sizing: border-box;
    border: 1px solid #d7d7d7;
    font-size: 14px;
    padding: 15px 0 15px 20px;
    line-height: 20px;
    color: #888;
}
.input-group>button {
    position: absolute;
    width: 120px;
    height: 36px;
    line-height: 36px;
    text-align: center;
    top: 7px;
    right: 4px;
    background-color: #dedede;
    color: #fff;
    cursor: pointer;
}
.drag {
    display: inline-block;
    vertical-align: middle;
}
.marl {
    margin-left: 124px;
}
.service-item {
    color: #4477d0;
}
.marl {
    margin-left: 124px;
}
.login-btn {
    display: block;
    width: 325px;
    height: 50px;
    background-color: #4477d0;
    line-height: 50px;
    text-align: center;
    color: #fff;
}
</style>
<div class="main">
    <div class="main-form">
        <form action="" id="form">
            <div class="form-tab">
                <h2 style="text-align: center">邮箱注册</h2>
            </div>
            <div class="form_contents show">
                <div class="phone-res">
                    <div class="form-group">
                        <label for="userName">手机号码</label>

                        <div class="input-group">
                            <input id="userName" type="text" placeholder="请输入手机号码" style="color: rgb(136, 136, 136);">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="drag0">滑动验证</label>
                        <div class="drag" id="drag0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cen-code">验证号码</label>

                        <div class="input-group">
                            <input id="cen-code" type="text" placeholder="请输入验证码">
                            <button id="getCodeBtn">获取验证码</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pwd">登录密码</label>
                        <div class="input-group">
                            <input id="pwd" type="password" placeholder="请输入登录密码">
                            <em></em>
                        </div>
                    </div>
                    <div class="form-group marl form-group-sp">
                        <input id="service_item" type="checkbox">
                        <label for="service_item" style="width:140px">
                            <span>同意并遵守</span>
                            <a class="service-item" href="#">《服务条款》</a>
                        </label>
                    </div>
                    <div class="form-group marl">
                        <a href="#" class="login-btn">立即注册</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
$this->registerJs(<<<JS
    (function($){
        $.fn.drag = function(options){
            var x, drag = this, isMove = false, defaults = {
            };
            var options = $.extend(defaults, options);
            //添加背景，文字，滑块
            var html = '<div class="drag_bg"></div>'+
                        '<div class="drag_text" onselectstart="return false;" unselectable="on">拖动滑块验证</div>'+
                        '<div class="handler handler_bg"></div>';
            this.append(html);

            var handler = drag.find('.handler');
            var drag_bg = drag.find('.drag_bg');
            var text = drag.find('.drag_text');
            var maxWidth = drag.width() - handler.width();  //能滑动的最大间距

            //鼠标按下时候的x轴的位置
            handler.mousedown(function(e){
                isMove = true;
                x = e.pageX - parseInt(handler.css('left'), 10);
            });

            //鼠标指针在上下文移动时，移动距离大于0小于最大间距，滑块x轴位置等于鼠标移动距离
            $(document).mousemove(function(e){
                var _x = e.pageX - x;
                if(isMove){
                    if(_x > 0 && _x <= maxWidth){
                        handler.css({'left': _x});
                        drag_bg.css({'width': _x});
                    }else if(_x > maxWidth){  //鼠标指针移动距离达到最大时清空事件
                        dragOk();
                    }
                }
            }).mouseup(function(e){
                isMove = false;
                var _x = e.pageX - x;
                if(_x < maxWidth){ //鼠标松开时，如果没有达到最大距离位置，滑块就返回初始位置
                    handler.css({'left': 0});
                    drag_bg.css({'width': 0});
                }
            });

            //清空事件
            function dragOk(){
                handler.removeClass('handler_bg').addClass('handler_ok_bg');
                text.text('验证通过');
                drag.css({'color': '#fff'});
                handler.unbind('mousedown');
                $(document).unbind('mousemove');
                $(document).unbind('mouseup');
            }
        };
    })(jQuery);
JS
);?>
<?php
$this->registerJs(<<<JS
    // input 聚焦清空 离开还原 用户输入时 后边出现清空按钮,点击可以清空
    ~function () {
        //input 聚焦清空 离开还原 用户输入时 后边出现清空按钮,点击可以清空
        function inputFun(input_id) {
            var input_id = document.getElementById(input_id), new_i = document.createElement("i");
            new_i.innerHTML = "×";
            input_id.val = input_id.getAttribute("placeholder"); // 自定义属性
            //聚焦时清空placeholder
            input_id.onfocus = function () {
                this.setAttribute("placeholder", "");
                this.style.color = "#333";
            };
            input_id.onblur = function () {
                this.setAttribute("placeholder", this.val);
                this.style.color = "#888";
            };

            // 用户输入时同时出现后边的清空按钮
            input_id.onkeydown = function () {
                if (this.value != "") {
                    this.parentNode.appendChild(new_i);
                }
            };

            input_id.onkeyup = function () {
                if (this.value == "") {
                    this.parentNode.removeChild(new_i);
                }
            };

            // 点击请空按钮 input 输入清空
            new_i.onclick = function () {
                this.parentNode.children[0].value = "";
                this.parentNode.removeChild(this);
            }
        }

        inputFun("userName");
        inputFun("pwd");
    }();

    //滑动验证
    $('.drag').drag();

    //点击获取验证码
    ~function () {
        function getCode(btnId) {
            var getCodeBtn = document.getElementById(btnId);
            var timer = null, num = 30;
            getCodeBtn.onclick = function () {
                var _this = this;
                this.className = "clicked";
                this.disabled = true;
                timer = window.setInterval(function () {
                    if (num == 0)
                    {
                        _this.className = "";
                        _this.disabled = false;
                        _this.innerHTML = "获取验证码";
                        clearInterval(timer);
                        num = 30;
                        return;
                    }
                    _this.innerHTML = num-- + " s后重新获取";
                }, 1000);
            }
        }

        getCode("getCodeBtn");
        getCode("getCodeBtn0");
    }();
JS
);?>