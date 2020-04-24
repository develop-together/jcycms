var deleteAjaxUrl = '';
$(document).ready(function(){
	var $fileInput = $('.upload-kit-input').find("input[type='file']:eq(0)");
	if ($fileInput.length) {
		var options = $fileInput.data('options') ? $fileInput.data('options') : $fileInput.attr('data-options');
		deleteAjaxUrl = decodeURIComponent(options.deleteUrl);
		var files = options.files;
		if (files.length) {
			for (var p in files) {
				var file = files[p];
				var res = $('.upload-kit-input').attr('id');
				_createImg(res, file, options.hiddenInputId, options.many);				
			}
		}
	}
})

function ajaxUpload(obj, res)
{
	var options = $(obj).data('options') ? $(obj).data('options') : $(obj).attr('data-options');
	deleteAjaxUrl = decodeURIComponent(options.deleteUrl);
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
	var fd = new FormData();//form.get(0)
	var ajaxUrl = options.url;
	var fileInputId = _fileDomObj.getAttribute('name');
	var hiddenInputId = options.hiddenInputId;
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
    jcms.ajax('POST', ajaxUrl, fd, 'JSON', function(response) {
		if (!response) {
			flag = false;
		} else {
			if ( 200 === response.statusCode) {
				_createImg(res, response, hiddenInputId, many);
			} else {
				flag = false;
				layer.alert(response.stateInfo, {icon: 5});
				return false;
			}
		}
    }, true, 10000, true, function(XMLHttpRequest, textStatus, errorThrown) {
    	if (200 !== XMLHttpRequest.status) {
			flag = false;
			layer.alert(XMLHttpRequest.status + '<br>' + XMLHttpRequest.readyState + '<br>' + textStatus, {icon: 5});
    	}
    });
	return flag;	
}

function _createImg(res, data, hiddenInputId, many) {
	var fullname, fid, ftype;
	if (data.fullname) fullname = data.fullname;
	if (data.path) fullname = data.path;
	var url = data.url ? data.url : data.url;
	if(!data || !fullname || !url) {
		return;
	}

	if (data.error) {
		layer.alert(data.error);
		return;
	}
	var resObj = document.getElementById(res);
	var newObj = document.createElement('div');
	if (data.attachment_id) fid = data.attachment_id;
	if (data.id) fid = data.id;
	if (data.mimeType) ftype = data.mimeType;
	if (data.filetype) ftype = data.filetype;
	$(newObj).addClass('upload-kit-item done');		
	newObj.style.cssFloat = 'left';
	var newImg = new Image();
	// newImg.style.width = '150px';
	// newImg.style.height = '150px';
	$(newObj).append('<span class=\'fa fa-trash remove\' data-id =\' ' + fid + '\' onclick=\'removeFile(this)\' data-temp =\' '+ hiddenInputId+ '\' data-resid  = \' '+ res +' \'></span>');							 		
	if (!/image\/\w+/.test(ftype)) {//如果不是图片格式
		newImg.src = '/static/img/file.png';
	} else {						 			
		newImg.src = url;
	}
	
	newObj.appendChild(newImg);
	resObj.parentNode.insertBefore(newObj, resObj);	
	if (!many) {
		$("#" + hiddenInputId).val(fullname);
		resObj.style.display = 'none';	
	} else {
		var fileContents = $("#" + hiddenInputId).val();
		$("#" + hiddenInputId).val(fileContents + fullname + '、');
	}

}

function _trim(string) 
{
    return string.replace(/^\s+|\s+$/gm,'');
}

var removeFile = (function(obj){
	var fileId = parseInt($(obj).data('id') ? $(obj).data('id') : $(obj).attr('data-id'));
	var hiddenInputId = $(obj).data('temp') ? $(obj).data('temp') : $(obj).attr('data-temp');
	hiddenInputId = _trim(hiddenInputId);
	var resid = $(obj).data('resid') ? $(obj).data('resid') : $(obj).attr('data-resid');
	console.log(hiddenInputId);
	var filepath = $("#" + hiddenInputId).val();
	var index = layer.confirm('删除不可恢复，确定要删除吗?',{
	    bth:['确定','取消']
	},function(index){
        jcms.ajax('POST', deleteAjaxUrl, {'fileId' : fileId, 'filepath' : filepath}, 'JSON', function(response) {
				if (response.code == 200) {
					$(obj).parent().remove();
					$('#' + _trim(hiddenInputId)).val('');
					$('#' + _trim(resid)).show();
				}
        });
	    layer.close(index);
	},function(){
	    layer.close(index);
	});
});