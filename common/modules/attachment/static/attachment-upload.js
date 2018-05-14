var deleteAjaxUrl = '';
$(document).ready(function(){
	var $fileInput = $('.upload-kit-input').find("input[type='file']:eq(0)");
	if ($fileInput.length) {
		var options = $fileInput.data('options') ? $fileInput.data('options') : $fileInput.attr('data-options');
		deleteAjaxUrl = options.deleteUrl;
		var files = options.files;
		if (files.length) {
			for (var p in files) {
				var file = files[p];
				var res = $('.upload-kit-input').attr('id');
				var fileInputId = options.id;
/*				var resObj = document.getElementById(res);
				var newObj = document.createElement('div');
				$(newObj).addClass('upload-kit-item done');		
				newObj.style.cssFloat = 'left';
				var newImg = new Image();
				newImg.style.width = '150px';
				newImg.style.height = '150px';	
				$(newObj).append('<span class=\'fa fa-trash remove\' data-id =\' ' + file.id + '\' onclick=\'removeFile(this)\' data-temp =\' '+ fileInputId+ '\' data-resid  = \' '+ res +' \'></span>');							 		
				if (!/image\/\w+/.test(file.filetype)) {//如果不是图片格式
					newImg.src = '/static/img/file.png';
				} else {						 			
					newImg.src = file.path;
				}
				
				newObj.appendChild(newImg);
				$("#" + fileInputId).val(file.path.replace('\/uploads\/', ''));
				resObj.parentNode.insertBefore(newObj, resObj);	
				resObj.style.display = 'none';*/
				_createImg(res, file, fileInputId, options.many);				
			}
		}
	}
})

function ajaxUpload(obj, res)
{
	var options = $(obj).data('options') ? $(obj).data('options') : $(obj).attr('data-options');
	deleteAjaxUrl = options.deleteUrl;
	var maxNumberOfFiles = options.maxNumberOfFiles;
	if (obj.files.length > maxNumberOfFiles) {
		layer.alert('最多上传' + maxNumberOfFiles + '个文件', {icon : 0});
		return;
	}
	var flag = true;
	for (var p in obj.files) {
		var fileObj = obj.files[p];
		if(fileObj == undefined || fileObj == '' || fileObj == null || fileObj.length == 0 || typeof(fileObj) == 'function') {
			continue;
		}

		if (fileObj instanceof Object) {
			flag = _fileUpload(fileObj, options, res, obj);
			if (!flag) {
				layer.alert(fileObj.name + '上传失败', {icon : 0});
				continue;
			}			
		}
	}
	
	$(obj).val('');

	return flag;
}

function in_array(needle, haystack)
{
	for (var i=0;i<haystack.length;i++) {
		if (needle == _trim(haystack[i].toLowerCase())) {
			return true;
		} else {
			continue;
		}
	}

	return false;
}

function _fileUpload(file, options, res, _fileDomObj) 
{
	var form = $(_fileDomObj).parent('div.upload-kit-input')
		.parent('div')
		.parent('div')
		.parent('form');
	var fd = new FormData(form.get(0));
	var ajaxUrl = options.url;
	var fileInputId = options.id;
	var fileInputName = options.name;
	var onlyImage = options.onlyImage;
	var maxNumberOfFiles = options.maxNumberOfFiles;
	var acceptFileTypes = options.acceptFileTypes;
	var acceptFileTypeArr = acceptFileTypes.split(',');
	var flag = true;
	var many = options.many;
	fd.append(fileInputId, file);

	if (!file) {
		layer.alert('请选择文件', {icon: 0});
		return false;
	}
	acceptFileTypes = _trim(acceptFileTypes);
	if (acceptFileTypes != '' && acceptFileTypes != undefined && acceptFileTypes != null ) {
		if (acceptFileTypes == 'image/*') {
			if (!/image\/\w+/.test(file.type)) {
				layer.alert('请选择图片', {icon: 0});
				return false;
			}
		} else if (!in_array(file.type, acceptFileTypeArr)) {
				layer.alert('请选择正确的图片格式(jpg,jpeg,png,gif,bmp)', {icon: 0});
				return false;
		}
	}

	jQuery.ajax({
		type : 'POST',
		data : fd,
		url : ajaxUrl,
		dataType : 'json',
		processData: false,  
		contentType:false,   
		xhr: function() {  // custom xhr  
			myXhr = $.ajaxSettings.xhr();  
			if(myXhr.upload){ // check if upload property exists  
				myXhr.upload.addEventListener('progress', function(evt){  
					evt = window.event || evt;
					var percentComplete = Math.round(evt.loaded*100 / evt.total);  
					console.log('上传完成时间：', percentComplete);  
				}, false); // for handling the progress of the upload  
			}  
			return myXhr;  
		},  		 
		success : function (data) {
			if (!data) {
				flag = false;
			} else {
/*				var resObj = document.getElementById(res);
				var newObj = document.createElement('div');
				$(newObj).addClass('upload-kit-item done');		
				newObj.style.cssFloat = 'left';
				var newImg = new Image();
				newImg.style.width = '150px';
				newImg.style.height = '150px';	
				$(newObj).append('<span class=\'fa fa-trash remove\' data-id =\' ' + data.id + '\' onclick=\'removeFile(this)\' data-temp =\' '+ fileInputId+ '\' data-resid  = \' '+ res +' \'></span>');							 		
				if (!/image\/\w+/.test(data.filetype)) {//如果不是图片格式
					newImg.src = '/static/img/file.png';
				} else {						 			
					newImg.src = data.filepath;
				}
				
				newObj.appendChild(newImg);
				$("#" + fileInputId).val(data.filepath.replace('\/uploads\/', ''));
				resObj.parentNode.insertBefore(newObj, resObj);	
				resObj.style.display = 'none';*/
				_createImg(res, data, fileInputId, many);
			}
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			flag = false;
			layer.alert(XMLHttpRequest.status + '<br>' + XMLHttpRequest.readyState + '<br>' + textStatus, {icon: 0});		 	
		}
	});	
	//var fileSize = Math.ceil(file.size / (1024 * 1024));
	// var reader = new FileReader();//将文件以Data URL 形式读入页面
	// reader.readAsDataURL(file);
	// reader.onload = function(e) {
	// 	var data = {
	// 				fileName : file.name, 
	// 				fileType : file.type, 
	// 				fileSize : file.size, 
	// 				acceptFileTypes : acceptFileTypes,
	// 				onlyImage : onlyImage,
	// 				base64Data : this.result
	// 		};
	// }

	return flag;	
}

