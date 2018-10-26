/**
*	图片查看
*	createname：杨捷成
*	Date:2018-04-17
*/

(function($) {
	function _get(id)
	{
		return document.getElementById(id);
	}

	function utilsImgView(options, obj)
	{
		options = !options ? {} : options;
		var self = this;
		this.isMoble = false;/*是否是手机端*/
		this.loadingSrc = '/static/img/mloading.gif';
		this.degree = 0; /*角度*/
		this.defaultId = 'imgview_main';
		this.loadId = 'imgview_spanimg';
		this.url = '';
		this.defaultMaxZindex = 99999;
		this.maskId = 'imgview_mask';
		this.maskHeight = document.body.scrollHeight;/*遮罩层的高度*/
		this.maskBgColor = 'rgba(0,0,0,0.6)';
		this.imgMaskId = 'imgview_spanmask';
		this.imgId = 'imgview_spanimg';
		this.imageStyle = 'position:absolute;z-index:1;left:0px;top:0px;background-color:rgba(0,0,0,0);width:100%;height:100%;cursor:move;user-select:none;-moz-user-select:none;-webkit-user-select:none;-ms-user-select:none;-khtml-user-select:none;';
		var windowHeight = $(window).height();
		if (this.maskHeight < windowHeight) {
			this.maskHeight = windowHeight;
		}

		this.init = function() {
			for (var p in options) {
				this[p] = options[p];
			}

			if (obj) {
				this.url = obj.attr('src');
			}

			this.showView();
		}

		this.showView = function() {
			var str = '<div id="' + this.defaultId + '" style="position:absolute;left:0px;top:0px;width:100%;height:100%;z-index:' + this.defaultMaxZindex + '">';
			str += '<div id="' + this.maskId + '" style="position:absolute;z-index:0;left:0px;top:0px;width:100%;height:' + this.maskHeight + 'px;background-color:' + this.maskBgColor + '"></div>';/*添加遮罩层*/
			str += '<span onclick="$(this).parent().remove()" style="position:fixed;z-index:2;top:2px;right:5px;color:white"><i class="fa fa-close"></i></span>';/*x按钮*/
			str += '<div id="imgview_span" style="position:fiexd;z-index:1;left:47%;top:47%;overflow:hidden;color:white">';
			str += '<div id="' + this.imgMaskId + '" style="' + this.imageStyle + '"></div>';
			str +='	<img style="position:absolute;z-index:0;left:0px;top:0px" id="' + this.imgId + '" width="100%" height="100%" src="' + this.loadingSrc  + '" >';
			str += '</div>';
			str += '<div style="position:fixed;z-index:2;left:0px;bottom:0px;text-align:center;color:white;width:100%;font-size:20px;background-color:rgba(0,0,0,0.2);height:40px;line-height:40px;overflow:hidden"><i style="cursor:pointer" id="imgview_zoom-out" class="fa fa-search-minus" title="缩小"></i> &nbsp; <span id="imgview_nowbili" style="font-size:14px">100%</span> &nbsp; <i style="cursor:pointer" class="fa fa-search-plus" title="放大" id="imgview_zoom-in"></i>';
			str +='  &nbsp; <i style="cursor:pointer" class="fa fa-arrows" title="原始大小" id="imgview_zoom-move"></i>';
			if(!this.ismobile)str += '  &nbsp; <a target="_blank" download="" style="color:white" href="' + this.url + '"><i style="cursor:pointer" class="fa fa-download" title="下载"></i></a>';
			str += '  &nbsp; <i style="cursor:pointer" class="fa fa-retweet" title="旋转90度" id="imgview_zoom-refresh"></i>';
			str += '</div>';
			$('body').append(str);
			$('#' + this.maskId).bind('click', function() {
				self.remove();
			})

			var img = new Image();
			img.src = this.url;
			img.onload = function(){
				self.showez(this.width,this.height, 1);
				try {
					// 鼠标滚轮插件
					$('#imgview_span').mousewheel(function(e){
						self.bilixxx(e.deltaY*0.1);
					});
				} catch(e) {

				}
				self.rotate(self.degree);
				self.initmove();
			}
			img.onerror=function(e){
				$('#imgview_span').html('无图');
			}
			$('#imgview_zoom-out').click(function(){
				self.bilixxx(-0.1);
			});
			$('#imgview_zoom-in').click(function(){
				self.bilixxx(0.1);
			});
			$('#imgview_zoom-refresh').click(function(){
				self.clickrotate();
			});
			$('#imgview_zoom-move').click(function(){
				self.bl=1;
				self.rotate(0);
				self.bilixxx(0);
			});
		}

		this.remove = function() {
			$('#' + this.defaultId).remove();
		}

		this.showez = function(w, h, lx) {
			this.width = w;
			this.height = h;
			var zw = $(window).width(), zh = $(window).height();
			var wm = zw - 50, wh = zh - 50;
			var bl = 1,nw  =  w,nh  =  h;
			if (w > wm) {
				bl = wm / w;
				nh = h * bl;
			}

			if (nh > wh) {
				bl = wh / h;
			}

			this.showbl(bl,lx);
		}

		this.showbl = function(bl,lx) {
			this.bl = bl;
			$('#imgview_nowbili').html('' + parseInt(bl * 100) + '%');
			var zw = $(window).width(),zh = $(window).height();
			var nw = this.width * this.bl,nh = this.height * this.bl;
			var l = (zw - nw) * 0.5,t = (zh - nh) * 0.5;
			var arr = {left:'' + l + 'px',top:'' + t + 'px',width:''  +  nw  +  'px',height:'' + nh + 'px'};
			var o1 = $('#imgview_span'); 
			if (lx != 2) {
				if (lx==1) {
					_get(this.imgId).src=this.url;
				}

				o1.css(arr);
			} else {
				o1.stop();
				o1.animate(arr, 300);
			}
		}

		this.bilixxx = function(lx) {
			var bl = this.bl + lx;
			if (bl < 0) {
				bl = 0.05;
			} 

			if  (bl > 3) {
				bl=3;
			}

			this.showbl(bl, 2);
		}

		this.initmove = function() {
			if (this.ismobile) {
				this.movehammer();

				return;
			} 
			var o = $('#' + this.imgMaskId);
			var x = 0, y = 0, oldl, oldt;
			o.mousedown(function(e) {
				x = e.clientX;
				y = e.clientY;
				var o1 = _get('imgview_span');
				oldl = parseInt(o1.style.left);
				oldt = parseInt(o1.style.top);
				self.movebo = true;
			});

			o.mousemove(function(e) {
				if (!self.movebo) {
					return;
				}
				var _x = e.clientX - x, _y = e.clientY - y;
				$('#imgview_span').css({left:'' + (oldl + _x) + 'px',top:'' + (oldt + _y) + 'px'});
			});

			o.mouseup(function(e) {
				self.movebo = false;
			});
		}

		this.rotate = function(ds) {
			var o = _get('imgview_span');
			var val = "rotate(" + ds + "deg)";
			o.style.transform = val;
			o.style.webkitTransform = val;
			o.style.msTransform = val;
			o.style.MozTransform = val;
			o.style.OTransform = val;
		}

		this.clickrotate = function() {
			this.degree += 90;
			if (this.degree >= 360) {
				this.degree = 0;
			}

			this.rotate(this.degree);
		}

		this.movehammer = function() {
			var o = _get(this.imgMaskId);
			var x = 0, y = 0, oldl, oldt;
			this.touchci = 0;
			o.addEventListener('touchstart', function(e) {
				self.touchci++;
				x = e.touches[0].clientX;
				y = e.touches[0].clientY;
				var o1 = _get('imgview_span');
				oldl = parseInt(o1.style.left);
				oldt = parseInt(o1.style.top);
				self.movebo = true;
				clearTimeout(self.touctimes);
				self.touctimes = setTimeout(function() {self.touchci = 0}, 200);
			}); 

			o.addEventListener('touchmove', function(e){
				e.preventDefault();
				if (!self.movebo) {
					return;
				}
				var _x = e.touches[0].clientX - x, _y = e.touches[0].clientY - y;
				$('#imgview_span').css({left:''+ (oldl + _x) + 'px',top:'' + (oldt + _y) + 'px'});
			}); 

			o.addEventListener('touchend', function(e) {
				self.movebo = false;
				if (self.touchci == 2) {
					self.bilixxx(0.1);
					self.touchci = 0;
				}
			}); 
		}
	}

	$.imgview = function(options) {
		var utils = new utilsImgView(options, false);
		utils.init();

		return utils;
	}

// $.fn是指jquery的命名空间，加上fn上的方法及属性，会对jquery实例每一个有效，
	$.fn.imgview = function(options) {
		var utils = new utilsImgView(options, $(this));
		utils.init();

		return utils;
	}

})(jQuery)