function _createImg(res, data, fileInputId, many) {
	if(!data || !data.filepath) {
		return;
	}
	if (data.error) {
		layer.alert(data.error);
		return;
	}

	// many = !many || false;
	var resObj = document.getElementById(res);
	var newObj = document.createElement('div');
	$(newObj).addClass('upload-kit-item done');		
	newObj.style.cssFloat = 'left';
	var newImg = new Image();
	newImg.style.width = '150px';
	newImg.style.height = '150px';	
	$(newObj).append('<span class=\'fa fa-trash remove\' data-id =\' ' + data.id + '\' onclick=\'removeFile(this)\' data-temp =\' '+ fileInputId+ '\' data-resid  = \' '+ res +' \'></span>');							 		
	var filepath = data.path ? data.path : data.filepath;
	if (!/image\/\w+/.test(data.filetype)) {//如果不是图片格式
		newImg.src = '/static/img/file.png';
	} else {						 			
		newImg.src = filepath;
	}
	
	newObj.appendChild(newImg);
	resObj.parentNode.insertBefore(newObj, resObj);	
	if (!many) {
		$("#" + fileInputId).val(filepath.replace('\/uploads\/', ''));
		resObj.style.display = 'none';	
	} else {
		var fileContents = $("#" + fileInputId).val();
		fileContents += filepath.replace('\/uploads\/', '') + '、';
		$("#" + fileInputId).val(fileContents);
	}

}

function _trim(string) 
{
    return string.replace(/^\s+|\s+$/gm,'');
}

var removeFile = (function(obj){
		var fileId = parseInt($(obj).data('id') ? $(obj).data('id') : $(obj).attr('data-id'));
		var fileInputId = $(obj).data('temp') ? $(obj).data('temp') : $(obj).attr('data-temp');
		var resid = $(obj).data('resid') ? $(obj).data('resid') : $(obj).attr('data-resid');
		var filepath = $('#' + _trim(fileInputId)).val();
		layer.confirm('删除不可恢复，确定要删除吗?',{
		    bth:['确定','取消']
		},function(index){
			jQuery.ajax({
				type : 'POST',
				data : {'fileId' : fileId, 'filepath' : filepath},
				url : deleteAjaxUrl,
				dataType : 'json',
				success : function(data) {
					if (data.code == 200) {
						$(obj).parent().remove();
						$('#' + _trim(fileInputId)).val('');
						$('#' + _trim(resid)).show();
					}
				},
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					
				}
			});
		    layer.close(index);
		},function(){
		    layer.close(index);
		});
});

// var loadImageFile = (function () {
// 	if (window.FileReader) {
// 		var	oPreviewImg = null, oFReader = new window.FileReader(),
// 			rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

// 		oFReader.onload = function (oFREvent) {
// 			if (!oPreviewImg) {
// 				var newPreview = document.getElementById("imagePreview");
// 				oPreviewImg = new Image();
// 				oPreviewImg.style.width = (newPreview.offsetWidth).toString() + "px";
// 				oPreviewImg.style.height = (newPreview.offsetHeight).toString() + "px";
// 				newPreview.appendChild(oPreviewImg);
// 			}
// 			oPreviewImg.src = oFREvent.target.result;
// 		};

// 		return function () {
// 			var aFiles = document.getElementById("imageInput").files;
// 			if (aFiles.length === 0) { return; }
// 			if (!rFilter.test(aFiles[0].type)) { alert("You must select a valid image file!"); return; }
// 			oFReader.readAsDataURL(aFiles[0]);
// 		}

// 	}
// 	if (navigator.appName === "Microsoft Internet Explorer") {
// 		return function () {
// 			document.getElementById("imagePreview").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = document.getElementById("imageInput").value;

// 		}
// 	}
// })();